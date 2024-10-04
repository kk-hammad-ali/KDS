<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Completion</title>
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
                            <h1 style="margin: 0px;padding-bottom: 25px; text-transform: uppercase;">Congratulations!
                            </h1>
                            <p style="margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">
                                Dear {{ $details['student']->user->name }},<br>
                                Congratulations on completing your driving course at King Driving School! Attached is
                                your completion certificate.
                            </p>
                            <p style="margin: 0px 40px;padding-bottom: 25px;line-height: 2; font-size: 15px;">
                                We wish you all the best in your driving journey!
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align:center;">
                            <h2 style="padding-top: 25px; line-height: 1; margin:0px;">Need Help?</h2>
                            <div style="margin-bottom: 25px; font-size: 15px;margin-top:7px;">Contact us at
                                info@kingdrivingschool.com or 051-4445444</div>
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
