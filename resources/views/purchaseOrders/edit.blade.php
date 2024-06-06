@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modificar producto {{$product->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/products">Productos</a></li>
                        <li class="breadcrumb-item active">Modificar producto</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"></h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}">

                                </div>
                                @error('name')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Descripcion</label>
                                    <textarea name="description" class="form-control" id="description" value="" cols="30" rows="5">{{old('description',$product->description)}}</textarea>
                                </div>
                                @error('description')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="{{ old('stock', $product->stock) }}">
                                </div>
                                @error('stock')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Precio unitario</label>
                                    <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ old('unit_price', $product->unit_price) }}">
                                </div>
                                @error('unit_price')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Categoria</label>
                                    <input type="text" class="form-control" id="category" name="category" value="{{ old('category', $product->category) }}">
                                </div>
                                @error('category')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Proveedor</label>
                                    <input type="text" class="form-control" id="supplier" name="supplier" value="{{ old('supplier', $product->supplier) }}">
                                </div>
                                @error('supplier')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fecha de vencimiento</label>
                                    <input type="text" class="form-control" id="due_date" name="due_date" value="{{ old('due_date', $product->due_date) }}">
                                </div>
                                @error('due_date')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen</label>    
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" name="image">
                                            <label class="custom-file-label" for="exampleInputFile">Elegir Imagen</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Subir</span>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>

        </div>
</div>


@endsection