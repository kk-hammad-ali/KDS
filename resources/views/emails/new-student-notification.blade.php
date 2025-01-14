<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>New Student Admission</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #fdeed2;
            font-family: "Montserrat", sans-serif;
            color: #000;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            font-size: 25px;
            font-weight: bold;
            margin: 10px 0;
        }

        .body {
            text-align: center;
            margin-bottom: 20px;
        }

        .body p {
            margin: 10px 0;
            line-height: 1.6;
        }

        .footer {
            text-align: center;
        }

        .footer p {
            font-size: 14px;
            line-height: 1.6;
            margin: 10px 0;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="header">
            <h1>New Student Admission Form</h1>
        </div>

        <!-- Body Section -->
        <div class="body">
            <p>Hello Admin,</p>
            <p>A new student has successfully submitted an admission form with the following details:</p>
            <ul>
                <li><strong>Full Name:</strong> {{ $student->user->name }}</li>
                <li><strong>Email:</strong> {{ $student->email ?? 'Not provided' }}</li>
                <li><strong>Phone Number:</strong> {{ $student->phone }}</li>
                <li><strong>Address:</strong> {{ $student->address }}</li>
                <li><strong>Pickup Sector:</strong> {{ $student->pickup_sector }}</li>
                <li><strong>Course:</strong> {{ $student->course->car->make }} - {{ $student->course->car->model }}</li>
                <li><strong>Fees:</strong> {{ $student->fees }}</li>
                <li><strong>Course Duration:</strong> {{ $student->course_duration }} days</li>
            </ul>
            <p>Please review the form and proceed with further actions.</p>
        </div>

        <!-- Footer Section -->
        <div class="footer">
            <p>© {{ now()->year }} King Driving School. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
