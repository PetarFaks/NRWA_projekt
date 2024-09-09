<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SalesOrderDetail;
use Illuminate\Support\Facades\Auth;

class SalesOrderDetailController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ProductID' => 'required|exists:products,ProductID',
            'OrderQty' => 'required|integer',
            'UnitPrice' => 'required|numeric',
            'OrderDate' => 'required|date',
            'UserID' => 'required|exists:users,id'
        ]);

        $salesOrderDetail = SalesOrderDetail::create([
            'ProductID' => $request->ProductID,
            'OrderQty' => $request->OrderQty,
            'UnitPrice' => $request->UnitPrice,
            'UnitPriceDiscount' => 0, 
            'LineTotal' => $request->OrderQty * $request->UnitPrice,
            'OrderDate' => $request->OrderDate,
            'UserID' => $request->UserID,
            'ModifiedDate' => now(),
        ]);

        return response()->json($salesOrderDetail, 201);
    }



    public function admin_index()
    {
        $this->authorizeAdmin();
        return SalesOrderDetail::all();
    }

    public function admin_store(Request $request)
    {
        $this->authorizeAdmin();

        $request->validate([
            'ProductID' => 'required|integer|exists:products,id',
            'OrderQty' => 'required|integer',
            'UnitPrice' => 'required|numeric',
            'UnitPriceDiscount' => 'nullable|numeric',
            'LineTotal' => 'required|numeric',
            'OrderDate' => 'required|date',
            'UserID' => 'required|integer|exists:users,id',
            
        ]);

        $salesOrderDetail = SalesOrderDetail::create($request->all());
        return response()->json($salesOrderDetail, 201);
    }

    public function admin_show(SalesOrderDetail $salesOrderDetail)
    {
        $this->authorizeAdmin();
        return $salesOrderDetail;
    }

    public function admin_update(Request $request, SalesOrderDetail $salesOrderDetail)
    {
        $this->authorizeAdmin();

        $request->validate([
            'ProductID' => 'required|integer|exists:products,id',
            'OrderQty' => 'required|integer',
            'UnitPrice' => 'required|numeric',
            'UnitPriceDiscount' => 'nullable|numeric',
            'LineTotal' => 'required|numeric',
            'OrderDate' => 'required|date',
            'UserID' => 'required|integer|exists:users,id',
            
        ]);

        $salesOrderDetail->update($request->all());
        return response()->json($salesOrderDetail);
    }

    public function admin_destroy(SalesOrderDetail $salesOrderDetail)
    {
        $this->authorizeAdmin();

        $salesOrderDetail->delete();
        return response()->json(null, 204);
    }

    private function authorizeAdmin()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
    }

    public function admin_count()
{
    $count = SalesOrderDetail::count();
    return response()->json(['count' => $count]);
}
}
