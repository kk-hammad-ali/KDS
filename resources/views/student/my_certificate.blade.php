<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate</title>
    <style>
        @page {
            margin: 20px;
            /* Reduce margins on all sides */
        }

        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
            /* Ensure content is centered */
        }

        .certificate {
            border: 3px solid #FF8F1F;
            /* Reduced border size */
            padding: 15px;
            /* Reduced padding */
            width: 90%;
            /* Occupy more horizontal space */
            margin: 0 auto;
            /* Center the certificate */
            text-align: center;
        }

        .certificate-header {
            text-align: center;
            margin-bottom: 15px;
        }

        .certificate-header img {
            width: 100px;
            /* Adjust the image size */
            height: auto;
        }

        h1 {
            font-weight: 400;
            font-size: 28px;
            /* Reduced font size */
            color: #FF8F1F;
        }

        .student-name {
            font-size: 22px;
            margin: 15px 0;
        }

        .certificate-content {
            margin: 0 auto;
            width: 80%;
            text-align: center;
        }

        .topic-description {
            font-size: 12px;
            /* Reduced font size */
            color: #666;
        }

        .certificate-footer {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="certificate-header">
            <img src="{{ $base64 }}" alt="King Driving School Logo" />
        </div>
        <div class="certificate-body">
            <h1>Certificate of Completion</h1>
            <p class="student-name">{{ $student->user->name }}</p>
            <div class="certificate-content">
                <p>has completed <strong>{{ $student->practical_driving_hours }}</strong> hours of driving training on
                    <strong>{{ \Carbon\Carbon::parse($student->course_end_date)->format('F j, Y') }}</strong>.
                </p>
                <p>The course consists of {{ $student->practical_driving_hours }} hours and includes the following
                    topics:</p>
                <p class="topic-description">Traffic Laws - Defensive Driving - Safe Driving Practices - Road Signs -
                    Vehicle Operation - Emergency Procedures</p>
            </div>
            <div class="certificate-footer">
                <p>Instructor: {{ $student->instructor->employee->user->name }}</p>
            </div>
        </div>
    </div>
</body>

</html>
