@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar producto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/products">Productos</a></li>
                        <li class="breadcrumb-item active">Agregar producto</li>
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
                        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST') 
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name')}}">
                                </div>
                                @error('name')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Descripcion</label>
                                    <textarea class="form-control" id="description" name="description" cols="30" value="" rows="3">{{old('description')}}</textarea>    
                                </div>
                                @error('description')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Stock</label>
                                    <input type="text" class="form-control" id="stock" name="stock" value="{{old('stock')}}" >
                                </div>
                                @error('stock')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Precio unitario</label>
                                    <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{old('unit_price')}}">
                                </div>
                                @error('unit_price')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Categoria</label>
                                    <input type="text" class="form-control" id="category" name="category" value="{{old('category')}}" >
                                </div>
                                @error('category')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Proveedor</label>
                                    <div class="input-group">
                                        <select class="form-control selectpicker show-tick"  id="id_supplier" name="id_supplier" data-size="5" data-live-search="true" title="selecciona un proveedor" data-live-search-placeholder="Buscar proveedor...">
                                                @foreach($suppliers as $supplier)
                                                        <option value="{{$supplier->id}}" >{{$supplier->name}}</option>
                                                @endforeach   
                                            <!-- Agrega más opciones según sea necesario -->
                                        </select>
                                    </div>
                                </div>
                                @error('supplier')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Fecha de vencimiento</label>
                                    <input type="text" class="form-control" id="due_date" name="due_date"  value="{{old('due_date')}}">
                                </div>
                                @error('due_date')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="image" for="image" name="image">
                                            <label class="custom-file-label"  for="exampleInputFile">Elegir Imagen</label>
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