@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Invoices</h5>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>INV No</th>
                                    <th>Student Name</th>
                                    <th>Instructor Name</th>
                                    <th>Schedule</th>
                                    <th>Invoice Date</th>
                                    <th>Amount Received</th>
                                    <th>Balance</th>
                                    <th>Advance Against</th>
                                    <th>Class Timing</th>
                                    <th>Days</th>
                                    <th>Branch</th>
                                    <th>Receiver's Signature</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoices as $invoice)
                                    <tr>
                                        <td>{{ $invoice->receipt_number }}</td>
                                        <td>{{ $invoice->student->user->name ?? 'N/A' }}</td>
                                        <td>{{ $invoice->instructor->employee->name ?? 'N/A' }}</td>
                                        <td>{{ $invoice->schedule->class_date ?? 'N/A' }}</td>
                                        <td>{{ $invoice->invoice_date }}</td>
                                        <td>{{ number_format($invoice->amount_received, 2) }}</td>
                                        <td>{{ number_format($invoice->balance, 2) }}</td>
                                        <td>{{ $invoice->advance_against ?? 'N/A' }}</td>
                                        <td>{{ $invoice->class_timing ?? 'N/A' }}</td>
                                        <td>{{ $invoice->days ?? 'N/A' }}</td>
                                        <td>{{ $invoice->branch ?? 'N/A' }}</td>
                                        <td>{{ $invoice->receiver_signature ?? 'N/A' }}</td>
                                        <td>
                                            <!-- View Button -->
                                            <a href="{{ route('invoice.show', $invoice->id) }}" class="btn btn-primary">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
