@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="receipt-main">
                        <div class="row d-flex justify-content-between">
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="receipt-left">
                                    <h3>INVOICE # {{ $invoice->receipt_number }}</h3>
                                </div>
                            </div>

                            <div class="col-xs-4 col-sm-4 col-md-4 text-right">
                                <div class="receipt-right">
                                    <img class="img-responsive mb-2" alt="Company Logo"
                                        src="{{ asset('public/images/logo.png') }}" style="width: 71px;">
                                    <h5 class="mb-2">King Driving School </h5>
                                    <p class="mb-1">051-4445444 <i class="fa fa-phone"></i></p>
                                    <p class="mb-1">info@kingdrivingschool.com <i class="fa fa-envelope-o"></i></p>
                                    <p class="mb-1">Branch I-10 <i class="fa fa-envelope-o"></i></p>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col-md-8">
                                <!-- Student Details -->
                                <div class="receipt-right">
                                    <h5>{{ $invoice->student->user->name ?? 'Customer Name' }}</h5>
                                    <p><b>Mobile:</b> {{ $invoice->student->phone ?? '+1 12345-4569' }}</p>
                                    <p><b>CNIC:</b> {{ $invoice->student->cnic ?? '12345-6789012-3' }}</p>
                                    <p><b>Address:</b> {{ $invoice->student->address ?? 'New York, USA' }}</p>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Instructor Details -->
                                <div class="receipt-right">
                                    <h5>{{ $invoice->instructor->employee->user->name ?? 'Instructor Name' }}</h5>
                                    <p><b>Mobile:</b> {{ $invoice->instructor->employee->phone ?? '+1 98765-43210' }}</p>
                                    <p><b>License Number:</b> {{ $invoice->instructor->license_number ?? '123456789' }}</p>
                                    <p><b>Experience:</b> {{ $invoice->instructor->experience ?? '5 Years' }}</p>
                                </div>
                            </div>
                        </div>


                        <div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Advance Against: {{ $invoice->advance_against ?? 'N/A' }}</td>
                                        <td>${{ number_format($invoice->amount_received, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Class Timing: {{ $invoice->class_timing ?? 'N/A' }}</td>
                                        <td>{{ $invoice->days ?? 'N/A' }} Days</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right">
                                            <p><strong>Total Amount:</strong></p>
                                            <p><strong>Balance:</strong></p>
                                        </td>
                                        <td>
                                            <p><strong>${{ number_format($invoice->amount_received, 2) }}</strong></p>
                                            <p><strong>${{ number_format($invoice->balance, 2) }}</strong></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="row">
                            <div class="receipt-header receipt-header-mid receipt-footer">
                                <div class="col-xs-8 col-sm-8 col-md-8 text-left">
                                    <div class="receipt-right">
                                        <p><b>Date:</b>
                                            {{ \Carbon\Carbon::parse($invoice->invoice_date)->format('d M Y') }}</p>
                                        <h5 style="color: rgb(140, 140, 140);">Thank you for your business!</h5>
                                    </div>
                                </div>
                                {{-- <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="receipt-left">
                                        <h1>Stamp</h1>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
