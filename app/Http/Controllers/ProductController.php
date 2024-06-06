<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::where('status', '=','1' )->orderBy('name')->get();
        return view('products.create', compact('suppliers'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath ='uploads/products/';
            $slug = Str::slug($request->name);
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug . '-' .$currentDate . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('image')->move($destinationPath,$filename);
            $product->image = $destinationPath . $filename;
        }

        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->unit_price = $request->input('unit_price');
        $product->category = $request->input('category');
        $product->id_supplier = $request->id_supplier;
        $product->due_date = $request->input('due_date');
        $product->status = 1;
        $product->registerby = $request->user()->id;
        $product->save();

    //    return redirect()->back();
        return redirect()->route('products.index')->with('success', 'Producto añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::find($id);
        $suppliers = Supplier::all();
        return view('products.edit', compact('product','suppliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath ='uploads/products/';
            $slug = Str::slug($request->name);
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug . '-' .$currentDate . '-' . $file->getClientOriginalName();
            if ($product && $product->image){
                $actualRoute = $product->image;
                unlink($actualRoute);
            }
            $uploadSuccess = $file->move($destinationPath,$filename);
            $image = $destinationPath . $filename;
            $product->image = $image;
        }
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'stock' => $request->input('stock'),
            'unit_price' => $request->input('unit_price'),
            'category' => $request->input('category'),
            'id_supplier' => $request->id_supplier,
            'due_date' => $request->input('due_date'),
            'registerby' => $request->user()->id,
            
   
        ]);
        // return redirect()->back();
        return redirect()->route('products.show',compact('product'))->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if ($product && $product->image){
            unlink($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producto eliminado correctamente.');
    }

    public function cambioestadoProduct(Request $request)
    {
        $product = Product::find($request->id);
        $product->status = $request->status;
        $product->save();
    }
}
