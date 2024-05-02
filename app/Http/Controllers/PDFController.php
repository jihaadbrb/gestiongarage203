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
        $invoice = Invoice::with('repair', 'repair.user', 'repair.vehicle','repair.spareParts')->find($request->id);
        // dd($invoice);
        if (!$invoice) {
            return response()->json(['error' => 'Invoice not found.'], 404);
        }
    
    
        $pdf = Pdf::loadView('pdfInvoice', ['invoice' => $invoice]);
    
        return $pdf->download('garagistInvoice.pdf');
    }
    
}
// <?php
  
// namespace App\Http\Controllers;

// use App\Models\Invoice;
// use Illuminate\Http\Request;
// use App\Models\User;
// use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
// use Barryvdh\DomPDF\PDF as DomPDFPDF;
// use PDF;
    
// class PDFController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      *
//      * @return \Illuminate\Http\Response
//      */
//     public function generatePDF()
//     {
//         $invoices = Invoice::with('repair', 'repair.user', 'repair.vehicle')->get(); // Fetch invoices

//         $data = compact('invoices'); // Use compact helper for cleaner data passing

//         $pdf = FacadePdf::loadView('pdfInvoice', $data);  // Specify full path to blade template

//         return $pdf->download('invoice.pdf');
//     }
// }

