<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>@yield('title')</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
  <link href="{{asset('lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.0/dist/sweetalert2.min.css">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="{{asset('template/css/bootstrap.min.css')}}" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

  <!-- Template Stylesheet -->
  <link href="{{asset('template/css/style.css')}}" rel="stylesheet">
</head>

<body>
  <div class="container-fluid position-relative d-flex p-0">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
      <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <!-- Spinner End -->


    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
      <nav class="navbar bg-secondary navbar-dark">
        <a href="index.html" class="navbar-brand mx-4 mb-3">
          <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>Payroll<br> Management</h3>
        </a>
        <div class="d-flex align-items-center ms-4 mb-4">
          <div class="position-relative">
            <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
          </div>
          <div class="ms-3">
            <h6 class="mb-0">{{ Auth::user()->name }}</h6>
            <span>{{ Auth::user()->role }}</span>
          </div>
        </div>
        @if(Auth::user()->role == 'admin')
        <div class="navbar-nav w-100">
          <a href="{{route('payrolls.index')}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Payroll</a>
          <a href="{{route('employees.index')}}" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Employee</a>
          <a href="{{route('positions.index')}}" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Position</a>
        </div>
        @else
        <div class="navbar-nav w-100">
          <a href="{{route('payrolls.index', )}}" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Payroll</a>
          <a href="{{route('attendances.index')}}" class="nav-item nav-link"><i class="fa fa-keyboard me-2"></i>Attendance</a>
        </div>
        @endif
      </nav>
    </div>
    <!-- Sidebar End -->


    <!-- Content Start -->
    <div class="content">
      <!-- Navbar Start -->
      <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
          <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
          <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-nav align-items-center ms-auto">
          <div class="nav-item dropdown">
            <div class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-lg-inline-flex">{{ Auth::user()->name }}</span>
              </a>
              <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log Out</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              </div>
            </div>
          </div>
      </nav>
      <!-- Navbar End -->

      <!-- Content -->
      <div class="container-fluid pt-4 px-4">
        @yield('content')
      </div>

      <!-- Footer Start -->
      <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary rounded-top p-4">
          <div class="row">
            <div class="col-12 col-sm-6 text-center text-sm-start">
              &copy; <a href="#">Payroll Management System</a>, All Right Reserved.
            </div>

          </div>
        </div>
      </div>
      <!-- Footer End -->
    </div>
    <!-- Content End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
  </div>

  <!-- JavaScript Libraries -->
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{asset('template/lib/chart/chart.min.js')}}">
  </script>
  <script src="{{asset('template/lib/easing/easing.min.js')}}"></script>
  <script src="{{asset('template/lib/waypoints/waypoints.min.js')}}"></script>
  <script src="{{asset('template/lib/owlcarousel/owl.carousel.min.js')}}"></script>
  <script src="{{asset('template/lib/tempusdominus/js/moment.min.js')}}"></script>
  <script src="{{asset('template/lib/tempusdominus/js/moment-timezone.min.js')}}"></script>
  <script src="{{asset('template/lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
  <!-- Template Javascript -->
  <script src="{{asset('template/js/main.js')}}"></script>
  <!-- SweetAlert2 JS -->
  <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script src="{{asset('js/swal.min.js')}}"></script>
  @stack('scripts')


</html>