@extends("layouts.app")

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Productos comprados en la fecha {{$purchaseOrder->order_date}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item"><a href="/purchaseOrders">Compras</a></li>
                        <li class="breadcrumb-item active">Agregar compra</li>
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
                        <form action="{{ route('purchaseOrders.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <div class="card-body">

                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orderDetails as $orderDetail)
                                            <tr>
                                                <td>{{$orderDetail->id}}</td>
                                                <td>{{$orderDetail->products->name}}</td>
                                                <td>{{$orderDetail->required_amount}}</td>
                                                <td>{{$orderDetail->products->unit_price}}</td>
                                                <td>{{$orderDetail->total_per_product}}</td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>

                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <th><input readonly class="form-control" name="order_price" id="order_price"
                                                    value="{{$purchaseOrder->order_price}}">
                                            </th>
                                        </tr>
                                    </tfoot>

                                </table>


                                <!-- /.card-body -->


                            </div>
                        </form>
                        <button type="submit" href="{{ route('downloadPdf', $purchaseOrder) }}" onclick="factura()" class="btn btn-primary"
                        name="purchaseOrder" id="factura" value="{{$purchaseOrder->factura}}">Descargar PDF </button>
                    </div>
                    <!-- /.card -->
                    
                </div>
            </div>

        </div>


    </section>
</div>
@endsection

@push('scripts')
    <script>
        function factura() {
            var factura = document.getElementById('factura');
            console.log(factura.value);
        }

    </script>

@endpush