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
        $invoices = Invoice::all();

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
}
