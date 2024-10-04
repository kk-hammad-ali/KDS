<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admission Confirmation</title>
</head>

<body bgcolor="#0f3462" style="margin-top:20px;margin-bottom:20px">
    <!-- Main table -->
    <table border="0" align="center" cellspacing="0" cellpadding="0" bgcolor="white" width="650">
        <tr>
            <td>
                <!-- Child table -->
                <table border="0" cellspacing="0" cellpadding="0" style="color:#0f3462; font-family: sans-serif;">
                    <tr>
                        <td>
                            <h2 style="text-align:center; margin: 0px; padding-bottom: 25px; margin-top: 25px;">
                                <i>King Driving School</i>
                            </h2>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: center;">
                            <h1 style="margin: 0px;padding-bottom: 25px; text-transform: uppercase;">Admission
                                Confirmation</h1>
                            <p style="margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">
                                Dear {{ $details['student']->user->name }},<br>
                                Your admission has been confirmed at King Driving School. Below are your details:
                            </p>
                            <p style="margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">
                                <strong>Instructor:</strong> {{ $details['instructor']->employee->user->name }}<br>
                                <strong>Car:</strong> {{ $details['car']->make }} ({{ $details['car']->model }})<br>
                                <strong>Schedule:</strong> From {{ $details['schedule']->start_time }} to
                                {{ $details['schedule']->end_time }} on {{ $details['schedule']->class_date }} till
                                {{ $details['schedule']->class_end_date }}<br>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <h2 style="padding-top: 25px; line-height: 1; margin:0px;">Need Help?</h2>
                            <div style="margin-bottom: 25px; font-size: 15px;margin-top:7px;">Contact us at
                                info@kingdrivingschool.com or 051-4445444
                            </div>
                        </td>
                    </tr>
                </table>
                <!-- /Child table -->
            </td>
        </tr>
    </table>
    <!-- / Main table -->
</body>

</html>
