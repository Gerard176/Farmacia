@extends('layouts.app')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Agregar compra</h1>
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
                                <div class="d-flex">
                                    <div class="form-group pr-3">
                                        <label for="exampleInputEmail1">Producto</label>
                                        <div class="input-group">
                                            <select class="form-control selectpicker" id="id_product"  data-size="5" data-live-search="true" data-live-search-placeholder="Buscar Producto..." onchange="updateProductInfo()">
                                                <option value="" disabled selected>Selecciona un producto</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">
                                                        <div id="product_name">{{$product->name}}</div>
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group pr-3">
                                        <label for="exampleInputPassword1">Precio</label>
                                        <input type="text" class="form-control" id="unit_price" name="unit_price" value="" disabled>
                                    </div>
                                    @error('unit_price')
                                    <small style="color: red;">{{$message}}</small>
                                    @enderror
                                    <div class="form-group pr-3">
                                        <label for="exampleInputPassword1">Stock</label>
                                        <input type="text" class="form-control" id="stock" name="stock" value="" disabled>
                                    </div>
                                    <div class="form-group pr-3">
                                        <label for="exampleInputPassword1">Proveedor</label>
                                        <input type="text" class="form-control" id="id_supplier" value="" disabled>
                                    </div>
                                    <div class="form-group pr-3">
                                        <label for="exampleInputPassword1">Cantidad</label>
                                        <input type="text" class="form-control" id="required_amount" value="">
                                    </div>

                                    <div class="mt-4 pt-2">
                                        <button class="btn btn-primary px-5" id="agregarProductoBtn" type="button">Agregar</button>
                                    </div>
                                </div>
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Subtotal</th>
                                            <th width="60px">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                    <tfoot>
                                        <tr>

                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th>Total</th>
                                            <th><input readonly  class="form-control"  name="order_price" id="order_price" value=""></th>
                                            <th></th>
                                        </tr>
                                    </tfoot>

                                </table>


                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="button" id="restart-button" onclick="reiniciarSeleccion()" class="btn btn-danger mr-2">Reiniciar seleccion</button>
                                    <button type="submit" id="submit-button" disabled class="btn btn-primary">Guardar</button>
                                </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <div id="products" data-products="{{ $products }}"></div>
                <div id="suppliers" data-suppliers="{{ $suppliers }}"></div>
            </div>

        </div>


    </section>
</div>
@endsection

@push('scripts')
<script>
    function updateProductInfo() {
        var select = document.getElementById("id_product");
        var productId = select.value;
        var productPriceInput = document.getElementById("unit_price");
        var productStockInput = document.getElementById("stock");
        var productSupplier = document.getElementById("id_supplier");
        
        // Verificar si productId es válido
        if (productId !== "") {
            // Obtener los datos de los productos desde el atributo data-products
            var productsData = document.getElementById('products').getAttribute('data-products');
            var suppliersData = document.getElementById('suppliers').getAttribute('data-suppliers');
            
            var products = JSON.parse(productsData);
            var suppliers = JSON.parse(suppliersData);

            // Buscar el producto seleccionado en los datos de productos
            var selectedProduct = products.find(product => product.id == productId);
            var selectedSupplier = suppliers.find(supplier => supplier.id == selectedProduct.id_supplier);
            console.log(selectedProduct);
            if (selectedProduct) {
                // Actualizar el valor del campo de texto con el precio del producto seleccionado
                productPriceInput.value = selectedProduct.unit_price;
                productStockInput.value = selectedProduct.stock;
                productSupplier.value = selectedSupplier.name;
                console.log(productSupplier);
            } else {
                // Manejar el caso en el que no se encuentre el producto seleccionado
                productPriceInput.value = "Precio no disponible";
                productStockInput.value = "cantidad no disponible";
                productSupplier.value = "Proveedor no disponble";
            }
        } else {
            // Manejar el caso en el que no se haya seleccionado ningún producto
            productPriceInput.value = "";
            productStockInput.value = "";
        }
    }
</script>
<script>
    let total = 0;
    let cont = 0;
    let subtotal = [];
    let productos = [];
    let submitButton = document.getElementById('submit-button');
    let totalElement = document.getElementById('order_price');
    
    document.getElementById('agregarProductoBtn').addEventListener('click', function() {
        // Obtener la tabla y su cuerpo
        var tableBody = document.querySelector('#example2 tbody');
        var newRow = document.createElement('tr');
        var idProduct = document.getElementById('id_product').value;
        var requiredAmount = document.getElementById('required_amount').value;
        
        submitButton.disabled = false;
        productos[cont] = idProduct;

        if (idProduct != "" && requiredAmount > 0 && requiredAmount % 1 == 0) {
            var productsData = document.getElementById('products').getAttribute('data-products');
            var products = JSON.parse(productsData);
            var selectedProduct = products.find(product => product.id == idProduct);
            cont++;
            var productPrice = selectedProduct.unit_price;
            var productName = selectedProduct.name;
            subtotal[cont] = requiredAmount * productPrice; 
            total += subtotal[cont];
            totalElement.value = total;
            newRow.id = 'fila ' + cont;
            newRow.innerHTML = `
            <td>${cont}</td>
            <td><input type="hidden" name="arrayidProducto[]" value="${idProduct}"> ${productName}</td>
            <td><input type="hidden" name="arrayrequiredAmount[]" value="${requiredAmount}"> ${requiredAmount}</td>
            <td><input type="hidden" name="arrayProductPrice[]" value="${productPrice}"> ${productPrice}</td>
            <td>${subtotal[cont]}</td>
            <td>
                <button class="btn btn-danger" type="button" title="Eliminar" onClick="eliminarProducto(${cont})" ><i class="fas fa-trash-alt"></i></button>
            </td>
            `;
            tableBody.appendChild(newRow);
            totalElement.textContent = total; 

            
            
        } else {
            mostrarErrorInputs();
        }

    });

    function eliminarProducto(index) {
        total -= subtotal[index];
        cont--;
        console.log(cont);
        if (cont == 0) {
            submitButton.disabled = true;
        }
        totalElement.value = total;
        var fila = document.getElementById('fila ' + index);
        fila.remove();
    }

    function mostrarErrorInputs(){
        const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: "error",
                title: "Ingresa correctamente los campos"
            });
    }

    function reiniciarSeleccion(){
        window.location.reload(); 
    }
</script>

@endpush