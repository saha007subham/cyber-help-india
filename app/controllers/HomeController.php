<?php
/**
 * Home Controller
 * 
 * Handles requests for the public homepage.
 */

declare(strict_types=1);

namespace App\Controllers;

class HomeController extends Controller {
    /**
     * Display the website homepage.
     *
     * @return void
     */
    public function index(): void {
        $this->view('pages/home', [
            'pageTitle'       => 'Cyber Help India — Digital Safety, Scam Awareness & Citizen Support',
            'metaDescription' => 'Practical cybersecurity guidance, cyber scam reporting steps, and proactive defense resources for Indian citizens and businesses.',
            'stats' => [
                ['value' => '1930', 'label' => 'National Cyber Crime Helpline'],
                ['value' => '24/7', 'label' => 'Emergency Incident Guidance'],
                ['value' => '100% Free', 'label' => 'Public Safety Initiative'],
            ],
            'quickGuides' => [
                [
                    'title' => 'Financial Fraud & UPI Scams',
                    'desc'  => 'Immediate actions to take within the "Golden Hour" to freeze fraudulent transactions.',
                    'badge' => 'High Priority'
                ],
                [
                    'title' => 'Identity Theft & Social Media',
                    'desc'  => 'Step-by-step recovery process for hacked WhatsApp, Instagram, and unauthorized SIM swaps.',
                    'badge' => 'Account Security'
                ],
                [
                    'title' => 'Cyber Crime Reporting (cybercrime.gov.in)',
                    'desc'  => 'Official documentation checklist and filing process for the National Cyber Crime Reporting Portal.',
                    'badge' => 'Legal Process'
                ],
            ]
        ]);
    }
}
