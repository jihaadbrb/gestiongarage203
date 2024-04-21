<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    public function generatePDF()
    {
        $invoices = Invoice::with('repair', 'repair.user', 'repair.vehicle')->get();
        
        $data = [];

        foreach ($invoices as $invoice) {
            $data[] = [
                'Title' => 'Welcome to ItSolutionStuff.com',
                'name' => $invoice->repair->user->name,
                'mechanicname' => $invoice->repair->mechanic->name,
                'make' => $invoice->repair->vehicle->make,
                'registration' => $invoice->repair->vehicle->registration,
                'startDate' => Carbon::parse($invoice->repair->startDate)->format('m/d/Y'),
                'endDate' => Carbon::parse($invoice->repair->endDate)->format('m/d/Y'),
                'additionalCharges' => '$' . $invoice->additionalCharges,
                'totalAmount' => '$' . $invoice->totalAmount,
            ];
        }

        $pdf = Pdf::loadView('pdfInvoice', ['invoices' => $data]);

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

