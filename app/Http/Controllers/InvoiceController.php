<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{
   
    public function CreateInvoice(Request $request)
    {
        $validatedData = $request->validate([
            'additionalCharges' => 'required',
            'repair_id' => 'required'
        ]);

        $additionalCharges = $validatedData['additionalCharges'];
        $repairId = $validatedData['repair_id'];

        $sparePartsTotal = SparePart::whereHas('repairs', function ($query) use ($repairId) {
            $query->where('id', $repairId);
        })->sum('price');

        $totalAmount = $sparePartsTotal + $additionalCharges;

        Invoice::create([
            'additionalCharges' => $additionalCharges,
            'totalAmount' => $totalAmount,
            'repair_id' => $repairId
        ]);

        return redirect()->back()->with('success', 'Invoice generated successfully.');
    }

    public function getInvoices()
    {
        $user = Auth::user();
    
        if ($user->role === 'admin') {
            $invoices = Invoice::with('repair', 'repair.user', 'repair.vehicle')->get();
        } elseif ($user->role === 'mechanic') {
            $invoices = Invoice::whereHas('repair', function ($query) use ($user) {
                $query->where('mechanic_id', $user->id);
            })->with('repair', 'repair.user', 'repair.vehicle')->get();
        } else {
            $invoices = Invoice::whereHas('repair', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('repair', 'repair.user', 'repair.vehicle')->get();
        }
    
        return view('admin.management.invoices-data', ['invoices' => $invoices]);
    }
    
    
    public function DeleteInvoice(Request $request)
    {
        $invoice = Invoice::find($request->deleteId);
        if ($invoice) {

            $invoice->delete();
            return "ok";
        } else {
            return response()->json(['message' => "invoice not found"], 404);
        }
    }


}
