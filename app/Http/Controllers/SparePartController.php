<?php

namespace App\Http\Controllers;

use App\Models\Repair;
use App\Models\SparePart;
use Illuminate\Http\Request;

class SparePartController extends Controller
{
  
    public function addSparePart(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'partName' => 'required|string',
            'partReference' => 'required|string',
            'supplier' => 'required|string',
            'price' => 'required|numeric',
            'repair_id' => 'required|exists:repairs,id', // Assuming repair_id is the ID of the repair related to the spare part
        ]);

        // Create a new SparePart instance
        $sparePart = new SparePart();
        $sparePart->partName = $validatedData['partName'];
        $sparePart->partReference = $validatedData['partReference'];
        $sparePart->supplier = $validatedData['supplier'];
        $sparePart->price = $validatedData['price'];
        $sparePart->save();

        // Attach the spare part to the repair using the pivot table
        $repair = Repair::find($validatedData['repair_id']);
        $repair->spareParts()->attach($sparePart->id);

        // Optionally, you can return a response indicating success
        return response()->json(['message' => 'Spare part added successfully'], 200);
    }




    public function showSpareParts()
    {
        // Fetch spare parts along with their related repairs
        // $spareParts = Repair::with('spareParts')->get();
        $spareParts = SparePart::with('repairs')->get();
        // dd($spareParts);
        return view('admin.management.spareParts-data', ['spares' => $spareParts]);
    }

    public function destroySparePart(Request $request)
    {
        // Get the spare part ID from the request
        $sparePartId = $request->input('spare_part_id');

        // Find the spare part by ID
        $sparePart = SparePart::find($sparePartId);

        if (!$sparePart) {
            return response()->json(['message' => 'Spare part not found'], 404);
        }

        // Delete the spare part
        $sparePart->delete();

        return response()->json(['message' => 'Spare part deleted successfully'], 200);
    }
}
