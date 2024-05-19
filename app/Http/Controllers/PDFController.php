<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        dd($request);
        $invoice = Invoice::with('repair', 'repair.user', 'repair.vehicle','repair.spareParts')->find($request->id);
  
        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }
    
    
        $pdf = Pdf::loadView('pdfInvoice', ['invoice' => $invoice]);
    
        return $pdf->download('Invoice.pdf');
    }
    
}

