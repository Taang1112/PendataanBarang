<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">

  <!-- Sidebar Brand -->
  <div class="sidebar-brand">
    <a href="{{ route('dashboard') }}" class="brand-link">
      <img src="{{ asset('assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow" />
      <span class="brand-text fw-light">AdminLTE 4</span>
    </a>
  </div>

  <!-- Sidebar -->
  <div class="sidebar-wrapper">
    <nav class="mt-2">
      <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="navigation" aria-label="Main navigation" data-accordion="false">

        <!-- DASHBOARD (SEMUA ROLE) -->
        <li class="nav-item">
          <a href="{{ route('dashboard') }}" class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}">
            <i class="nav-icon bi bi-speedometer"></i>
            <p>Dashboard</p>
          </a>
        </li>

        {{-- ================= ADMIN ONLY ================= --}}
        @if(auth()->user()->role === 'admin')
        <li class="nav-item">
          <a href="{{ route('barangs.index') }}" class="nav-link {{ request()->is('barangs*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-box-seam"></i>
            <p>Barang</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('kategoris.index') }}" class="nav-link {{ request()->is('kategoris*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-tags-fill"></i>
            <p>Kategori</p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ route('suppliers.index') }}" class="nav-link {{ request()->is('suppliers*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-truck"></i>
            <p>Suppliers</p>
          </a>
        </li>

        {{-- Admin bisa liat index barang masuk (read-only) --}}
        <li class="nav-item">
          <a href="{{ route('barang-masuk.index') }}" class="nav-link {{ request()->is('barang-masuk') ? 'active' : '' }}">
            <i class="nav-icon bi bi-box-arrow-in-down"></i>
            <p>Barang Masuk</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{ route('barang-keluar.index') }}" class="nav-link {{ request()->is('barang-keluar*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-box-arrow-up"></i>
            <p>Barang Keluar</p>
          </a>
        </li>
        @endif

        {{-- ================= SUPPLIER ONLY ================= --}}
        @if(auth()->user()->role === 'supplier')
        <li class="nav-item">
          <a href="{{ route('barang-masuk.index') }}" class="nav-link {{ request()->is('barang-masuk*') ? 'active' : '' }}">
            <i class="nav-icon bi bi-box-arrow-in-down"></i>
            <p>Barang Masuk</p>
          </a>
        </li>
        @endif

        <!-- Divider -->
        <li class="nav-header text-uppercase mt-3">Account</li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="nav-link text-danger bg-transparent border-0 w-100 text-start">
              <i class="nav-icon bi bi-box-arrow-right"></i>
              <p>Logout</p>
            </button>
          </form>
        </li>

      </ul>
    </nav>
  </div>
</aside>
