<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use Exception;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function show(Stock $stock) {
        return response()->json($stock,200);
    }

    public function search(Request $request) {
        $request->validate(['key'=>'string|required']);

        $stocks = Stock::where('item_name','like',"%$request->key%")
            ->orWhere('quantity','like',"%$request->key%")->get();

        return response()->json($stocks, 200);
    }

    public function store(Request $request) {
        $request->validate([
            'item_name' => 'string|required',
            'description' => 'string|required',
            'price' => 'numeric',
            'quantity' => 'numeric',
            'category' => 'string|required',
            'acquired_on' => 'date|required',
        ]);

        try {
            $stock = Stock::create($request->all());
            return response()->json($stock, 202);
        }catch(Exception $ex) {
            return response()->json([
                'message' => $ex->getMessage()
            ],500);
        }

    }

    public function update(Request $request, Stock $stock) {
        try {
            $stock->update($request->all());
            return response()->json($stock, 202);
        }catch(Exception $ex) {
            return response()->json(['message'=>$ex->getMessage()], 500);
        }
    }

    public function destroy(Stock $stock) {
        $stock->delete();
        return response()->json(['message'=>'Inventory deleted.'],202);
    }

    public function index() {
        $stocks = Stock::orderBy('item_name')->get();
        return response()->json($stocks, 200);
    }
}
