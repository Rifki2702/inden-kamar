<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>SB Admin 2 - Dashboard</title>

  <link href="{{ asset('sb-admin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css" />
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
  <link href="{{ asset('sb-admin/css/sb-admin-2.min.css')}}" rel="stylesheet" />
  <link href="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
</head>

<body id="page-top">
  <div id="wrapper">
    <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
          <i class="fas fa-bed"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Inden Kamar</div>
      </a>
      <hr class="sidebar-divider my-0" />
      <div class="sidebar-heading mt-3">Dashboard</div>
      <li class="nav-item {{ Request::is('admin/dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider" />
      <div class="sidebar-heading">USER</div>
      <li class="nav-item {{ Request::is('admin/profile') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.profile') }}">
          <i class="fas fa-user"></i>
          <span>My Profile</span></a>
      </li>
      <hr class="sidebar-divider" />
      <div class="sidebar-heading">MENU</div>
      <li class="nav-item {{ Request::is('admin/indenkamar') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.indenkamar') }}">
          <i class="fas fa-file"></i>
          <span>Data Inden</span></a>
      </li>
      <hr class="sidebar-divider" />
      <div class="sidebar-heading">TAMBAH</div>
      <li class="nav-item {{ Request::is('admin/tambahuser') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tambahuser') }}">
          <i class="fas fa-user-plus"></i>
          <span>User</span></a>
      </li>
      <hr class="sidebar-divider" />
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}">
          <i class="fas fa-sign-out-alt"></i>
          <span>Logout</span></a>
      </li>
      <hr class="sidebar-divider d-none d-md-block" />
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <nav class="navbar navbar-expand navbar-light bg-dark topbar mb-4 static-top shadow">
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <img class="img-profile icon-circle" src="{{ asset('sb-admin/img/logo.png') }}">
          <div class="sidebar-brand-text mx-3 text-black display-5"><strong>RS Haji Provinsi Jawa Timur</strong></div>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow d-sm-none">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                <form class="form-inline mr-auto w-100 navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="{{ Auth::user()->profile_photo_url }}">
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('admin.profile') }}">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  My Profile
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        @yield('content')
      </div>
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Politeknik Negeri Jember 2023</span>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          Select "Logout" below if you are ready to end your current session.
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">
            Cancel
          </button>
          <a class="btn btn-primary" href="login.html">Logout</a>
        </div>
      </div>
    </div>
  </div>
  <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js')}}"></script>
  <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>
  <script src="{{ asset('sb-admin/js/sb-admin-2.min.js')}}"></script>
  <script src="{{ asset('sb-admin/vendor/chart.js/Chart.min.js')}}"></script>
  <script src="{{ asset('sb-admin/js/demo/chart-area-demo.js')}}"></script>
  <script src="{{ asset('sb-admin/js/demo/chart-pie-demo.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
  <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>
  <script src="{{ asset('sb-admin/js/demo/datatables-demo.js')}}"></script>
  <script src="{{ asset('sb-admin/daterangepicker/daterangepicker.js') }}"></script>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      document.getElementById("btnPrint").addEventListener("click", function() {
        var startDate = document.querySelector('input[name="start"]').value;
        var endDate = document.querySelector('input[name="end"]').value;
        window.location.href = "{{ route('admin.printdata') }}?start=" + startDate + "&end=" + endDate;
      });
      $(document).ready(function() {
        $('#tanggal_mrs_display').datepicker({
          dateFormat: 'yy-mm-dd',
          showButtonPanel: true,
          closeText: 'Clear',
          onSelect: function(dateText, inst) {
            $('#tanggal_mrs_hidden').val(dateText);
            $('#btn-filter').click();
          }
        });
        $('#daterange-btn').click(function() {
          $('#tanggal_mrs_display').datepicker('show');
        });
        $('#btn-filter').click(function() {
          $('#tanggal_mrs_hidden').val($('#tanggal_mrs_display').val());
        });
        $('#btnPrint').click(function() {
          var startDate = document.querySelector('input[name="start"]').value;
          var endDate = document.querySelector('input[name="end"]').value;
          window.location.href = "{{ route('admin.printdata') }}?start=" + startDate + "&end=" + endDate;
        });
        $('#printModal').modal('show');
      });
    });
  </script>
</body>

</html>