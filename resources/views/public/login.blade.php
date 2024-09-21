<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
</head>
<style>

</style>

<body class="d-flex align-items-center justify-content-center bg-dark text-white"
   style="background-image: url('{{ asset('images/bri.jpg') }}'); height: 100vh;">
    <div class="container mt-5">
        <!-- Heading -->
        <div class="mb-4">
            <h1 class="fw-bold">Login</h1>
            <p class="fs-5">Eco Drive - The Driving Institute</p>
        </div>

        <!-- Login Form Card -->
        <div class="bg-white text-dark rounded-3 shadow p-4" style="max-width: 400px; width: 100%;">
            <form>
                <!-- Phone Number Input -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-0 border-bottom"><small>+971</small></span>
                        <select class="form-select border-0 border-bottom bg-transparent" style="max-width: 80px;">
                            <option selected>50</option>
                            <option>55</option>
                            <option>56</option>
                        </select>
                        <input type="text" class="form-control bg-transparent border-0 border-bottom"
                            placeholder="Phone Number">
                    </div>
                </div>

                <!-- Password Input -->
                <div class="mb-3">
                    <input type="password" class="form-control bg-transparent border-0 border-bottom"
                        placeholder="Password">
                </div>

                <!-- Forgot Password Link -->
                <div class="d-flex justify-content-between mb-4">
                    <div></div>
                    <a href="#" class="text-black text-decoration-none">Forgot Password?</a>
                </div>

                <!-- Login Button -->
                <button type="submit" class="btn btn-dark w-100">Login</button>

                <!-- Register Link -->
                <div class="text-center mt-3">
                    <p class="text-muted">Don't have an account? <a href="#"
                            class="text-dark fw-bold text-decoration-none">Register</a></p>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>