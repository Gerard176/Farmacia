<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\PurchaseOrder;
use App\Models\Product;
use App\Http\Requests\PurchaseOrderRequest;
use App\Models\OrderDetail;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;

class purchaseOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $purchaseOrders = DB::table('purchase_orders')
        //     ->join('users', 'purchase_orders.id_user', '=', 'users.id')
        //     ->select('purchase_orders.*', 'users.name as user_name')
        //     ->paginate(10);
        $purchaseOrders = PurchaseOrder::paginate(10);
        return view('purchaseOrders.index', compact('purchaseOrders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::where('status', '=','1' )->orderBy('name')->get();
        $suppliers = Supplier::all();
        return view('purchaseOrders.create', compact('products', 'suppliers'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // DB::beginTransaction();
        // try {

        // dd($request);
        $purchaseOrder = new PurchaseOrder();
        $purchaseOrder->order_date = now();
        $purchaseOrder->order_price = $request->order_price;
        $purchaseOrder->status = 0;
        $purchaseOrder->id_user = $request->user()->id;
        $purchaseOrder->save(); // Guarda primero para obtener el ID
        
        $idOrder = $purchaseOrder->id;
        
        $arrayIdProducto = $request->arrayidProducto;
        $arrayrequiredAmount = $request->arrayrequiredAmount;
        $arrayProductPrice = $request->arrayProductPrice;
        
        $sizeArray = count($arrayIdProducto);
        $orderDetails = []; // Inicializa el array para almacenar los detalles de la orden
        
        for ($i = 0; $i < $sizeArray; $i++) {
            $orderDetail = new OrderDetail();
            $orderDetail->id_product = $arrayIdProducto[$i];
            $orderDetail->required_amount = $arrayrequiredAmount[$i];
            $orderDetail->total_per_product = $arrayProductPrice[$i] * $arrayrequiredAmount[$i];
            $orderDetail->id_order = $idOrder;
            $orderDetail->save();
        
            $orderDetails[] = $orderDetail; // Agrega el detalle al array
        }
        
        $numero = Str::slug($purchaseOrder->id);
        $fecha = Carbon::now();
        $fecha = $fecha->format("Y-m-d");
        $nombrefactura = './uploads/invoice/factura_'.$numero.'_'.$fecha.'.pdf';
        $hola = "hola";
        $pdf = PDF::loadView('purchaseOrders.invoice', ['purchaseOrder' => $purchaseOrder, 'orderDetails' => $orderDetails])->setPaper('letter')->setOptions(['defaultFont' => 'DejaVu Sans'])->output();
        file_put_contents($nombrefactura, $pdf);
        
        $purchaseOrder->factura = $nombrefactura;
        $purchaseOrder->save();

        return redirect()->route('purchaseOrders.show',compact('purchaseOrder'))->with('success', 'Compra añadida correctamente.');

        // } catch (\Throwable $th) {
        //     return back()->with("error", $th->getMessage());
        //     DB::rollBack();
        // }

        //    return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchaseOrder = PurchaseOrder::find($id);
        $orderDetails = OrderDetail::where('id_order','=',$id)->get();
        return view('purchaseOrders.show', compact('purchaseOrder','orderDetails'));

         
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchaseOrder = purchaseOrder::find($id);
        return view('purchaseOrders.edit', compact('purchaseOrder'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PurchaseOrderRequest $request, string $id)
    {
        $purchaseOrder = purchaseOrder::find($id);

        $purchaseOrder->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'unit_price' => $request->input('unit_price'),
            'category' => $request->input('category'),
            'supplier' => $request->input('supplier'),
            'due_date' => $request->input('due_date'),
            'registerby' => $request->user()->id,


        ]);
        // return redirect()->back();
        return redirect()->route('purchaseOrders.show', compact('purchaseOrder'))->with('success', 'purchaseOrdero actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $purchaseOrder = purchaseOrder::find($id);
        // Accede a la relación OrderDetail y elimina cada detalle asociado
        foreach ($purchaseOrder->orderDetails as $orderDetail) {
            $orderDetail->delete();
        }

        // Elimina el PurchaseOrder
        $purchaseOrder->delete();

        return redirect()->route('purchaseOrders.index')->with('success', 'purchaseOrdero eliminado correctamente.');
    }

    public function cambioestadoPurchaseOrder(Request $request)
    {
        $purchaseOrder = PurchaseOrder::find($request->id);
        $purchaseOrder->status = $request->status;
        if ($purchaseOrder->status == 1) {
            $purchaseOrder->delivery_date = now();
        }else{
            $purchaseOrder->delivery_date = null;
        }
        $purchaseOrder->save();
    }

    public function downloadPDF(PurchaseOrder $purchaseOrder)
    {
        // Asegúrate de que la ruta al PDF esté correcta
        dd($purchaseOrder);
        $filePath = $purchaseOrder->factura;
        if (is_null($filePath)) {
            return response()->json(['error' => 'File path is null.'], 400);
        }
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            return response()->json(['error' => 'File not found.'], 404);
        }
    }
}
