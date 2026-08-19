<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>@yield('title', 'Page Title')</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('assets/img/kaiadmin/logo.webp') }}" type="image/x-icon" />

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Fonts and icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 6 Solid",
                    "Font Awesome 6 Regular",
                    "Font Awesome 6 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <style>
        :root {
            --primary-navy: #1B365D;
            --primary-teal: #2DD4BF;
            --primary-green: #10B981;
            --secondary-navy: #0F2A44;
            --light-teal: #7DD3FC;
            --gradient-primary: linear-gradient(135deg, #1B365D 0%, #2DD4BF 100%);
            --gradient-secondary: linear-gradient(135deg, #2DD4BF 0%, #10B981 100%);
        }

        .nav-item {
            position: relative;
        }

        .sidebar .nav-secondary .nav-item .nav-link {
            padding: 12px 20px;
            border-radius: 8px;
            margin: 2px 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-secondary .nav-item .nav-link i {
            margin-right: 12px;
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sidebar .nav-secondary .nav-item .nav-link:hover {
            background-color: rgba(45, 212, 191, 0.1);
            transform: translateX(5px);
            color: var(--primary-teal);
        }

        .sidebar .nav-secondary .nav-item.active .nav-link {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(27, 54, 93, 0.3);
        }

        .sidebar .nav-collapse .nav-item a {
            padding: 8px 20px 8px 50px;
            font-size: 14px;
        }

        .sidebar .nav-collapse .nav-item a i {
            margin-right: 10px;
            font-size: 14px;
        }

        .sidebar .nav-collapse .nav-item a:hover {
            background-color: rgba(45, 212, 191, 0.1);
            color: var(--primary-teal);
        }

        .text-section {
            color: #8d9498;
            font-size: 12px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin: 20px 0 10px 20px;
        }

        .dropdown-menu.dropdown-user {
            width: 250px;
            border: none;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            padding: 0;
        }

        .dropdown-item {
            padding: 12px 20px;
            transition: all 0.3s ease;
            border: none;
            background: none;
        }

        .dropdown-item:hover {
            background-color: rgba(45, 212, 191, 0.1);
            color: var(--primary-navy);
            transform: translateX(5px);
        }

        .dropdown-item.text-danger:hover {
            background-color: #f8d7da;
            color: #721c24;
        }

        .dropdown-divider {
            margin: 0;
            border-color: #e9ecef;
        }

        .user-box {
            padding: 20px;
            background: var(--gradient-primary);
            color: white;
            border-radius: 10px 10px 0 0;
        }

        .user-box h5 {
            color: white;
            margin-bottom: 5px;
        }

        .user-box .text-muted {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 14px;
        }

        .user-box .btn-primary {
            background: var(--gradient-secondary);
            border: none;
            transition: all 0.3s ease;
        }

        .user-box .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 212, 191, 0.4);
        }

        .avatar-sm, .avatar-lg {
            border: 2px solid var(--primary-teal);
            box-shadow: 0 2px 10px rgba(45, 212, 191, 0.2);
        }

        .footer {
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
            padding: 20px 0;
        }

        .heart {
            animation: heartbeat 1.5s ease-in-out infinite;
            color: var(--primary-teal) !important;
        }

        @keyframes heartbeat {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }

        .custom-template {
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        .btnSwitch button {
            width: 25px;
            height: 25px;
            border-radius: 50%;
            border: 2px solid transparent;
            margin: 2px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btnSwitch button:hover {
            transform: scale(1.1);
            border-color: var(--primary-navy);
        }

        .btnSwitch button.selected {
            border-color: var(--primary-teal);
            box-shadow: 0 0 10px rgba(45, 212, 191, 0.5);
        }

        /* Logo header customization */
        .logo-header {
            background: var(--gradient-primary) !important;
        }

        /* Main header navbar customization */
        .navbar-header {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(45, 212, 191, 0.2);
        }

        /* Profile pic styling */
        .profile-pic {
            padding: 8px 15px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .profile-pic:hover {
            background-color: rgba(45, 212, 191, 0.1);
            transform: translateY(-2px);
        }

        .profile-username .fw-bold {
            color: var(--primary-navy);
        }

        /* Sidebar background */
        .sidebar[data-background-color="dark"] {
            background: linear-gradient(180deg, var(--secondary-navy) 0%, var(--primary-navy) 100%);
        }

        /* Sparkline chart colors update */
        .card .card-body {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(45, 212, 191, 0.15);
        }
    </style>
    @stack('style')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
            @include('panel.layouts.sidebar')
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                @include('panel.layouts.logo-header')
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                @include('panel.layouts.navbar-header')
                <!-- End Navbar -->
            </div>

            <!-- dashboard -->
            @yield('main-dashboard')

           @include('panel.layouts.footer')


        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    <!-- jQuery Scrollbar -->
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    <!-- Chart JS -->
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    <!-- jQuery Sparkline -->
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    <!-- Chart Circle -->
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    <!-- Datatables -->
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    <!-- Bootstrap Notify -->
    {{-- <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script> --}}

    <!-- jQuery Vector Maps -->
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    <!-- Sweet Alert -->
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Kaiadmin JS -->
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    <!-- Kaiadmin DEMO methods -->
    <script src="{{ asset('assets/js/setting-demo.js') }}"></script>
    <script src="{{ asset('assets/js/demo.js') }}"></script>

    <script>
        // Sparkline Charts with updated colors
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#1B365D",
            fillColor: "rgba(27, 54, 93, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#2DD4BF",
            fillColor: "rgba(45, 212, 191, 0.14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#10B981",
            fillColor: "rgba(16, 185, 129, 0.14)",
        });

        // DataTables initialization
        $(document).ready(function() {
            $('#subjectsTable').DataTable({
                "pageLength": 10,
                "lengthMenu": [
                    [10, 25, 50, 100, -1],
                    [10, 25, 50, 100, "All"]
                ],
                "responsive": true,
                "order": [
                    [2, 'asc']
                ],
                "columnDefs": [{
                    "targets": [1, 4],
                    "orderable": false
                }]
            });

            // Delete modal handler
            $(document).on('click', '.delete-btn', function() {
                var subjectId = $(this).data('subject-id');
                var subjectName = $(this).data('subject-name');

                $('#subjectName').text(subjectName);
                $('#deleteForm').attr('action', '{{ url('subjects') }}/' + subjectId);
                $('#deleteModal').modal('show');
            });
        });
    </script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    @stack('script')
</body>

</html>
