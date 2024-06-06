@extends("layouts.app")

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="mx-3">Detalles</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active"><a href="/suppliers">Proveedores</a></li>
                        <li class="breadcrumb-item active">{{$supplier->name}}</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <!-- Encabezado del producto -->
                <div class="d-flex justify-content-between align-items-center mb-3">

                </div>
                <div class="card p-3">
                    <div class="d-flex">
                        <!-- Imagen Responsive -->
                        <img src="{{ asset($supplier->image) }}" class="img-fluid mb-3" width="550px" alt="imagen" style="max-width: 100%; height: auto; ">
                        <!-- Caja de Información Estilizada -->
                        <div class="ml-3">
                            <h1 class="mb-0">{{$supplier->name}}</h1>
                            <span class="badge bg-primary py-2 mb-3">{{$supplier->adress}} </span>
                            <div class="row">
                                <h4 class="card-title mb-3 ">Telefono: {{$supplier->phone}}</h4>
                                <h4 class="card-title mb-3">email: {{$supplier->email}}</h4>
                            </div>
                        </div>
                    </div>
                    <h4 class="mt-4 mb-3">Descripción:</h4>
                    <p class="card-text">{{$supplier->description}}</p>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection