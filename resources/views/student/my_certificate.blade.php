<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Achievement - King Driving School</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts (Poppins & Playfair Display for font replication) -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&family=Playfair+Display:wght@700&display=swap">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7fa;
            padding: 30px;
            /* Reduced padding */
        }

        .certificate-container {
            background-color: white;
            max-width: 900px;
            margin: 0 auto;
            padding: 20px;
            /* Reduced padding */
            border: 2px solid #000;
            position: relative;
        }

        .triangle-top-left {
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 0;
            border-top: 60px solid #2d2a71;
            /* Reduced size */
            border-right: 60px solid transparent;
        }

        .triangle-bottom-right {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 0;
            height: 0;
            border-bottom: 60px solid #2d2a71;
            /* Reduced size */
            border-left: 60px solid transparent;
        }

        .certificate-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 28px;
            /* Reduced font size */
            color: #000;
        }

        .certificate-subtitle {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            font-size: 16px;
            /* Reduced font size */
            margin-top: -10px;
            color: #000;
        }

        .awarded-to {
            font-size: 16px;
            /* Reduced font size */
            font-weight: 500;
            margin-top: 20px;
            /* Reduced margin */
            text-transform: uppercase;
        }

        .student-name {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            font-size: 36px;
            /* Reduced font size */
            margin: 15px 0;
            /* Reduced margin */
        }

        .certificate-text {
            font-size: 14px;
            line-height: 1.4;
            margin: 15px 0;
            /* Reduced margin */
        }

        .signature-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 30px;
            /* Reduced margin */
        }

        .badge-image img {
            max-width: 80px;
            /* Reduced image size */
        }

        .instructor-details {
            text-align: right;
        }

        .instructor-details p {
            font-size: 12px;
            /* Reduced font size */
            font-weight: 500;
            margin: 0;
        }

        .instructor-details p strong {
            font-weight: 700;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="certificate-container position-relative">
            <!-- Decorative Triangles -->
            <div class="triangle-top-left"></div>
            <div class="triangle-bottom-right"></div>

            <!-- Certificate Title -->
            <div class="text-center">
                <h1 class="certificate-title">CERTIFICATE</h1>
                <p class="certificate-subtitle">OF ACHIEVEMENT</p>
            </div>

            <!-- Awarded To Section -->
            <div class="text-center">
                <p class="awarded-to">This certificate is awarded to</p>
                <p class="student-name">{{ $student->user->name }}</p>
            </div>

            <!-- Certificate Body Text -->
            <p class="certificate-text text-center">
                In recognition of successfully completing {{ $student->course_hours }} hours of driving training at King
                Driving School. Your dedication, commitment, and skills have demonstrated your readiness for the road.
                You completed your training on <strong>{{ $student->course_end_date->format('F d, Y') }}</strong>.
            </p>

            <!-- Signature Section -->
            <div class="signature-section">
                <div class="badge-image">
                    <img src="{{ $base64 }}" alt="King Driving School Badge">
                </div>
                <div class="instructor-details">
                    <p>
                        <strong>{{ $student->instructor->name }}</strong><br>
                        Lead Instructor
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>
