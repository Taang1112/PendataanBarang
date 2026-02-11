<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>
    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->
    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->
    
    <!-- CSS TEMA DARK BLUE -->
    <style>
        :root {
            --primary-dark: #0a192f;
            --secondary-dark: #112240;
            --accent-blue: #64ffda;
            --accent-light-blue: #52d7f3;
            --text-primary: #e6f1ff;
            --text-secondary: #8892b0;
            --card-bg: #112240;
            --card-border: #233554;
            --gradient-blue: linear-gradient(135deg, #0ea5e9, #2563eb);
            --gradient-dark: linear-gradient(to bottom right, #0f172a, #1e293b);
        }

        /* OVERRIDE UTAMA */
        body {
            background: var(--gradient-dark) !important;
            color: var(--text-primary) !important;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif !important;
            min-height: 100vh;
        }

        /* BACKGROUND ELEGANT */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 10% 20%, rgba(37, 99, 235, 0.15) 0%, transparent 20%),
                radial-gradient(circle at 90% 80%, rgba(100, 255, 218, 0.1) 0%, transparent 20%);
            z-index: -1;
        }

        /* HEADER */
        .main-header {
            background: rgba(10, 25, 47, 0.85) !important;
            backdrop-filter: blur(10px) !important;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
        }

        .navbar-brand {
            color: var(--accent-blue) !important;
            font-weight: 700 !important;
        }

        .nav-link {
            color: var(--text-secondary) !important;
        }

        .nav-link:hover, .nav-link.active {
            color: var(--accent-blue) !important;
            background: rgba(100, 255, 218, 0.1) !important;
        }

        /* SIDEBAR */
        .sidebar {
            background: rgba(10, 25, 47, 0.9) !important;
            backdrop-filter: blur(15px) !important;
            border-right: 1px solid rgba(100, 255, 218, 0.1) !important;
        }

        /* CONTENT AREA */
        .app-content {
            background: transparent !important;
        }

        /* CARD */
        .card {
            background: rgba(17, 34, 64, 0.8) !important;
            border: 1px solid rgba(100, 255, 218, 0.15) !important;
            border-radius: 12px !important;
            color: var(--text-primary) !important;
        }

        .card-header {
            background: rgba(30, 41, 59, 0.4) !important;
            border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
            color: var(--accent-blue) !important;
        }

        /* SMALL BOX */
        .small-box {
            background: rgba(17, 34, 64, 0.8) !important;
            border: 1px solid rgba(100, 255, 218, 0.15) !important;
            border-radius: 12px !important;
            overflow: hidden;
        }

        .small-box:hover {
            border-color: var(--accent-blue) !important;
            transform: translateY(-3px);
            transition: all 0.3s ease;
        }

        .small-box .inner h3 {
            color: white !important;
        }

        .small-box .inner p {
            color: var(--text-secondary) !important;
        }

        .small-box-footer {
            background: rgba(30, 41, 59, 0.5) !important;
            border-top: 1px solid rgba(100, 255, 218, 0.1) !important;
            color: var(--accent-blue) !important;
        }

        .small-box-footer:hover {
            background: rgba(100, 255, 218, 0.1) !important;
        }

        /* WARNA BOX */
        .small-box.text-bg-primary { border-left: 4px solid #3b82f6 !important; }
        .small-box.text-bg-success { border-left: 4px solid #10b981 !important; }
        .small-box.text-bg-info { border-left: 4px solid #0ea5e9 !important; }
        .small-box.text-bg-warning { border-left: 4px solid #f59e0b !important; }
        .small-box.text-bg-danger { border-left: 4px solid #ef4444 !important; }

        /* FOOTER */
        .app-footer {
            background: rgba(10, 25, 47, 0.85) !important;
            backdrop-filter: blur(10px) !important;
            border-top: 1px solid rgba(100, 255, 218, 0.1) !important;
            color: var(--text-secondary) !important;
        }

        /* TABLE */
        .table {
            color: var(--text-primary) !important;
        }

        .table thead th {
            border-bottom: 1px solid rgba(100, 255, 218, 0.1) !important;
            color: var(--text-secondary) !important;
        }

        .table tbody td {
            border-color: rgba(100, 255, 218, 0.05) !important;
        }

        /* FORM */
        .form-control, .form-select {
            background: rgba(17, 34, 64, 0.6) !important;
            border: 1px solid rgba(100, 255, 218, 0.1) !important;
            color: var(--text-primary) !important;
        }

        .form-control:focus, .form-select:focus {
            border-color: var(--accent-blue) !important;
            box-shadow: 0 0 0 3px rgba(100, 255, 218, 0.1) !important;
        }

        /* BREADCRUMB */
        .breadcrumb {
            background: transparent !important;
        }

        .breadcrumb-item a {
            color: var(--accent-blue) !important;
        }

        .breadcrumb-item.active {
            color: var(--text-primary) !important;
        }

        /* BUTTON */
        .btn-primary {
            background: var(--gradient-blue) !important;
            border: none !important;
        }
        
        /* SCROLLBAR */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(10, 25, 47, 0.5);
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(100, 255, 218, 0.3);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(100, 255, 218, 0.5);
        }

        
    </style>
    

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    
    <link rel="preload" href="{{ asset('css/adminlte.css')}}" as="style" />
    <!--end::Accessibility Features-->
    
    <!-- Font Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media='all'"
    />
    <!--end::Fonts-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->
    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->
    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="{{ asset('css/adminlte.css')}}" />
    <!--end::Required Plugin(AdminLTE)-->
    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />
    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
    <style>
/* FORCE DARK FORM — OVERRIDE ADMINLTE & BS5 */

.form-control,
.form-select,
textarea.form-control {
    background-color: #0f223a !important;
    color: #e6f1ff !important;
    border: 1px solid rgba(100,255,218,.15) !important;
}

.form-control::placeholder {
    color: #7f9bb3 !important;
}

.form-control:focus,
.form-select:focus,
textarea.form-control:focus {
    background-color: #132a46 !important;
    border-color: #64ffda !important;
    box-shadow: 0 0 0 3px rgba(100,255,218,.15) !important;
    color: #fff !important;
}

/* Label */
.form-label {
    color: #cfe9ff !important;
}

/* Input group Rp */
.input-group-text {
    background-color: #0f223a !important;
    border: 1px solid rgba(100,255,218,.15) !important;
    color: #64ffda !important;
}

/* Textarea height */
textarea.form-control {
    min-height: 120px !important;
}
</style>

  </head>
  <!--end::Head-->
  
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg sidebar-open" data-bs-theme="dark">

    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
     @include('layouts.navbar')
      <!--end::Header-->
      <!--begin::Sidebar-->
     @include('layouts.sidebar')
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <div class="app-content">
          @yield('content')
          @if(Request::is('dashboard') || Request::is('/'))
            @include('layouts.content')
            @endif
      </div>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2025&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="{{ asset('js/adminlte.js')}}"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);
        if (sidebarWrapper && OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->
    <!-- OPTIONAL SCRIPTS -->
    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>
    <!-- sortablejs -->
    <script>
      new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>
    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>
    <!-- ChartJS -->
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      const sales_chart_options = {
        series: [
          {
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>
    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"
    ></script>
    <!-- jsvectormap -->
    <script>
      // World map by jsVectorMap
      new jsVectorMap({
        selector: '#world-map',
        map: 'world',
      });

      // Sparkline charts
      const option_sparkline1 = {
        series: [
          {
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
      sparkline1.render();

      const option_sparkline2 = {
        series: [
          {
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
      sparkline2.render();

      const option_sparkline3 = {
        series: [
          {
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
      sparkline3.render();
    </script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>