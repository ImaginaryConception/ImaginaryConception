<?php

namespace App\Controller;

use App\Form\InvoiceFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class InvoiceController extends AbstractController
{
    private const COMPANY_INFO = [
        'name' => 'Anis Hamouche',
        'company' => 'Imaginary Conception',
        'siret' => '97829825500016',
        'email' => 'support@imaginaryconception.com',
        'status' => 'Sole Proprietor under French micro-entrepreneur status',
        'vat_notice' => 'VAT not applicable, art. 293 B of CGI'
    ];

    #[Route('/invoice/generate', name: 'app_invoice_generate')]
    public function generate(Request $request): Response
    {
        $form = $this->createForm(InvoiceFormType::class, [
            'invoiceNumber' => $this->generateInvoiceNumber()
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            
            // Calculate totals
            $totalHT = $data['quantity'] * $data['unitPrice'];
            
            // Generate PDF
            $html = $this->renderView('invoice/pdf_template.html.twig', [
                'company' => self::COMPANY_INFO,
                'client' => [
                    'name' => $data['clientName'],
                    'address' => $data['clientAddress'],
                    'email' => $data['clientEmail'],
                    'siret' => $data['clientSiret'],
                ],
                'invoice' => [
                    'number' => $data['invoiceNumber'],
                    'date' => $data['invoiceDate'],
                    'title' => $data['invoiceTitle'],
                    'description' => $data['serviceDescription'],
                    'quantity' => $data['quantity'],
                    'unitPrice' => $data['unitPrice'],
                    'totalHT' => $totalHT,
                    'paymentTerms' => $data['paymentTerms'],
                    'latePenalty' => $data['latePenalty'],
                ],
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
            $response->headers->set('Content-Disposition', 
                'attachment;filename="Invoice-' . $data['invoiceNumber'] . '.pdf"');

            return $response;
        }

        return $this->render('invoice/generate.html.twig', [
            'invoiceForm' => $form->createView(),
        ]);
    }

    private function generateInvoiceNumber(): string
    {
        $year = date('Y');
        $invoiceDir = $this->getParameter('kernel.project_dir') . '/var/invoices';
        
        // Create directory if it doesn't exist
        if (!file_exists($invoiceDir)) {
            mkdir($invoiceDir, 0777, true);
        }
        
        $counterFile = $invoiceDir . '/counter_' . $year . '.txt';
        
        if (file_exists($counterFile)) {
            $sequence = (int)file_get_contents($counterFile);
            $sequence++;
        } else {
            $sequence = 1;
        }
        
        // Reset sequence if it exceeds 365
        if ($sequence > 365) {
            $sequence = 1;
            $year++;
        }
        
        file_put_contents($counterFile, $sequence);
        return sprintf('%s-%03d', $year, $sequence);
    }
}