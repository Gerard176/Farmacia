@extends('layouts.app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="mx-3"></h1>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Compras</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header justify-space-betwin">
                            <h3 class="card-title mx-2 mt-2">Compras</h3>
                            <a href="{{route('purchaseOrders.create')}}" class="btn btn-primary ">
                                <i class="fas fa-plus"></i>

                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Fecha de compra</th>
                                        <th>Empleado</th>
                                        <th>Precio de la compra</th>
                                        <th>Estado</th>
                                        <th>Fecha de entrega</th>
                                        <th width="60px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($purchaseOrders as $purchaseOrder)
                                    <tr>
                                        <td>{{$purchaseOrder->id}}</td>
                                        <td>{{$purchaseOrder->order_date}}</td>
                                        <td>{{$purchaseOrder->user->name}}</td>
                                        <td>{{$purchaseOrder->order_price}}</td>
                                        <td>
                                            <input data-id="{{$purchaseOrder->id}}" type="checkbox" class="toggle-class" id="inputState"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="recived" 
                                            data-off="unrecived"  {{ $purchaseOrder->status ? 'checked': ''}}>
                                        </td>
                                        @if ($purchaseOrder->delivery_date == null)
                                            <td>No entregado</td>
                                        @else
                                        <td>{{$purchaseOrder->delivery_date}}</td>
                                        @endif
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-success" href="{{route('purchaseOrders.show', $purchaseOrder)}}"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-primary" href="{{route('purchaseOrders.edit',$purchaseOrder->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                                
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{$purchaseOrders->links()}}
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


@endsection

@push('scripts')

<script>
    (function(){
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.formEliminar')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form){
                form.addEventListener('submit',function (event){
                    event.preventDefault()
                    event.stopPropagation()
                    Swal.fire({
                        title: "Seguro que quieres borrar esta compra?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Borrar",
                        denyButtonText: `Cancelar`
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire("La compra se elimino correctamente");
                            this.submit();
                        }
                    });
                },false)
            })
        })()
      
</script>
<script>
    $(document).ready(function(){
        $("example2").DataTable()
    });
    $(function() {
        $('.toggle-class').change(function() {
            var inputState =document.getElementById('inputState');
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: 'cambioestadoPurchaseOrder',
                data: {'status': status, 'id': id},
                success: function(data){
                    console.log(data.success)
                }
            });
            console.log(inputState);
            window.location.reload();
        })
        })
</script>
@endpush

