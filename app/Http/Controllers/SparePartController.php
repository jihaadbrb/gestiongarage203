<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SparePartController extends Controller
{
  
    public function CreateSparePart(Request $request)
    {
        $validatedData = $request->validate([
            'partName' => 'required|string',
            'partReference' => 'required|string',
            'supplier' => 'required|string',
            'price' => 'required|numeric',
            'repair_id' => 'required|exists:repairs,id', 
        ]);

        $sparePart = new SparePart();
        $sparePart->partName = $validatedData['partName'];
        $sparePart->partReference = $validatedData['partReference'];
        $sparePart->supplier = $validatedData['supplier'];
        $sparePart->price = $validatedData['price'];
        $sparePart->save();

        $repair = Repair::find($validatedData['repair_id']);
        $repair->spareParts()->attach($sparePart->id);

        return response()->json(['message' => 'Spare part added successfully'], 200);
    }




    public function getSpareParts()
    {
        $user = Auth::user();
    
        if ($user->role === 'admin') {
            $spareParts = SparePart::with('repairs')->get();
        } else {
            $spareParts = SparePart::whereHas('repairs', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            })->with('repairs')->get();
        }
    
        return view('admin.management.spareParts-data', ['spares' => $spareParts]);
    }
    

    public function DeleteSparePart(Request $request)
    {
        $sparePartId = $request->input('sdeleteId');

        $sparePart = SparePart::find($sparePartId);

        if (!$sparePart) {
            return response()->json(['message' => 'Spare part not found'], 404);
        }

        $sparePart->delete();
        return "ok";

        return response()->json(['message' => 'Spare part deleted successfully'], 200);
    }
}
