<?php

namespace App\Http\Controllers\Invoice;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function index()
    {
        // Fetch all invoices from the database
        $invoices = Invoice::paginate(10);

        // Pass invoices to the view
        return view('invoice.all_invoices', compact('invoices'));
    }


    // public function showPdf($id)
    // {
    //     // Fetch the invoice by its ID
    //     $invoice = Invoice::findOrFail($id);

    //     // Load the view and pass the invoice to it
    //     $pdf = Pdf::loadView('invoice.show_invoice', compact('invoice'));

    //     // Return the PDF for download or inline viewing
    //     return $pdf->stream('invoice_' . $invoice->id . '.pdf');
    // }

    public function show($id)
    {
        // Fetch the invoice by its ID
        $invoice = Invoice::findOrFail($id);

        // Return the Blade view to show the invoice in the browser
        return view('invoice.show_invoice', compact('invoice'));
    }

    public function generateReceiptNumber()
    {
        // Fetch the latest invoice
        $latestInvoice = Invoice::latest()->first();

        // Determine the next number (increment)
        if ($latestInvoice) {
            $lastReceiptNumber = (int)str_replace('KDS-', '', $latestInvoice->receipt_number);
            $newReceiptNumber = 'KDS-' . str_pad($lastReceiptNumber + 1, 2, '0', STR_PAD_LEFT);
        } else {
            $newReceiptNumber = 'KDS-01'; // Start with KDS-01 if no invoices exist
        }

        return $newReceiptNumber;
    }
}
