@extends('layouts.app')


@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 d-flex">
                    <h1 class="mx-3">Inventario</h1>

                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/home">Home</a></li>
                        <li class="breadcrumb-item active">Productos</li>
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
                            <h3 class="card-title mx-2 mt-2">Productos</h3>
                            <a href="{{route('products.create')}}" class="btn btn-primary ">
                                <i class="fas fa-plus"></i>

                            </a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>id</th>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Cantidad</th>
                                        <th>Proveedor</th>
                                        <th>Precio</th>
                                        <th>Status</th>
                                        <th width="60px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>{{$product->name}}</td>
                                        <td>{{$product->description}}</td>
                                        <td>{{$product->stock}}</td>
                                        @if ($product->supplier->status == 1)
                                            <td>{{$product->supplier->name}}</td>
                                        @else
                                            <td>Inactivo</td>
                                        @endif
                                        <td>{{$product->unit_price}}</td>
                                        <td>
                                            <input data-id="{{$product->id}}" type="checkbox" class="toggle-class" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $product->status ? 'checked': ''}}>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-success" href="{{route('products.show', $product)}}"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-primary" href="{{route('products.edit',$product->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{route('products.destroy',$product) }}" method="POST" class="formEliminar">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger" type="submit" title="Eliminar"><i class="fas fa-trash-alt"></i></button>

                                                </form>
                                            </div>
                                            @endforeach

                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                            {{$products->links()}}
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
                        title: "Seguro que quieres borrar este producto?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Borrar",
                        denyButtonText: `Cancelar`
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire("El producto se elimino correctamente");
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
            var status = $(this).prop('checked') == true ? 1 : 0;
            var id = $(this).data('id');
            $.ajax({
                type: "GET",
                dataType: "json",
                url: 'cambioestadoProduct',
                data: {'status': status, 'id': id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
        })
</script>
@endpush

