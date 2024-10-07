<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>King Driving School | Admin Panel</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}" type="image/png">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <!-- File Upload -->
    <link rel="stylesheet" href="{{ asset('assets/css/file-upload.css') }}">
    <!-- Plyr -->
    <link rel="stylesheet" href="{{ asset('assets/css/plyr.css') }}">
    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.min.css">
    <!-- Full Calendar -->
    <link rel="stylesheet" href="{{ asset('assets/css/full-calendar.css') }}">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-ui.css') }}">
    <!-- Quill Editor -->
    <link rel="stylesheet" href="{{ asset('assets/css/editor-quill.css') }}">
    <!-- Apex Charts -->
    <link rel="stylesheet" href="{{ asset('assets/css/apexcharts.css') }}">
    <!-- Calendar -->
    <link rel="stylesheet" href="{{ asset('assets/css/calendar.css') }}">
    <!-- jVector Map -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery-jvectormap-2.0.5.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
</head>

<body>

    <!--==================== Preloader Start ====================-->
    <div class="preloader">
        <div class="loader"></div>
    </div>
    <!--==================== Preloader End ====================-->

    <!--==================== Sidebar Overlay End ====================-->
    <div class="side-overlay"></div>
    <!--==================== Sidebar Overlay End ====================-->

    <section class="auth d-flex">
        <div class="auth-left bg-main-50 flex-center p-24">
            <img src="{{ asset('public/images/logo.png') }}" alt="">
        </div>
        <div class="auth-right py-40 px-24 flex-center flex-column">
            <div class="auth-right__inner mx-auto w-100">
                <a href="index.html" class="auth-right__logo">
                    {{-- <img src="{{ asset('public/images/logo.png') }}" alt="" style="width: 50px;"> --}}
                </a>
                <h2 class="mb-8">Welcome to Back! &#128075;</h2>
                <p class="text-gray-600 text-15 mb-32">Please sign in to your account and start the adventure</p>

                {{-- <div class="mb-32 flex-between flex-wrap gap-8">
                        <div class="form-check mb-0 flex-shrink-0">
                            <input class="form-check-input flex-shrink-0 rounded-4" type="checkbox" value=""
                                id="remember">
                            <label class="form-check-label text-15 flex-grow-1" for="remember">Remember Me </label>
                        </div>
                        <a href="forgot-password.html"
                            class="text-main-600 hover-text-decoration-underline text-15 fw-medium">Forgot
                            Password?</a>
                </div> --}}
                <form method="POST" action="{{ route('login_user') }}">
                    @csrf
                    <div class="mb-24">
                        <label for="fname" class="form-label mb-8 h6">Email or Username</label>
                        <div class="position-relative">
                            <input type="text" class="form-control py-11 ps-40" id="fname" name="name"
                                placeholder="Type your username" value="{{ old('name') }}">
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex">
                                <i class="ph ph-user"></i>
                            </span>
                        </div>
                        @if ($errors->has('login_error'))
                            <div class="text-danger">{{ $errors->first('login_error') }}</div>
                        @endif
                    </div>

                    <div class="mb-24">
                        <label for="current-password" class="form-label mb-8 h6">Current Password</label>
                        <div class="position-relative">
                            <input type="password" class="form-control py-11 ps-40" id="current-password"
                                name="password" placeholder="Enter Current Password">
                            <span
                                class="toggle-password position-absolute top-50 inset-inline-end-0 me-16 translate-middle-y ph ph-eye-slash"
                                id="#current-password"></span>
                            <span class="position-absolute top-50 translate-middle-y ms-16 text-gray-600 d-flex"><i
                                    class="ph ph-lock"></i></span>
                        </div>
                        @if ($errors->has('login_error'))
                            <div class="text-danger">{{ $errors->first('login_error') }}</div>
                        @endif
                    </div>

                    <button type="submit" class="btn btn-main rounded-pill w-100">Sign In</button>
                </form>

            </div>
        </div>
    </section>

    <!-- jQuery JS -->
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <!-- Bootstrap Bundle JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Phosphor JS -->
    <script src="{{ asset('assets/js/phosphor-icon.js') }}"></script>
    <!-- File Upload -->
    <script src="{{ asset('assets/js/file-upload.js') }}"></script>
    <!-- Plyr -->
    <script src="{{ asset('assets/js/plyr.js') }}"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <!-- Full Calendar -->
    <script src="{{ asset('assets/js/full-calendar.js') }}"></script>
    <!-- jQuery UI -->
    <script src="{{ asset('assets/js/jquery-ui.js') }}"></script>
    <!-- Quill Editor -->
    <script src="{{ asset('assets/js/editor-quill.js') }}"></script>
    <!-- Apex Charts -->
    <script src="{{ asset('assets/js/apexcharts.min.js') }}"></script>
    <!-- Calendar JS -->
    <script src="{{ asset('assets/js/calendar.js') }}"></script>
    <!-- jVector Map -->
    <script src="{{ asset('assets/js/jquery-jvectormap-2.0.5.min.js') }}"></script>
    <!-- jVector Map World JS -->
    <script src="{{ asset('assets/js/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
</body>

</html>
