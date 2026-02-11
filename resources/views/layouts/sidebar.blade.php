<aside class="app-sidebar shadow" data-bs-theme="dark">

  <style>
    /* TEMA DARK BLUE UNTUK SIDEBAR */
    .app-sidebar {
      background: rgba(10, 25, 47, 0.9) !important;
      backdrop-filter: blur(15px) !important;
      border-right: 1px solid rgba(100, 255, 218, 0.1) !important;
    }
    
    .sidebar-brand {
      background: rgba(30, 41, 59, 0.4) !important;
      padding: 20px !important;
      border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
    }
    
    .brand-link {
      display: flex !important;
      align-items: center !important;
      gap: 12px !important;
      text-decoration: none !important;
    }
    
    .brand-image {
      width: 40px !important;
      height: 40px !important;
      border-radius: 10px !important;
      background: linear-gradient(135deg, #0ea5e9, #2563eb) !important;
      padding: 8px !important;
    }
    
    .brand-text {
      font-size: 20px !important;
      font-weight: 800 !important;
      background: linear-gradient(90deg, #64ffda, #52d7f3) !important;
      -webkit-background-clip: text !important;
      background-clip: text !important;
      color: transparent !important;
      letter-spacing: -0.5px !important;
    }
    
    .sidebar-wrapper {
      background: transparent !important;
    }
    
    .nav-sidebar-menu {
      padding: 20px 0 !important;
    }
    
    .nav-item {
      margin-bottom: 5px !important;
    }
    
    .nav-link {
      color: #8892b0 !important;
      padding: 14px 20px !important;
      border-left: 3px solid transparent !important;
      transition: all 0.3s ease !important;
      display: flex !important;
      align-items: center !important;
      gap: 12px !important;
    }
    
    .nav-link:hover {
      background: rgba(100, 255, 218, 0.05) !important;
      color: #e6f1ff !important;
      border-left-color: rgba(100, 255, 218, 0.3) !important;
    }
    
    .nav-link.active {
      background: rgba(100, 255, 218, 0.1) !important;
      color: #64ffda !important;
      border-left-color: #64ffda !important;
    }
    
    .nav-icon {
      font-size: 16px !important;
      width: 20px !important;
      text-align: center !important;
    }
    
    .nav-link p {
      margin: 0 !important;
      font-size: 14px !important;
      font-weight: 500 !important;
    }
    
    .nav-header {
      color: #8892b0 !important;
      font-size: 11px !important;
      text-transform: uppercase !important;
      letter-spacing: 1px !important;
      padding: 20px 20px 10px !important;
      margin-top: 20px !important;
      border-top: 1px solid rgba(100, 255, 218, 0.1) !important;
    }
    
    .nav-header:first-child {
      margin-top: 0 !important;
      border-top: none !important;
    }
  </style>

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