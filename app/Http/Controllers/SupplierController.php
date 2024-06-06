<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SupplierRequest;
use App\Models\Supplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);    
        return view("suppliers.index", compact("suppliers"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("suppliers.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SupplierRequest $request)
    {
        $supplier = new Supplier();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath ='uploads/suppliers/';
            $slug = str::slug($request->name);
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug . '-' .$currentDate . '-' . $file->getClientOriginalName();
            $uploadSuccess = $request->file('image')->move($destinationPath,$filename);
            $supplier->image = $destinationPath . $filename;
        }

        $supplier->name = $request->input('name');
        $supplier->description = $request->input('description');
        $supplier->adress = $request->input('adress');
        $supplier->phone = $request->input('phone');
        $supplier->email = $request->input('email');
        $supplier->status = 1;
        $supplier->registerby = $request->user()->id;
        $supplier->save();

    //    return redirect()->back();
        return redirect()->route('suppliers.index')->with('success', 'suppliero añadido correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $supplier = Supplier::find($id);
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::find($id);
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $destinationPath ='uploads/suppliers/';
            $slug = Str::slug($request->name);
            $currentDate = Carbon::now()->toDateString();
            $filename = $slug . '-' .$currentDate . '-' . $file->getClientOriginalName();
            if ($supplier && $supplier->image){
                $actualRoute = $supplier->image;
                unlink($actualRoute);
            }
            $uploadSuccess = $file->move($destinationPath,$filename);
            $image = $destinationPath . $filename;
            $supplier->image = $image;
        }
        $supplier->update([
            'name' => $request->input('name'),
            'adress' => $request->input('adress'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email'),
            'description' => $request->input('description'),
            'registerby' => $request->user()->id,
            
   
        ]);
        // return redirect()->back();
        return redirect()->route('suppliers.show',compact('supplier'))->with('success', 'proveedor actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::find($id);
        if ($supplier && $supplier->image){
            unlink($supplier->image);
        }
        $supplier->delete();

        return redirect()->route('suppliers.index')->with('success', 'proveedor eliminado correctamente.');
    }
    public function cambioestadoSupplier(Request $request)
    {
        $supplier = Supplier::find($request->id);
        $supplier->status = $request->status;
        $supplier->save();
    }
}
