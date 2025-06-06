<?php

namespace App\Controller;

use Stripe\Stripe;
use App\Entity\Game;
use App\Entity\User;
use App\Entity\Review;
use App\Entity\Comment;
use App\Entity\Website;
use App\Form\ReviewType;
use Stripe\StripeClient;
use App\Form\AddGameFormType;
use App\Form\ContactFormType;
use Doctrine\ORM\EntityManager;
use App\Form\AddCommentFormType;
use App\Form\EditProfilFormType;
use App\Form\ContactUserFormType;
use App\Form\WebsiteRequestFormType;
use App\Recaptcha\RecaptchaValidator;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MainController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function home(ManagerRegistry $doctrine, TranslatorInterface $translator): Response
    {

        $repository = $doctrine->getRepository(Game::class);

        $games = $repository->createQueryBuilder('g')
            ->orderBy('RAND()')
            ->setMaxResults(3)
            ->getQuery()
            ->execute()
        ;

        return $this->render('main/home.html.twig', [
            'games' => $games,
        ]);
    }

    #[Route('/avis/', name: 'avis')]
    public function avis(Request $request, EntityManagerInterface $entityManager): Response
    {
        $review = new Review();
        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if ($this->getUser()) {
                $review->setUser($this->getUser());
            }
            $entityManager->persist($review);
            $entityManager->flush();

            $this->addFlash('success', 'Merci pour votre avis !');
            return $this->redirectToRoute('avis');
        }

        $reviews = $entityManager->getRepository(Review::class)->findLatestReviews();

        return $this->render('main/avis_clients.html.twig', [
            'form' => $form->createView(),
            'reviews' => $reviews
        ]);
    }

    // #[Route('/portfolio/', name: 'portfolio')]
    // public function portfolio(): Response
    // {
    //     return $this->render('main/portfolio.html.twig');
    // }

    #[Route('/cv/', name: 'cv')]
    public function cv(): Response
    {
        return $this->render('main/cv.html.twig');
    }

    #[Route('/portfolio/', name: 'realisations')]
    public function realisations(): Response
    {
        return $this->render('main/realisations.html.twig');
    }

    #[Route('/services/', name: 'services')]
    public function services(): Response
    {
        return $this->render('main/services.html.twig');
    }

    #[Route('/thanatophobia/', name: 'thanatophobia')]
    public function thanatophobia(): Response
    {
        return $this->render('main/thanatophobia.html.twig');
    }

    #[Route('/thanatophobia-fr/', name: 'thanatophobia_fr')]
    public function thanatophobiaFr(): Response
    {
        return $this->render('main/thanatophobia_fr.html.twig');
    }

    #[Route('/legal-notices/', name: 'mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('main/mentions_legales.html.twig');
    }

    #[Route('/get-a-quote/', name: 'website')]
    public function website(Request $request, ManagerRegistry $doctrine, MailerInterface $mailer, RecaptchaValidator $recaptcha): Response
    {
        // Création du formulaire
        $quote = new Website();
        $form = $this->createForm(WebsiteRequestFormType::class, $quote);

        // Traitement du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            if ($form->isValid()) {
                if ($quote->getDeadline() === null) {
                    $quote->setDeadline(new \DateTime()); // date actuelle par défaut
                }
                $quote->setUser($this->getUser()); // Associer l'utilisateur connecté

                // Calculer le montant de la caution (50% du budget estimé)
                $depositAmount = (int)($quote->getEstimatedBudget() * 0.5);
                $quote->setDepositAmount($depositAmount);

                // Sauvegarde en base de données
                $entityManager = $doctrine->getManager();
                $entityManager->persist($quote);
                $entityManager->flush();

                // Message de confirmation
                $this->addFlash('success', 'Merci pour votre demande, je vous recontacte dans les 24h. — Imaginary Conception');

                return $this->redirectToRoute('website');
            }
        }

        // Affichage du formulaire
        return $this->render('main/website.html.twig', [
            'quote_form' => $form->createView(),
        ]);
    }

    #[Route('/error', name: 'error')]
    public function error()
    {
        return $this->render('main/error.html.twig');
    }

    #[Route('/create-stripe-session/{project}/{type}', name: 'pay')]
    public function stripeCheckout(EntityManagerInterface $em, $project, $type)
    {
        $project = $em->getRepository(Website::class)->findOneBy(['id' => $project]);

        if (!$project) {
            $this->addFlash('error', 'Le projet n\'a pas été trouvé.');
            return $this->redirectToRoute('private_board');
        }

        // Déterminer le montant en fonction du type de paiement
        $amount = 0;
        $paymentName = '';

        if ($type === 'deposit') {
            if ($project->isDepositPaid()) {
                $this->addFlash('error', 'La caution a déjà été payée.');
                return $this->redirectToRoute('private_board');
            }
            $amount = $project->getDepositAmount();
            $paymentName = 'Caution - ' . $project->getCompanyName();
        } elseif ($type === 'final') {
            if (!$project->isDepositPaid()) {
                $this->addFlash('error', 'Veuillez d\'abord payer la caution.');
                return $this->redirectToRoute('private_board');
            }
            if ($project->isFinalPaymentPaid()) {
                $this->addFlash('error', 'Le solde final a déjà été payé.');
                return $this->redirectToRoute('private_board');
            }
            $amount = $project->getEstimatedBudget() - ($project->getDepositAmount());
            $paymentName = 'Solde final - ' . $project->getCompanyName();
        } else {
            $this->addFlash('error', 'Type de paiement invalide.');
            return $this->redirectToRoute('private_board');
        }

        $paymentStripe[] = [
            'price_data' => [
                'currency' => 'eur',
                'product_data' => [
                    'name' => $paymentName,
                ],
                'unit_amount' => $amount * 100,
            ],
            'quantity' => 1,
        ];

        $stripePrivateKey = new StripeClient($_ENV['STRIPE_SECRET_KEY']);

        $checkout_session = $stripePrivateKey->checkout->sessions->create([
            'line_items' => $paymentStripe,
            'mode' => 'payment',
            'success_url' => $this->generateUrl('success', ['project' => $project->getId(), 'type' => $type], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' => $this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'metadata' => [
                'project_id' => $project->getId(),
                'payment_type' => $type
            ]
        ]);

        return new RedirectResponse($checkout_session->url);
    }

    #[Route('/webhook/stripe', name: 'stripe_webhook', methods: ['POST'])]
    public function stripeWebhook(Request $request, EntityManagerInterface $em): Response
    {
        $stripePrivateKey = new StripeClient($_ENV['STRIPE_SECRET_KEY']);
        $endpoint_secret = $_ENV['STRIPE_WEBHOOK_SECRET'];

        $payload = @file_get_contents('php://input');
        $sig_header = $request->headers->get('stripe-signature');

        try {
            $event = \Stripe\Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch(\UnexpectedValueException $e) {
            return new Response('Webhook Error: ' . $e->getMessage(), 400);
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
            return new Response('Webhook Error: ' . $e->getMessage(), 400);
        }

        if ($event->type === 'checkout.session.completed') {
            $session = $event->data->object;
            $projectId = $session->metadata->project_id;
            $paymentType = $session->metadata->payment_type;

            $project = $em->getRepository(Website::class)->find($projectId);
            if (!$project) {
                return new Response('Project not found', 404);
            }

            if ($paymentType === 'deposit') {
                $project->setDepositPaid(true);
            } elseif ($paymentType === 'final') {
                $project->setFinalPaymentPaid(true);
            }

            $em->flush();
        }

        return new Response('Webhook handled', 200);
    }

    #[Route('/success', name: 'success')]
    public function success(Request $request, EntityManagerInterface $em, MailerInterface $mailer)
    {
        $projectId = $request->query->get('project');
        $paymentType = $request->query->get('type');

        if (!$projectId || !$paymentType) {
            return $this->redirectToRoute('error');
        }

        $project = $em->getRepository(Website::class)->find($projectId);
        if (!$project) {
            return $this->redirectToRoute('error');
        }

        $amount = 0;
        if ($paymentType === 'deposit') {
            $project->setDepositPaid(true);
            $amount = $project->getDepositAmount();
        } elseif ($paymentType === 'final') {
            $project->setFinalPaymentPaid(true);
            $amount = $project->getEstimatedBudget() - $project->getDepositAmount();
        }
        $em->flush();

        $email = (new TemplatedEmail())
            ->from('support@imaginaryconception.com')
            ->to($project->getUser()->getEmail())
            ->bcc('imaginaryconception.com+7d8eac2120@invite.trustpilot.com')
            ->subject('Confirmation de votre paiement - ' . ($paymentType === 'deposit' ? 'Caution' : 'Solde final'))
            ->textTemplate('emails/payment_confirmation.txt.twig')
            ->htmlTemplate('emails/payment_confirmation.html.twig')
            ->context([
                'project' => $project,
                'payment_type' => $paymentType,
                'amount' => $amount
            ])
        ;

        // Envoie l'email
        $mailer->send($email);

        return $this->render('main/success.html.twig');
    }

    #[Route('/contact/', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {

        $contact_form = $this->createForm(ContactFormType::class);

        $contact_form->handleRequest($request);

        if ($contact_form->isSubmitted()) {

            if ($contact_form->isValid()) {

            $email = (new TemplatedEmail())
                ->from($contact_form['email']->getData())
                ->to('support@imaginaryconception.com', 'anishamouche@gmail.com')
                ->subject('Imaginary Conception Contact: ' . $contact_form['object']->getData())
                ->textTemplate('emails/contact.txt.twig')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'contact_form_object' => $contact_form['object']->getData(),
                    'contact_form_message' => $contact_form['message']->getData(),
                    'contact_form_email' => $contact_form['email']->getData(),
                ])
            ;

            $mailer->send($email);

            $this->addFlash('success', 'Message sent successfully !');

            return $this->redirectToRoute('home');
            }
        }

        return $this->render('main/contact.html.twig', [
            'contact_form' => $contact_form->createView(),
        ]);
    }

    #[Route('/update-project-stage', name: 'update_project_stage', methods: ['POST'])]
    #[IsGranted('ROLE_ADMIN')]
    public function updateProjectStage(Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$this->isCsrfTokenValid('update_stage', $request->request->get('csrf_token'))) {
            $this->addFlash('error', 'Token CSRF invalide');
            return $this->redirectToRoute('users');
        }

        $userId = $request->request->get('userId');
        $websiteId = $request->request->get('websiteId');
        $stage = $request->request->get('stage');

        $website = $entityManager->getRepository(Website::class)->find($websiteId);

        if (!$website || $website->getUser()->getId() != $userId) {
            $this->addFlash('error', 'Projet non trouvé');
            return $this->redirectToRoute('users');
        }

        if ($website->isCompleted()) {
            $this->addFlash('error', 'Impossible de modifier un projet terminé');
            return $this->redirectToRoute('users');
        }

        $website->setCurrentStage($stage);
        $entityManager->flush();

        $this->addFlash('success', 'Étape du projet mise à jour avec succès');
        return $this->redirectToRoute('users');
    }

    #[Route('/complete-project/{id}', name: 'complete_project')]
    #[ParamConverter('website', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function completeProject(Request $request, Website $website, EntityManagerInterface $entityManager): Response
    {
        // if (!$this->isCsrfTokenValid('complete_project_' . $website->getId(), $request->query->get('csrf_token'))) {
        //     $this->addFlash('error', 'Token CSRF invalide');
        //     return $this->redirectToRoute('users');
        // }

        if (!$website) {
            $this->addFlash('error', 'Projet non trouvé');
            return $this->redirectToRoute('users');
        }

        $website->setCurrentStage(7); // Étape finale : Suivi / Maintenance
        $website->setCompleted(true);
        $entityManager->flush();

        $this->addFlash('success', 'Projet marqué comme terminé avec succès');
        return $this->redirectToRoute('users');
    }

    #[Route('/contact-user/{id}/', name: 'contact_user')]
    #[ParamConverter('user', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function contactUser(Request $request, User $user, MailerInterface $mailer): Response
    {

        if (!$this->isCsrfTokenValid('contact_user_' . $user->getId(), $request->query->get("csrf_token"))) {

            $this->addFlash('error', 'Invalid security token, please try again!');
        } else {

            $contact_user_form = $this->createForm(ContactUserFormType::class);

            $contact_user_form->handleRequest($request);

            if ($contact_user_form->isSubmitted() && $contact_user_form->isValid()) {

                $email = (new TemplatedEmail())
                    ->from('support@imaginaryconception.com')
                    ->to($user->getEmail(), 'anishamouche@gmail.com')
                    ->subject('Imaginary Conception Contact: ' . $contact_user_form['object']->getData())
                    ->textTemplate('emails/contact_user.txt.twig')
                    ->htmlTemplate('emails/contact_user.html.twig')
                    ->context([
                        'contact_user_form_email' => $contact_user_form['email']->getData(),
                        'contact_user_form_object' => $contact_user_form['object']->getData(),
                        'contact_user_form_message' => $contact_user_form['message']->getData(),
                    ]);

                $mailer->send($email);

                $this->addFlash('success', 'Message sent successfully !');

                return $this->redirectToRoute('home');
            }
        }

        return $this->render('main/contact_user.html.twig', [
            'contact_user_form' => $contact_user_form->createView(),
        ]);
    }

    #[Route('/users/', name: 'users')]
    public function users(ManagerRegistry $doctrine): Response
    {

        if (!$this->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error', 'You are not authorized to access this page!');

            return $this->redirectToRoute('home');
        } else {

            $repository = $doctrine->getRepository(User::class);

            $users = $repository->findAll();

            return $this->render('main/users.html.twig', [
                'users' => $users,
            ]);
        }
    }

    #[Route('/requested-quotes/', name: 'requested_website')]
    #[IsGranted('ROLE_ADMIN')]
    public function requestedWebsite(ManagerRegistry $doctrine, Request $request, PaginatorInterface $paginator): Response
    {
        $requestedPage = $request->query->getInt('page', 1);

        if ($requestedPage < 1) {
            throw new NotFoundHttpException();
        }

        $em = $doctrine->getManager();
        $query = $em->createQuery('SELECT w FROM App\\Entity\\Website w ORDER BY w.id DESC');

        $websites = $paginator->paginate(
            $query,
            $requestedPage,
            10
        );

        return $this->render('main/websites_list.html.twig', [
            'websites' => $websites,
        ]);
    }

    #[Route('/toggle-private-board-access/{id}/', name: 'toggle_private_board_access', priority: 10)]
    #[ParamConverter('user', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function togglePrivateBoardAccess(User $user, Request $request, ManagerRegistry $doctrine): Response
    {
        if (!$this->isCsrfTokenValid('toggle_private_board_access_' . $user->getId(), $request->query->get('csrf_token'))) {
            $this->addFlash('error', 'Jeton de sécurité invalide, veuillez réessayer.');
        } else {
            $user->setHasPrivateBoardAccess(!$user->getHasPrivateBoardAccess());
            $em = $doctrine->getManager();
            $em->flush();

            $this->addFlash('success', 'Accès au board privé modifié avec succès !');
        }

        return $this->redirectToRoute('users');
    }

    #[Route('/toggle-website-visibility/{id}', name: 'toggle_website_visibility')]
    #[ParamConverter('website', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function toggleWebsiteVisibility(Website $website, EntityManagerInterface $entityManager): Response
    {
        $website->setSource($website->getSource() === 'admin' ? 'public' : 'admin');
        $entityManager->flush();

        $this->addFlash('success', 'La visibilité du devis a été mise à jour avec succès.');
        return $this->redirectToRoute('requested_website');
    }

    #[Route('/delete-user/{id}/', name: 'delete_user', priority: 10)]
    #[ParamConverter('user', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteUser(User $user, Request $request, ManagerRegistry $doctrine): Response
    {

        if (!$this->isCsrfTokenValid('delete_user_' . $user->getId(), $request->query->get('csrf_token'))) {

            $this->addFlash('error', 'Invalid security token, please try again.');
        } else {

            $em = $doctrine->getManager();
            $em->remove($user);
            $em->flush();

            $this->addFlash('success', 'The user has been successfully deleted!');

            return $this->redirectToRoute('users');
        }

        return $this->redirectToRoute('users');
    }

    #[Route('/edit-profile/{id}/', name: 'edit_profil')]
    #[ParamConverter('user', options: ['mapping' => ['id' => 'id']])]
    public function editProfil(User $user, ManagerRegistry $doctrine, Request $request): Response
    {

        if (!$this->isGranted('ROLE_USER')) {

            $this->addFlash('error', 'You must be logged in to access this page!');

            return $this->redirectToRoute('login');
        } else {

            $form = $this->createForm(EditProfilFormType::class, $user);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                $em = $doctrine->getManager();
                $em->flush();

                $this->addFlash('success', 'Profile changed successfully!');

                return $this->redirectToRoute('profil');
            }

            return $this->render('main/edit_profil.html.twig', [
                'edit_profil_form' => $form->createView(),
            ]);
        }
    }

    #[Route('/profile/', name: 'profil')]
    public function profil(): Response
    {

        if (!$this->isGranted('ROLE_USER')) {

            $this->addFlash('error', 'You are not connected!');

            return $this->redirectToRoute('login');
        } else {

            $user = $this->getUser();

            return $this->render('main/profil.html.twig', [
                'user' => $user,
            ]);
        }
    }

    #[Route('/private-board/', name: 'private_board')]
    public function privateBoard(ManagerRegistry $doctrine): Response
    {
        if (!$this->isGranted('ROLE_USER')) {
            $this->addFlash('error', 'Vous devez être connecté pour accéder à cette page!');
            return $this->redirectToRoute('login');
        }

        $user = $this->getUser();

        $repository = $doctrine->getRepository(Website::class);
        $websites = $repository->findBy(['user' => $user, 'source' => 'admin']);

        return $this->render('main/private_board.html.twig', [
            'websites' => $websites,
        ]);
    }

    #[Route('/delete-comment/{id}/', name: 'comment_delete', priority: 10)]
    #[IsGranted('ROLE_ADMIN')]
    public function commentDelete(Comment $comment, ManagerRegistry $doctrine, Request $request): Response
    {

        if (!$this->isCsrfTokenValid('comment_delete_' . $comment->getId(), $request->query->get("csrf_token"))) {

            $this->addFlash('error', 'Invalid security token, please try again!');
        } else {

            $em = $doctrine->getManager();
            $em->remove($comment);
            $em->flush();

            $this->addFlash('success', 'Comment deleted successfully!');
        }

        return $this->redirectToRoute('game_view', [
            'id' => $comment->getGame()->getId(),
        ]);
    }

    #[Route('/game/{id}/', name: 'game_view')]
    #[ParamConverter('game', options: ['mapping' => ['id' => 'id']])]
    public function gameView(Game $game, Request $request, ManagerRegistry $doctrine): Response
    {

        if (!$this->getUser()) {
            return $this->render('main/game_view.html.twig', [
                'game' => $game,
            ]);
        }

        $comment = new Comment();

        $commentForm = $this->createForm(AddCommentFormType::class, $comment);

        $commentForm->handleRequest($request);

        if ($commentForm->isSubmitted() && $commentForm->isValid()) {

            $comment
                ->setPublicationDate(new \DateTime())
                ->setAuthor($this->getUser())
                ->setGame($game);;

            try {

                $em = $doctrine->getManager();
                $em->persist($comment);
                $em->flush();

                $this->addFlash('success', 'Comment posted successfully!');
            } catch (\Exception $exception) {

                $this->addFlash('error', 'Sorry, something went wrong!');
            }

            unset($comment);
            unset($commentForm);

            $comment = new Comment();
            $commentForm = $this->createForm(AddCommentFormType::class, $comment);
        }

        return $this->render('main/game_view.html.twig', [
            'game' => $game,
            'commentForm' => $commentForm->createView(),
        ]);
    }

    #[Route('/add-game/', name: 'add_game')]
    public function addGame(Request $request, ManagerRegistry $doctrine): Response
    {

        if (!$this->isGranted('ROLE_ADMIN')) {

            $this->addFlash('error', 'You are not authorized to access this page!');

            return $this->redirectToRoute('home');
        } else {

            $game = new Game();

            $form = $this->createForm(AddGameFormType::class, $game);

            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {

                if (!$form->get('image')->getData() == null) {

                    $image = $form->get('image')->getData();

                    $newFileName = md5(time() . rand() . uniqid()) . '.' . $image->guessExtension();

                    $game->setImage($newFileName);

                    $image->move(
                        $this->getParameter('app.user.photo.directory'),
                        $newFileName
                    );
                }

                $em = $doctrine->getManager();

                $em->persist($game);

                $em->flush();

                $this->addFlash('success', 'Game published successfully!');

                return $this->redirectToRoute('games');
            }

            return $this->render('main/add_game.html.twig', [
                'add_game_form' => $form->createView(),
            ]);
        }
    }

    #[Route('/edit-game/{id}/', name: 'edit_game', priority: 10)]
    #[ParamConverter('game', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function publicationEdit(Game $game, Request $request, ManagerRegistry $doctrine): Response
    {

        $form = $this->createForm(AddGameFormType::class, $game);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $image = $form->get('image')->getData();

            if (
                $game->getImage() != null &&
                file_exists($this->getParameter('app.user.photo.directory') . $game->getImage())
            ) {

                unlink($this->getParameter('app.user.photo.directory') . $game->getImage());
            }

            do {

                $newFileName = md5(random_bytes(100)) . '.' . $image->guessExtension();
            } while (file_exists($this->getParameter('app.user.photo.directory') . $newFileName));

            $image->move(
                $this->getParameter('app.user.photo.directory'),
                $newFileName
            );

            $game->setImage($newFileName);

            $em = $doctrine->getManager();
            $em->flush();

            $this->addFlash('success', 'Game changed successfully!');

            return $this->redirectToRoute('game_view', [
                'id' => $game->getId(),
            ]);
        }

        return $this->render('main/game_edit.html.twig', [
            'edit_game_form' => $form->createView(),
        ]);
    }

    #[Route('/delete-game/{id}/', name: 'delete_game', priority: 10)]
    #[ParamConverter('game', options: ['mapping' => ['id' => 'id']])]
    #[IsGranted('ROLE_ADMIN')]
    public function deleteGame(Game $game, Request $request, ManagerRegistry $doctrine): Response
    {

        if (!$this->isCsrfTokenValid('delete_game_' . $game->getId(), $request->query->get('csrf_token'))) {

            $this->addFlash('error', 'Invalid security token, please try again.');
        } else {

            $em = $doctrine->getManager();
            $em->remove($game);
            $em->flush();

            $this->addFlash('success', 'The game has been deleted successfully!');
        }

        return $this->redirectToRoute('games');
    }

    #[Route('/games/', name: 'games')]
    public function games(ManagerRegistry $doctrine, Request $request, PaginatorInterface $paginator): Response
    {

        $requestedPage = $request->query->getInt('page', 1);

        if ($requestedPage < 1) {
            throw new NotFoundHttpException();
        }

        $em = $doctrine->getManager();

        $query = $em->createQuery('SELECT g FROM App\Entity\Game g');

        $games = $paginator->paginate(
            $query,
            $requestedPage,
            10,
        );

        return $this->render('main/games.html.twig', [
            'games' => $games,
        ]);
    }
    #[Route('/create-website', name: 'create_website', methods: ['POST'])]
    public function createWebsite(Request $request, ManagerRegistry $doctrine): Response
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        if (!$this->isCsrfTokenValid('create_website', $request->request->get('csrf_token'))) {
            $this->addFlash('error', 'Jeton de sécurité invalide');
            return $this->redirectToRoute('users');
        }

        $userId = $request->request->get('userId');
        $user = $doctrine->getRepository(User::class)->find($userId);

        if (!$user) {
            $this->addFlash('error', 'Utilisateur non trouvé');
            return $this->redirectToRoute('users');
        }

        $website = new Website();
        $website->setFirstname($request->request->get('firstname'))
            ->setLastname($request->request->get('lastname'))
            ->setEmail($request->request->get('email'))
            ->setPhone($request->request->get('phone'))
            ->setCompanyName($request->request->get('companyName'))
            ->setType($request->request->get('type'))
            ->setEstimatedBudget((float)$request->request->get('estimatedBudget'))
            ->setDepositAmount((float)$request->request->get('depositAmount'))
            ->setDeadline(new \DateTime($request->request->get('deadline')))
            ->setEstimatedPages((int)$request->request->get('estimatedPages'))
            ->setExistingWebsite($request->request->get('existingWebsite'))
            ->setLikedWebsites($request->request->get('likedWebsites'))
            ->setSpecificFunctions(explode(',', $request->request->get('specificFunctions')))
            ->setAdditionalInfo($request->request->get('additionalInfo'))
            ->setUser($user)
            ->setCreatedAt(new \DateTime())
            ->setStatus('pending')
            ->setLogo(false)
            ->setSource('admin');

        $user->setHasPrivateBoardAccess(true);

        $entityManager = $doctrine->getManager();
        $entityManager->persist($website);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Le projet web a été créé et l\'accès au board privé a été accordé.');

        return $this->redirectToRoute('users');
    }
}

