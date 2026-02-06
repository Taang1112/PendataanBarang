<nav class="app-header navbar navbar-expand bg-body">
  <div class="container-fluid">

    <!-- LEFT SIDE -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
          <i class="bi bi-list"></i>
        </a>
      </li>

      <li class="nav-item d-none d-md-block">
        <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
      </li>

      <li class="nav-item d-none d-md-block">
        <a href="{{ route('barangs.index') }}" class="nav-link">Data Barang</a>
      </li>
    </ul>

    <!-- RIGHT SIDE -->
    <ul class="navbar-nav ms-auto">

      <!-- SEARCH -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="bi bi-search"></i>
        </a>
      </li>

      <!-- FULLSCREEN -->
      <li class="nav-item">
        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
          <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
          <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
        </a>
      </li>

      <!-- USER MENU -->
      <li class="nav-item dropdown user-menu">
        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
          <img src="{{ auth()->user()->photo 
            ? asset('storage/photos/' . auth()->user()->photo) 
            : asset('assets/img/user2-160x160.jpg') }}"
         class="user-image rounded-circle shadow"
         alt="User Image">
          <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
        </a>

        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

          <li class="user-header text-bg-primary">
            <img src="{{ auth()->user()->photo 
              ? asset('storage/photos/' . auth()->user()->photo) 
              : asset('assets/img/user2-160x160.jpg') }}"
           class="user-image rounded-circle shadow"
           alt="User Image">
      
           <p>
            {{ auth()->user()->name }} - {{ ucfirst(auth()->user()->role) }}
            <small>Login sebagai pengguna sistem</small>
          </p>
          
          </li>

          <li class="user-body">
            <div class="row">
              <div class="col-4 text-center"><a href="#">Barang</a></div>
              <div class="col-4 text-center"><a href="#">Transaksi</a></div>
              <div class="col-4 text-center"><a href="#">Laporan</a></div>
            </div>
          </li>

          <li class="user-footer">
            <a href="{{ route('profile.edit') }}" class="btn btn-default btn-flat">Profile</a>



            <form action="{{ route('logout') }}" method="POST" class="d-inline float-end">
              @csrf
              <button type="submit" class="btn btn-default btn-flat">Sign out</button>
            </form>
          </li>

        </ul>
      </li>

    </ul>
  </div>
</nav>
