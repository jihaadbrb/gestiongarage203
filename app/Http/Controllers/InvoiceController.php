<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\SparePart;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
   
    public function generateInvoice(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'additionalCharges' => 'required',
            'repair_id' => 'required'
        ]);

        // Calculate the total amount from the price of the spare parts and additional charges
        $additionalCharges = $validatedData['additionalCharges'];
        $repairId = $validatedData['repair_id'];

        $sparePartsTotal = SparePart::whereHas('repairs', function ($query) use ($repairId) {
            $query->where('id', $repairId);
        })->sum('price');

        $totalAmount = $sparePartsTotal + $additionalCharges;

        // Create the invoice with the calculated total amount
        Invoice::create([
            'additionalCharges' => $additionalCharges,
            'totalAmount' => $totalAmount,
            'repair_id' => $repairId
        ]);

        return redirect()->back()->with('success', 'Invoice generated successfully.');
    }

    public function showInvoices()
    {
        $invoices = Invoice::with('repair', 'repair.user', 'repair.vehicle')->get();
        return
            view('admin.management.invoices-data', ['invoices' => $invoices]);
    }

    public function showInvoiceModal(Request $request)
    {
        $invoiceId = $request->input('id');

        $invoice = Invoice::with('repair', 'repair.user', 'repair.vehicle')->find($invoiceId);
        if ($invoice) {
            return response()->json($invoice);
        } else {
            return response()->json(['error' => 'User not found.'], 404);
        }
    }

    public function destroyInvoice(Request $request)
    {
        $invoice = Invoice::find($request->deleteId);
        if ($invoice) {
            $invoice->delete();
            return "ok";
        } else {
            return response()->json(['message' => "inoice not found"], 404);
        }
    }


}
