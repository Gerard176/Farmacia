<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productCount = Product::where('status','=','1')->count();
        $supplierCount = Supplier::where('status','=','1')->count();
        $fecha = Carbon::now();
        $fecha = $fecha->format('Y-m-d');

        $purchaseCountDay = PurchaseOrder::whereDate('order_date', '=', $fecha)->count('id');
        $purchaseTotalDay = PurchaseOrder::whereDate('order_date', '=', Carbon::now()->format('Y-m-d'))->sum('order_price');

        $purchaseCountMonth = PurchaseOrder::whereMonth('order_date', '=', date('m'))->count('id');
        $purchaseTotalMonth = PurchaseOrder::whereMonth('order_date', '=', date('m'))->sum('order_price');

        return view('home', 
        compact('productCount','supplierCount','purchaseCountDay'
        ,'purchaseTotalDay','purchaseCountMonth','purchaseTotalMonth'));
    }
}
