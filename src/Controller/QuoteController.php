<?php

namespace App\Controller;

use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\QuoteFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class QuoteController extends AbstractController
{
    private const COMPANY_INFO = [
        'name' => 'Anis Hamouche',
        'company' => 'Imaginary Conception',
        'siret' => '97829825500016',
        'email' => 'support@imaginaryconception.com',
        'status' => [
            'fr' => 'Auto-entrepreneur sous statut micro-entrepreneur français',
            'en' => 'Sole Proprietor under French micro-entrepreneur status'
        ],
        'vat_notice' => [
            'fr' => 'TVA non applicable, art. 293 B du CGI',
            'en' => 'VAT not applicable, art. 293 B of CGI'
        ]
    ];

    private const PLAN_FEATURES = [
        'starter' => [
            'fr' => [
                'Plus de 5 pages personnalisées',
                'Design responsive (PC, mobile, tablette)',
                'Formulaire de contact avec reCAPTCHA',
                'SEO (balises, sitemap, structure propre)',
                'Hébergement + nom de domaine inclus (1 an)',
                'Optimisation des images (WebP, lazy load)',
                'Installation HTTPS (certificat SSL)',
                'Performances de base (80+ Google PageSpeed)',
                'Mentions légales et politique de confidentialité',
                'Icônes + pictos inclus (Font Awesome, SVG)',
                'RGPD basique (bannière cookies simple)',
                'Révisions illimitées',
                'Livraison sous 7 jours ouvrés'
            ],
            'en' => [
                'More than 5 custom pages',
                'Responsive design (PC, mobile, tablet)',
                'Contact form with reCAPTCHA',
                'SEO (meta tags, sitemap, clean structure)',
                'Hosting + domain name included (1 year)',
                'Image optimization (WebP, lazy load)',
                'HTTPS setup (SSL certificate)',
                'Basic performance (80+ Google PageSpeed)',
                'Legal notices and privacy policy',
                'Icons included (Font Awesome, SVG)',
                'Basic GDPR (simple cookie banner)',
                'Unlimited revisions',
                'Delivery within 7 business days'
            ]
        ],
        'business' => [
            'fr' => [
                'Plus de 10 pages personnalisées',
                'Design personnalisé avec animations (hover, scroll)',
                'Blog ou portfolio dynamique (filtrable, triable)',
                'Google Analytics + Search Console configurés',
                'SEO avancé (sémantique, linking interne, performances)',
                'Hébergement rapide + nom de domaine pro (1 an)',
                'Intégration réseaux sociaux (feed, share, icônes)',
                'Formulaire complet avec accusé de réception et RGPD',
                'Accessibilité renforcée (contraste, clavier, ARIA)',
                'Connexion WhatsApp ou Messenger intégrée',
                'Section FAQ dynamique + pages de blog SEO friendly',
                'Boutons Call-to-Action optimisés (prise de RDV, appels...)',
                'Protection anti-spam, backups auto, sécurité renforcée',
                'Révisions illimitées',
                'Livraison sous 10 jours ouvrés',
                'Support 24/7'
            ],
            'en' => [
                'More than 10 custom pages',
                'Custom design with animations (hover, scroll)',
                'Dynamic blog or portfolio (filterable, sortable)',
                'Google Analytics + Search Console setup',
                'Advanced SEO (semantics, internal linking, performance)',
                'Fast hosting + pro domain name (1 year)',
                'Social media integration (feed, share, icons)',
                'Complete form with GDPR compliance and receipt',
                'Enhanced accessibility (contrast, keyboard, ARIA)',
                'WhatsApp or Messenger integration',
                'Dynamic FAQ section + SEO-friendly blog pages',
                'Optimized Call-to-Action buttons (booking, calls...)',
                'Anti-spam protection, auto backups, enhanced security',
                'Unlimited revisions',
                'Delivery within 10 business days',
                '24/7 support'
            ]
        ],
        'premium' => [
            'fr' => [
                'Plus de 20 pages (site vitrine + blog + e-commerce)',
                'Design haut de gamme (parallax, scroll animé, illustrations custom)',
                'Copywriting pro (titres, textes, call-to-action)',
                'Fonctionnalité E-commerce (produits, panier, paiement, livraisons, stock)',
                'Modules dynamiques : blog, actualités, catalogue, FAQ, avis clients',
                'Newsletter (Mailchimp, Brevo), CRM (Hubspot, Zoho), prise de rendez-vous (Calendly...)',
                'Hébergement hautes performances + nom de domaine offert',
                'Optimisation Core Web Vitals (100/100 PageSpeed cible)',
                'Stratégie SEO pro (mots-clés, backlinks, contenu optimisé)',
                'Pages RGPD conformes (cookies, CGU/CGV, mentions, opt-in)',
                'Scripts personnalisés (pixels pub, tracking conversion...)',
                'Système de sauvegarde automatique hebdomadaire',
                'Formation à l\'utilisation du site (pdf + support écrit)',
                'Révisions illimitées',
                'Livraison sous 14 jours ouvrés',
                'Support 24/7',
                'Maintenance post-livraison'
            ],
            'en' => [
                'More than 20 pages (showcase site + blog + e-commerce)',
                'Premium design (parallax, animated scroll, custom illustrations)',
                'Pro copywriting (headlines, texts, call-to-action)',
                'E-commerce functionality (products, cart, payment, shipping, inventory)',
                'Dynamic modules: blog, news, catalog, FAQ, customer reviews',
                'Newsletter (Mailchimp, Brevo), CRM (Hubspot, Zoho), appointment booking (Calendly...)',
                'High-performance hosting + free domain name',
                'Core Web Vitals optimization (100/100 PageSpeed target)',
                'Pro SEO strategy (keywords, backlinks, optimized content)',
                'GDPR-compliant pages (cookies, terms, notices, opt-in)',
                'Custom scripts (ad pixels, conversion tracking...)',
                'Weekly automatic backup system',
                'Website usage training (pdf + written support)',
                'Unlimited revisions',
                'Delivery within 14 business days',
                '24/7 support',
                'Post-delivery maintenance'
            ]
        ]
    ];

    #[Route('/quote/generate', name: 'quote_generate')]
    public function generate(Request $request): Response
    {
        $form = $this->createForm(QuoteFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            // Determine which template to use based on language selection
            $template = $data['isEnglish'] ? 'quote/pdf_template_en.html.twig' : 'quote/pdf_template_fr.html.twig';

            // Get plan features if not custom, with language selection
            $planFeatures = [];
            if ($data['selectedPlan'] !== 'custom') {
                $lang = $data['isEnglish'] ? 'en' : 'fr';
                $planFeatures = self::PLAN_FEATURES[$data['selectedPlan']][$lang];
            }

            // Prepare company info with selected language
            $lang = $data['isEnglish'] ? 'en' : 'fr';
            $companyInfo = array_merge(self::COMPANY_INFO, [
                'status' => self::COMPANY_INFO['status'][$lang],
                'vat_notice' => self::COMPANY_INFO['vat_notice'][$lang]
            ]);

            // Generate PDF
            $html = $this->renderView($template, [
                'company' => $companyInfo,
                'client' => [
                    'name' => $data['clientName'],
                    'email' => $data['clientEmail'],
                    'phone' => $data['clientPhone'],
                ],
                'project' => [
                    'type' => $data['websiteType'],
                    'pages' => $data['estimatedPages'],
                    'hasGraphicCharter' => $data['graphicCharter'],
                    'specificFunctions' => $data['specificFunctions'],
                    'deadline' => $data['deadline'],
                    'totalPrice' => $data['totalPrice'],
                    'selectedPlan' => $data['selectedPlan'],
                    'planFeatures' => $planFeatures,
                    'customInclusions' => $data['customInclusions'] ?? null,
                    'additionalInfo' => $data['additionalInfo'],
                ],
                'date' => new DateTime(),
            ]);

            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);

            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4');
            $dompdf->render();

            $response = new Response($dompdf->output());
            $response->headers->set('Content-Type', 'application/pdf');
            $response->headers->set('Content-Disposition', 'attachment;filename="quote.pdf"');

            return $response;
        }

        return $this->render('quote/generate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}