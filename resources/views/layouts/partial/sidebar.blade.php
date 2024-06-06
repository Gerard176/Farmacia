<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4 position-fixed vh-100 ">
  <!-- Brand Logo -->
  <a href="/home" class="brand-link">
    <img src="{{ asset('backend/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
      class="brand-image img-circle elevation-3 style=" opacity: .8">

    <span class="brand-text font-weight-light">Farmacia</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">


    <!-- SidebarSearch Form -->


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item ">
          <a href="{{route('home')}}" class="nav-link" id="HomeLink">
          <i class="fas fa-home"></i>
            <p>
              Home

            </p>
          </a>

        </li>
        <li class="nav-item ">
          <a href="{{route('purchaseOrders.index')}}" class="nav-link" id="PurchaseOrderLink">
            <i class='fas fa-shopping-cart'></i>
            <p>
              Compras

            </p>
          </a>

        </li>
        <li class="nav-item">
          <a href="{{route('suppliers.index')}}" class="nav-link" id="suppliersLink">
            <i class='fas fa-handshake'></i>
            <p>
              Proveedores
            </p>
          </a>
        </li>

        <li class="nav-item">
          <a href="/products" class="nav-link" id="ProductsLink">
            <i class='fas fa-pills'></i>
            <p>
              Productos

            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" id="SalesLink">
            <i class='fas fa-coins'></i>
            <p>
              Ventas
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link" id="ClientsLink">
            <i class='fas fa-users'></i>
            <p>
              clientes
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="nav-icon far fa-envelope"></i>
            <p>
              Mailbox
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inbox</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Compose</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Read</p>
              </a>
            </li>
          </ul>
        </li>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>

@push('scripts')
  <script>
  document.addEventListener("DOMContentLoaded", function () {
    const links = document.querySelectorAll(".nav-link");

    links.forEach(link => {
    link.addEventListener("click", function () {
      // Remover la clase "active" de todos los enlaces
      links.forEach(l => l.classList.remove("active"));

      // Agregar la clase "active" al enlace seleccionado
      this.classList.add("active");

      // Guardar el ID del enlace activo en el almacenamiento local
      localStorage.setItem("activeLinkId", this.id);
    });
    });

    // Restaurar el estado del enlace activo al cargar la página
    const activeLinkId = localStorage.getItem("activeLinkId");
    if (activeLinkId) {
    const activeLink = document.getElementById(activeLinkId);
    if (activeLink) {
      activeLink.classList.add("active");
    }
    }
  });
  </script>
@endpush