<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
    public function generateInvoice($sessionId)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        
        // Retrieve the session from Stripe
        $session = Session::retrieve($sessionId);
        
        // Find the reservation with this Stripe session
        $reservation = Reservation::where('stripe_session_id', $sessionId)->first();
        
        // Prepare invoice data
        $invoiceData = [
            "customer_name" => Auth::user()->name,
            "product_name" => $session->line_items->data[0]->description ?? "Booking",
            "amount" => number_format($session->amount_total / 100, 2) . ' ' . strtoupper($session->currency),
            "startDate" => $reservation->startDate,
            "endDate" => $reservation->endDate,
            "invoice_date" => now()->format('Y-m-d'),
        ];
        
        // Generate the PDF
        $pdf = Pdf::loadView('invoices.invoice', compact('invoiceData'));
        
        // echo "<script>window.open('https://www.example.com', '_blank');</script>";
        // Return PDF for download
        return $pdf->download("invoice_{$sessionId}.pdf");
    }
}