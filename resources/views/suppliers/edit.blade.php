@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Modificar Proveedor {{$supplier->name}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/suppliers">Proveedores</a></li>
                        <li class="breadcrumb-item active">Modificar proveedor</li>
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
                        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{old('name', $supplier->name)}}">
                                </div>
                                @error('name')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Direccion</label>
                                    <input type="text" class="form-control" id="adress" name="adress" value="{{old('adress', $supplier->adress)}}">
                                </div>
                                @error('adress')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Telefono</label>
                                    <input type="text" class="form-control" id="phone" name="phone" value="{{old('phone', $supplier->phone)}}" >
                                </div>
                                @error('phone')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{old('email', $supplier->email)}}">
                                </div>
                                @error('email')
                                    <small style="color: red;">{{$message}}</small>
                                @enderror
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Descripcion</label>
                                    <textarea class="form-control" id="description" name="description" cols="30" value="" rows="3">{{old('description',$supplier->description)}}</textarea>    
                                </div>
                                @error('description')
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