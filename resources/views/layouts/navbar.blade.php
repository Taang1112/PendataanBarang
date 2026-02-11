<nav class="app-header navbar navbar-expand">
  <style>
    /* TEMA DARK BLUE UNTUK NAVBAR */
    .app-header {
      background: rgba(10, 25, 47, 0.85) !important;
      backdrop-filter: blur(10px) !important;
      border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
      padding: 0 30px !important;
      height: 70px !important;
    }
    
    .navbar-nav .nav-link {
      color: #8892b0 !important;
      padding: 10px 15px !important;
      border-radius: 8px !important;
      transition: all 0.3s ease !important;
    }
    
    .navbar-nav .nav-link:hover {
      color: #64ffda !important;
      background: rgba(100, 255, 218, 0.1) !important;
    }
    
    .navbar-nav .nav-link i {
      font-size: 18px !important;
    }
    
    .user-menu .dropdown-toggle {
      display: flex !important;
      align-items: center !important;
      gap: 10px !important;
      color: #8892b0 !important;
      text-decoration: none !important;
    }
    
    .user-menu .dropdown-toggle:hover {
      color: #64ffda !important;
    }
    
    .user-image {
      width: 36px !important;
      height: 36px !important;
      border: 2px solid rgba(100, 255, 218, 0.2) !important;
    }
    
    .user-menu .dropdown-menu {
      background: rgba(17, 34, 64, 0.95) !important;
      backdrop-filter: blur(10px) !important;
      border: 1px solid rgba(100, 255, 218, 0.1) !important;
      border-radius: 12px !important;
      color: #e6f1ff !important;
      margin-top: 10px !important;
    }
    
    .user-header {
      background: linear-gradient(135deg, #0ea5e9, #2563eb) !important;
      padding: 20px !important;
      text-align: center !important;
      border-radius: 12px 12px 0 0 !important;
    }
    
    .user-header .user-image {
      width: 80px !important;
      height: 80px !important;
      border: 3px solid rgba(255, 255, 255, 0.3) !important;
      margin-bottom: 10px !important;
    }
    
    .user-header p {
      color: white !important;
      margin: 0 !important;
      line-height: 1.4 !important;
    }
    
    .user-header p small {
      display: block !important;
      font-size: 12px !important;
      opacity: 0.8 !important;
      margin-top: 5px !important;
    }
    
    .user-footer {
      padding: 15px !important;
      background: rgba(30, 41, 59, 0.5) !important;
    }
    
    .btn-default {
      background: rgba(100, 255, 218, 0.1) !important;
      border: 1px solid rgba(100, 255, 218, 0.3) !important;
      color: #64ffda !important;
      transition: all 0.3s ease !important;
    }
    
    .btn-default:hover {
      background: rgba(100, 255, 218, 0.2) !important;
      border-color: #64ffda !important;
    }
    
    @media (max-width: 768px) {
      .app-header {
        padding: 0 15px !important;
      }
      
      .d-none.d-md-block {
        display: none !important;
      }
    }
  </style>

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