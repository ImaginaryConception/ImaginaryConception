<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Form\ContractFormType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContractController extends AbstractController
{
    #[IsGranted('ROLE_ADMIN')]
    #[Route('/contract/generate', name: 'contract_generate')]
    public function generate(Request $request): Response
    {
        $form = $this->createForm(ContractFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            // Add default company information
            $companyInfo = [
                'name' => 'Anis Hamouche',
                'company' => 'Imaginary Conception',
                'siret' => '97829825500016',
                'email' => 'support@imaginaryconception.com',
            ];
            
            // Generate contract content
            $contractHtml = $this->renderView('contract/contract_template.html.twig', [
                'data' => $data,
                'company' => $companyInfo,
                'date' => new \DateTime(),
            ]);

            // Configure PDF options
            $options = new Options();
            $options->set('isHtml5ParserEnabled', true);
            $options->set('isPhpEnabled', true);

            // Create PDF
            $dompdf = new Dompdf($options);
            $dompdf->loadHtml($contractHtml);
            $dompdf->setPaper('A4');
            $dompdf->render();

            // Generate response
            $response = new Response($dompdf->output());
            $response->headers->set('Content-Type', 'application/pdf');
            $response->headers->set('Content-Disposition', 'attachment;filename="contract.pdf"');

            return $response;
        }

        return $this->render('contract/generate.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}