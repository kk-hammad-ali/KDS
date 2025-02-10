<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml"
    xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title>Welcome to King Driving School - Instructor</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,500" rel="stylesheet">
    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
        }

        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }

        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        img {
            -ms-interpolation-mode: bicubic;
        }

        *[x-apple-data-detectors],
        .x-gmail-data-detectors,
        .x-gmail-data-detectors * {
            border-bottom: 0 !important;
            cursor: default !important;
            color: inherit !important;
            text-decoration: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            font-weight: inherit !important;
            line-height: inherit !important;
        }

        .button-td,
        .button-a {
            transition: all 100ms ease-in;
        }

        .button-td:hover,
        .button-a:hover {
            background: #555555 !important;
            border-color: #555555 !important;
        }

        @media only screen and (min-device-width: 375px) and (max-device-width: 413px) {
            .email-container {
                min-width: 375px !important;
            }
        }

        .details-table {
            width: 100%;
            margin-top: 20px;
            color: #333333;
            font-family: 'Montserrat', sans-serif;
        }

        .details-table td {
            padding: 10px;
            font-size: 18px;
        }

        .details-table td.label {
            font-weight: bold;
            color: #0f3462;
        }

        .details-table td.value {
            font-weight: normal;
        }

        .button-td {
            border-radius: 50px;
            background: #26a4d3;
            text-align: center;
        }

        .button-a {
            background: #26a4d3;
            border: 15px solid #26a4d3;
            font-family: 'Montserrat', sans-serif;
            font-size: 16px;
            text-align: center;
            text-decoration: none;
            display: block;
            border-radius: 50px;
            font-weight: bold;
            color: #ffffff;
        }

        .button-a:hover {
            background: #1e8bbd;
        }
    </style>
</head>

<body width="100%" bgcolor="#F7B888" style="margin: 0; mso-line-height-rule: exactly;">
    <center style="width: 100%; background: #F7B888; text-align: left;">
        <div
            style="display:none;font-size:1px;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;mso-hide:all;font-family: sans-serif;">
            Welcome to King Driving School! Your instructor account has been created.
        </div>
        <div style="max-width: 680px; margin: auto;" class="email-container">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" align="center" width="100%"
                style="max-width: 680px;" class="email-container">
                <tr>
                    <td background="{{ $details['background_image'] }}" bgcolor="#F7B888" align="center" valign="top"
                        style="text-align: center; background-position: center center !important; background-size: cover !important;">
                        <div>
                            <table role="presentation" border="0" cellpadding="0" cellspacing="0" align="center"
                                width="100%" style="max-width:500px; margin: auto;">
                                <tr>
                                    <td height="20" style="font-size:20px; line-height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td align="center" valign="middle">
                                        <table>
                                            <tr>
                                                <td valign="top"
                                                    style="text-align: center; padding: 60px 0 10px 20px;">
                                                    <h1
                                                        style="margin: 0; font-family: 'Montserrat', sans-serif; font-size: 30px; line-height: 36px; color: #0f3462; font-weight: bold;">
                                                        Welcome, {{ $details['username'] }}!</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top"
                                                    style="text-align: center; padding: 10px 20px 15px 20px; font-family: sans-serif; font-size: 15px; line-height: 20px; color:#0f3462;">
                                                    <p style="margin: 0;">We’re excited to welcome you as an instructor
                                                        at King Driving School. Here are your login details:</p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td valign="top" align="center" style="padding: 15px 0px 60px 0px;">
                                                    <table role="presentation" align="center" cellspacing="0"
                                                        cellpadding="0" border="0" class="details-table">
                                                        <tr>
                                                            <td class="label">Username:</td>
                                                            <td class="value">{{ $details['username'] }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="label">Password:</td>
                                                            <td class="value">{{ $details['password'] }}</td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="border-radius: 50px; background: #26a4d3; text-align: center;"
                                                    class="button-td">
                                                    <a href="https://kingdrivingschool.com/"
                                                        style="background: #26a4d3; border: 15px solid #26a4d3; font-family: 'Montserrat', sans-serif; font-size: 14px; line-height: 1.1; text-align: center; text-decoration: none; display: block; border-radius: 50px; font-weight: bold;"
                                                        class="button-a"> <span style="color:#ffffff;"
                                                            class="button-link">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;LOGIN TO YOUR
                                                            ACCOUNT&nbsp;&nbsp;&nbsp;&nbsp;
                                                        </span>
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td height="20" style="font-size:20px; line-height:20px;">&nbsp;</td>
                                </tr>
                            </table>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#ffffff">
                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%">
                            <tr>
                                <td align="center"
                                    style="font-family: 'Montserrat', sans-serif; font-size: 14px; padding: 20px;">
                                    <p style="margin: 0;">Thank you for joining King Driving School. We look forward to
                                        working together to promote safe driving.</p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <img src="https://img.icons8.com/dusk/64/000000/car.png" width="37"
                                        height="37" style="display: block; border: 0px;" />
                                </td>
                            </tr>
                            <tr>
                                <td align="center"
                                    style="font-family: 'Montserrat', sans-serif; font-size: 12px; color: #555555; padding: 10px 0;">
                                    <p style="margin: 0;">King Driving School<br> Shoukat Plaza Near Allied Bank. I-10
                                        Markaz Islamabad., Islamabad, Pakistan</p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"
                                    style="font-family: 'Montserrat', sans-serif; font-size: 12px; color: #666666;">
                                    <p style="margin: 0;">Visit us: <a href="https://kingdrivingschool.com"
                                            style="color: #26a4d3;">kingdrivingschool.com</a></p>
                                    <p style="margin: 0;">This email was sent from kingdrivingschool2@gmail.com
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td align="center"
                                    style="font-family: 'Montserrat', sans-serif; font-size: 12px; color: #666666; padding-bottom: 40px;">
                                    <p style="margin: 0;">&copy; 2024 King Driving School, All Rights Reserved.</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </div>
    </center>
</body>

</html>
