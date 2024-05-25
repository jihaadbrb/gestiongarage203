<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF($id)
    {
        $invoice = Invoice::with('repair', 'repair.user', 'repair.vehicle','repair.spareParts')->find($id);
        // dd($invoice);
        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }
    
    
        $pdf = Pdf::loadView('pdfInvoice1', ['invoice' => $invoice]);
    
        return $pdf->download('garagistInvoice.pdf');
    }
  
};