<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Driving School Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="{{ asset('css/public_style.css') }}" rel="stylesheet">
</head>

<body>

    <div style="background-image: url('{{ asset('images/bri.jpg') }}'); height: 100vh;">
        <!-- Top Bar -->
        <div class="bg-black text-light p-4">
            <div class="row">
                <!-- Social Media Icons (Aligned to Start) -->
                <div class="col-4 d-flex align-items-center ">
                    <a href="#" class="text-light me-4 "><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-4"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light me-4"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-twitter"></i></a>
                </div>

                <!-- Empty Space (Offset Columns) -->
                <div class="col-4"></div>

                <!-- Other End Items (Aligned to End) -->
                <div class="col-4 d-flex align-items-center justify-content-end">
                    <a href="#" class="text-light me-4 text-decoration-none ">Find Us</a>
                    <a href="#" class="text-light me-4 text-decoration-none">
                        <i class="fas fa-comment-dots"></i> LIVE CHAT
                    </a>
                    <span class="text-light"><i class="fas fa-phone-alt"></i> 600 595959</span>
                </div>
            </div>
        </div>
        <!-- Main Navbar -->
        <nav class="navbar navbar-expand-lg pt-5 ps-5 pe-5" id="Nav">
            <div class="container p-3">
                <!-- Logo and Links (col-8) -->
                <div class="row w-100">
                    <div class="col-lg-8 d-flex align-items-center bg-white pt-3 pb-3">
                        <!-- Logo -->
                        <a class="navbar-brand" href="#">
                            <img src="images/klogo.png" alt="Logo" style="height: 40px; width:150px">
                        </a>

                        <!-- Navbar Toggler -->
                        <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false"
                            aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>

                        <!-- Navbar Links -->
                        <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                            <ul class="navbar-nav d-flex flex-column flex-lg-row bg-white px-4 py-2">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle text-dark fw-bold" href="#"
                                        id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        All Courses
                                    </a>
                                    <ul class="dropdown-menu " aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="{{ route('mehran') }}">Mehran Car</a></li>
                                        <li><a class="dropdown-item" href="{{ route('motorbike') }}">Motorbike</a></li>
                                        <li><a class="dropdown-item" href="{{ route('alto') }}">Alto(M) </a></li>
                                        <li><a class="dropdown-item" href="{{ route('mehran') }}">Toyota Vitz</a></li>
                                        <li><a class="dropdown-item" href="{{ route('mira') }}">Daihatsu Mira</a></li>
                                        <li><a class="dropdown-item" href="{{ route('hondacity') }}">Honda City</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item ms-3">
                                    <a class="nav-link text-dark fw-bold" href="{{ route('login') }}"
                                        style="text-decoration: none;">Student
                                        Login</a>
                                </li>
                                <li class="nav-item ms-3">
                                    <a class="nav-link text-dark fw-bold" href="{{ route('specialoffer') }}"
                                        style="text-decoration: none;">Special
                                        Offer</a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Contact Input and Register Button (col-4) -->
                    <div class="col-lg-4 d-flex align-items-center justify-content-between bg-dark">
                        <div class="d-flex align-items-center mt-3 mt-lg-0 bg-dark text-white rounded">
                            <div class="d-flex text-white">
                                <input type="text" class="form-control me-2 input-custom" placeholder="+92"
                                    style="width: 70px;" readonly>
                                <input type="text" class="form-control me-2 input-custom" placeholder="Phone Number"
                                    style="width: 180px;">
                            </div>
                            <div>
                                <button class="btn btn-light fw-bold ms-2">Register Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <div class="hero-section">
            <div class="hero-text text-white p-5 m-5">
                <h1 class="display-4 fw-bold">Learn to Drive<br>With Confidence</h1>
                <p class="lead">Speed . Quality . Delivered</p>
            </div>
        </div>
    </div>

    <!-- Cards Section -->
    <div class="container py-5 mt-5">
        <div class="row g-4 justify-content-center">
            <!-- Card 1 -->
            <div class="col-md-4 col-lg-2">
                <div class="card text-center bg-dark text-white">
                    <div class="card-body">
                        <i class="fas fa-car fa-3x mb-3"></i>
                        <h5 class="card-title">Car</h5>
                        <button class="btn btn-light mt-3">Learn more</button>
                    </div>
                </div>
            </div>
            <!-- Card 2 -->
            <div class="col-md-4 col-lg-2">
                <div class="card text-center bg-dark text-white">
                    <div class="card-body">
                        <i class="fas fa-motorcycle fa-3x mb-3"></i>
                        <h5 class="card-title">Motor Bike</h5>
                        <button class="btn btn-light mt-3">Learn more</button>
                    </div>
                </div>
            </div>
            <!-- Card 3 -->
            <div class="col-md-4 col-lg-2">
                <div class="card text-center bg-dark text-white">
                    <div class="card-body">
                        <i class="fas fa-bus fa-3x mb-3"></i>
                        <h5 class="card-title">Heavy Bus</h5>
                        <button class="btn btn-light mt-3">Learn more</button>
                    </div>
                </div>
            </div>
            <!-- Card 4 -->
            <div class="col-md-4 col-lg-2">
                <div class="card text-center bg-dark text-white">
                    <div class="card-body">
                        <i class="fas fa-truck fa-3x mb-3"></i>
                        <h5 class="card-title">Heavy Truck</h5>
                        <button class="btn btn-light mt-3">Learn more</button>
                    </div>
                </div>
            </div>
            <!-- Card 5 -->
            <div class="col-md-4 col-lg-2">
                <div class="card text-center bg-dark text-white">
                    <div class="card-body">
                        <i class="fas fa-dolly fa-3x mb-3"></i>
                        <h5 class="card-title">Heavy Forklift</h5>
                        <button class="btn btn-light mt-3">Learn more</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Register at Your Doorstep Section -->
    <div class="container text-white py-5 registernow">
        <div class="row justify-content-center text-center">
            <div class="registration-container text-white text-center p-4 rounded shadow-sm mx-auto">
                <h2 class="mb-3 fs-2 text-white">Register at Your Doorstep</h2>
                <p class="mb-4 fs-5">Submit your contact details and our sales executive will contact you shortly</p>
                <form>
                    <div class="d-flex justify-content-center mb-4 align-items-center">
                        <!-- Static +92 Input Field -->
                        <input type="text" class="form-control me-2 input-custom" placeholder="+92"
                            style="max-width: 100px;" readonly>
                        <input type="text" class="form-control me-2 input-custom" placeholder="Area Code"
                            style="max-width: 100px;">
                        <input type="text" class="form-control input-custom" placeholder="Phone Number"
                            style="max-width: 200px;">
                        <button type="submit" class="btn btn-light ms-3">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





    <div class="container py-5 text-center">
        <h2 class="fw-bold mb-5">SPECIAL OFFERS</h2>
        <h2 class="fw-bold mt-5">WHY CHOOSE ECO DRIVE?</h2>
    </div>

    <div class="container-fluid bg-dark py-5">
        <div class="container text-white py-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="card bg-dark border-0" style="height: 300px;">
                        <img src="images/join.jpg" class="card-img" alt="Card Image"
                            style="height: 100%; width:100%;">
                        <div class="card-body text-center">
                            <h2 class="card-title mt-4">Safe Driving Starts With Us</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-light text-dark py-5">
        <div class="container">
            <div class="row text-center mb-5">
                <!-- Address Section -->
                <div class="col-md-4 mb-4 d-flex align-items-center justify-content-center">
                    <div class="me-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-map-marker-alt fa-lg"></i>
                        </div>
                    </div>
                    <div class="text-start">
                        <h6 class="text-uppercase text-muted">Address</h6>
                        <p class="mb-0 fw-bold">I-10 Markaz Islamabad</p>
                    </div>
                </div>

                <!-- Email Section -->
                <div class="col-md-4 mb-4 d-flex align-items-center justify-content-center">
                    <div class="me-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-envelope fa-lg"></i>
                        </div>
                    </div>
                    <div class="text-start">
                        <h6 class="text-uppercase text-muted">Email</h6>
                        <p class="mb-0 fw-bold">info@kingdrivingchool</p>
                    </div>
                </div>

                <!-- Call Section -->
                <div class="col-md-4 mb-4 d-flex align-items-center justify-content-center">
                    <div class="me-3">
                        <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center"
                            style="width: 60px; height: 60px;">
                            <i class="fas fa-phone-alt fa-lg"></i>
                        </div>
                    </div>
                    <div class="text-start">
                        <h6 class="text-uppercase text-muted">Call</h6>
                        <p class="mb-0 fw-bold">+92 335-4323432</p>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <!-- Logo Section -->
                <div class="col-md-3 mb-4">
                    <img src="images/klogo.png" alt="King Drive Logo" class="mb-3" style="max-width: 120px;">
                </div>

                <!-- Quick Links Section -->
                <div class="col-md-3 mb-4">
                    <h6 class="text-uppercase fw-bold">Quick Links</h6>
                    <hr class="mx-auto" style="width: 100px; border: 1px solid #000;">
                    <ul class="list-unstyled">
                        <li><a href="{{ route('about') }}" class="text-dark text-decoration-none">About Us</a></li>
                        <li><a href="{{ route('faq') }}" class="text-dark text-decoration-none">FAQs</a></li>
                        <li><a href="{{ route('documents') }}" class="text-dark text-decoration-none">Documents</a>
                        </li>
                        <li><a href="{{ route('terms') }}" class="text-dark text-decoration-none">Terms of Use</a>
                        </li>
                        <li><a href="{{ route('privacy') }}" class="text-dark text-decoration-none">Privacy
                                Policy</a></li>
                        <li><a href="{{ route('findus') }}" class="text-dark text-decoration-none">Find Us</a></li>
                        <li><a href="{{ route('requestcallback') }}" class="text-dark text-decoration-none">Request
                                Callback</a></li>
                    </ul>
                </div>

                <!-- Courses Section -->
                <div class="col-md-3 mb-4">
                    <h6 class="text-uppercase fw-bold">Courses</h6>
                    <hr class="mx-auto" style="width: 70px; border: 1px solid #000;">
                    <ul class="list-unstyled">
                        <li><a class="text-dark text-decoration-none" href="{{ route('mehran') }}">Mehran Car</a>
                        </li>
                        <li><a class="text-dark text-decoration-none" href="{{ route('motorbike') }}">Motorbike</a>
                        </li>
                        <li><a class="text-dark text-decoration-none" href="{{ route('alto') }}">Alto(M) </a></li>
                        <li><a class="text-dark text-decoration-none" href="{{ route('mehran') }}">Toyota Vitz</a>
                        </li>
                        <li><a class="text-dark text-decoration-none" href="{{ route('mira') }}">Daihatsu Mira</a>
                        </li>
                        <li><a class="text-dark text-decoration-none" href="{{ route('hondacity') }}">Honda City</a>
                        </li>
                    </ul>
                </div>

                <!-- Download the App Section -->
                <div class="col-md-3 mb-4">
                    <h6 class="text-uppercase fw-bold ">Download the App</h6>
                    <hr class="mx-auto" style="width: 170px; border: 1px solid black">
                    <a href=""><img src="images/play.png" alt="Google Play " style="max-width: 120px;"
                            class="me-2"></a>
                    <a href=""><img src="images/store.png" alt="App Store" style="max-width: 110px;"></a>
                </div>
            </div>
        </div>
    </footer>
    <div class="bg-dark text-white py-3 mb-0 mt-0">
        <div class="container text-center">
            <a href="#" class="text-white text-decoration-none mx-2"><i class="fab fa-instagram"></i>
                Instagram</a>
            <a href="#" class="text-white text-decoration-none mx-2"><i class="fab fa-linkedin"></i>
                Linkedin</a>
            <a href="#" class="text-white text-decoration-none mx-2 "><i class="fab fa-facebook"></i>
                Facebook</a>
        </div>
    </div>

    <!-- Footer and other sections as in your provided code -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
