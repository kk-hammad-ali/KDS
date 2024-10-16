<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Invoice - King Driving School</title>
    <!-- Google Fonts (Poppins) -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f7f7f7;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            color: #555;
            position: relative;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }

        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }

        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        .invoice-box .logo {
            max-width: 150px;
        }

        .buttons {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .text-center {
            text-align: center;
        }

        /* Ensure page breaks when generating PDFs */
        @media print {

            body,
            .invoice-box {
                margin: 0;
                box-shadow: none;
            }

            /* Hide the buttons when printing */
            .buttons {
                display: none;
            }
        }

        /* Hide the buttons for PDF generation */
        .no-print {
            display: none;
        }
    </style>
</head>

<body>

    <div class="invoice-box">
        <div class="buttons">
            <button class="btn btn-primary no-print" onclick="window.print();">Print Invoice</button>
            <button class="btn btn-secondary no-print" onclick="downloadPDF();">Download Invoice</button>
        </div>
        <br>

        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                <img src="{{ asset('main/images/logo.png') }}" class="logo"
                                    alt="King Driving School Logo">
                            </td>
                            <td>
                                <strong>Invoice #: {{ $invoice->receipt_number }}</strong><br>
                                <strong>Invoice Date:</strong>
                                {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                King Driving School<br>
                                Shoukat Plaza Near Allied Bank, I-10 Markaz Islamabad
                            </td>
                            <td>
                                <strong>Paid By:</strong> {{ $invoice->paid_by ?? 'N/A' }}<br>
                                <strong>Branch:</strong> {{ $invoice->branch ?? 'N/A' }}<br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>Description</td>
                <td>Amount</td>
            </tr>

            <tr class="item">
                <td>{{ $invoice->description ?? 'Driving Lesson Package' }}</td>
                <td>${{ number_format($invoice->amount_received, 2) }}</td>
            </tr>

            <tr class="total">
                <td></td>
                <td>Total: ${{ number_format($invoice->amount_received, 2) }}</td>
            </tr>

            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Amount Received: {{ $invoice->amount_in_words }}<br>
                                Date: {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <footer class="text-center mt-5">
            <p>Thank you for your business!</p>
        </footer>
    </div>

    <!-- JavaScript for PDF Download -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.3/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPDF() {
            var element = document.querySelector('.invoice-box');
            var opt = {
                margin: 0,
                filename: 'invoice_{{ $invoice->id }}.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 2
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'portrait'
                }
            };
            html2pdf().from(element).set(opt).toPdf().get('pdf').then(function(pdf) {
                pdf.internal.pageSize.height = pdf.internal.pageSize.height + 10; // Adjust for page size
            }).save();
        }
    </script>

</body>

</html>
