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
                        <li class="breadcrumb-item active">Proveedores</li>
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
                            <h3 class="card-title mx-2 mt-2">Proveedores</h3>
                            <a href="{{route('suppliers.create')}}" class="btn btn-primary ">
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
                                        <th>Direccion</th>
                                        <th>Telefono</th>
                                        <th>email</th>
                                        <th>Status</th>
                                        <th width="60px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $supplier)
                                    <tr>
                                        <td>{{$supplier->id}}</td>
                                        <td>{{$supplier->name}}</td>
                                        <td>{{$supplier->adress}}</td>
                                        <td>{{$supplier->phone}}</td>
                                        <td>{{$supplier->email}}</td>
                                        <td>
                                            <input data-id="{{$supplier->id}}" type="checkbox" class="toggle-class" data-onstyle="success" 
                                            data-offstyle="danger" data-toggle="toggle" data-on="Activo" data-off="Inactivo" {{ $supplier->status ? 'checked': ''}}>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-success" href="{{route('suppliers.show', $supplier)}}"><i class="fas fa-eye"></i></a>
                                                <a class="btn btn-primary" href="{{route('suppliers.edit',$supplier->id)}}"><i class="fas fa-pencil-alt"></i></a>
                                                <form action="{{route('suppliers.destroy',$supplier) }}" method="POST" class="formEliminar">
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
                            {{$suppliers->links()}}
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
                        title: "Seguro que quieres borrar este proveedor?",
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: "Borrar",
                        denyButtonText: `Cancelar`
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            Swal.fire("El Proveedor se elimino correctamente");
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
                url: 'cambioestadoSupplier',
                data: {'status': status, 'id': id},
                success: function(data){
                    console.log(data.success)
                }
            });
        })
        })
</script>
@endpush

