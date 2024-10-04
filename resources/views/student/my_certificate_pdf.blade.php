<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate of Completion</title>
    <style>
        body {
            font-family: Roboto, sans-serif;
            margin: 0;
            padding: 0;
            width: 210mm;
            height: 297mm;
            display: flex;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }

        .certificate {
            border: 10px solid #FF8F1F;
            width: 90%;
            height: 90%;
            padding: 30px;
            box-sizing: border-box;
            text-align: center;
            position: relative;
            page-break-inside: avoid;
        }

        .certificate-header img {
            width: 80px;
            height: 80px;
            margin-bottom: 20px;
        }

        h1 {
            font-weight: 400;
            font-size: 36px;
            color: #FF8F1F;
            margin-bottom: 10px;
        }

        .student-name {
            font-size: 22px;
            margin-bottom: 20px;
        }

        .certificate-content {
            font-size: 16px;
            margin-bottom: 20px;
        }

        .topic-title {
            font-weight: bold;
            margin-top: 10px;
        }

        .topic-description {
            font-size: 14px;
            margin-top: 5px;
        }

        .certificate-footer {
            margin-top: 30px;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <div class="certificate-header">
            <img src="{{ asset('public/images/logo.png') }}" alt="King Driving School Logo">
        </div>
        <div class="certificate-body">
            <h1>Certificate of Completion</h1>
            <p class="student-name">{{ $student->user->name }}</p>
            <div class="certificate-content">
                <p>
                    has completed {{ $student->practical_driving_hours }} hours of driving training on
                    {{ \Carbon\Carbon::parse($student->course_end_date)->format('F j, Y') }}.
                </p>
            </div>
            <p class="topic-title">
                The course consists of {{ $student->practical_driving_hours }} hours and includes the following topics:
            </p>
            <p class="topic-description">
                Traffic Laws - Defensive Driving - Safe Driving Practices - Road Signs - Vehicle Operation - Emergency
                Procedures
            </p>
            <div class="certificate-footer">
                <p>Instructor: {{ $student->instructor->employee->user->name }}</p>
            </div>
        </div>
    </div>
</body>

</html>
