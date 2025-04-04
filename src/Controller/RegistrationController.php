<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Recaptcha\RecaptchaValidator;
use Symfony\Component\Form\FormError;

class RegistrationController extends AbstractController
{
    #[Route('/register/', name: 'register')]
    public function register(Request $request, RecaptchaValidator $recaptcha, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $user->setRoles(['ROLE_USER']);

            // Récupération de la réponse envoyée par le captcha dans le formulaire
            // ( $_POST['g-recaptcha-response'] )
            $recaptchaResponse = $request->request->get('g-recaptcha-response', null);

            // Si le captcha n'est pas valide, on crée une nouvelle erreur dans le formulaire (ce qui l'empêchera de créer l'article et affichera l'erreur)
            // $request->server->get('REMOTE_ADDR') -----> Adresse IP de l'utilisateur dont la méthode verify() a besoin
            if ($recaptchaResponse == null || !$recaptcha->verify($recaptchaResponse, $request->server->get('REMOTE_ADDR'))) {

                // Ajout d'une nouvelle erreur manuellement dans le formulaire
                $form->addError(new FormError('Le Captcha doit être validé !'));
            }

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            $this->addFlash('success', 'Account created successfully!');

            return $this->redirectToRoute('login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
