@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Invoices</span></li>
                </ul>
            </div>
        </div>

        <!-- Filtering Form -->
        <div class="card mt-24">
            <div class="card-body">
                <form class="search-input-form">
                    <!-- Student Name Input -->
                    <input type="text" id="studentName" class="form-control h6 rounded-4 mb-0 py-6 px-8"
                        placeholder="Enter Student Name">

                    <!-- Date Picker for Invoice Date -->
                    <input type="date" id="invoiceDate" class="form-control h6 rounded-4 mb-0 py-6 px-8 mt-3"
                        placeholder="Select Invoice Date">

                    <button type="button" class="btn btn-main rounded-pill py-9 w-100 mt-3"
                        onclick="filterByDate()">Search</button>
                </form>
            </div>
        </div>

        <br>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="invoiceTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Student Name</th>
                            <th class="h6 text-gray-300">Instructor Name</th>
                            <th class="h6 text-gray-300">Schedule</th>
                            <th class="h6 text-gray-300">Invoice Date</th>
                            <th class="h6 text-gray-300">Amount Received</th>
                            <th class="h6 text-gray-300">Balance</th>
                            <th class="h6 text-gray-300">Branch</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="invoiceTableBody">
                        @foreach ($invoices as $invoice)
                            <tr>
                                <td class="fixed-width">
                                    <div class="form-check">
                                        <input class="form-check-input border-gray-200 rounded-4" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $invoice->schedule->student->user->name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $invoice->schedule->instructor->employee->user->name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $invoice->schedule->class_date ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $invoice->invoice_date }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ number_format($invoice->amount_received, 2) }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ number_format($invoice->balance, 2) }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $invoice->branch ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('invoice.show', $invoice->id) }}"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">View</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <!-- Script to filter the table with live search on Student Name and Date filter -->
    <script>
        // Add event listener for live filtering by student name
        document.getElementById('studentName').addEventListener('input', function() {
            const studentNameInput = this.value.toLowerCase();
            const tableRows = document.querySelectorAll('#invoiceTable tbody tr');

            tableRows.forEach(function(row) {
                const studentName = row.cells[2].innerText.toLowerCase();

                // Show or hide the row based on the student name input
                if (studentName.includes(studentNameInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Filter by invoice date on button click
        function filterByDate() {
            const invoiceDateInput = document.getElementById('invoiceDate').value;
            const tableRows = document.querySelectorAll('#invoiceTable tbody tr');

            tableRows.forEach(function(row) {
                const invoiceDate = row.cells[5].innerText;

                // Show or hide the row based on the date filter
                if (invoiceDateInput && invoiceDate !== invoiceDateInput) {
                    row.style.display = 'none';
                } else if (!invoiceDateInput || invoiceDate === invoiceDateInput) {
                    row.style.display = '';
                }
            });
        }
    </script>
@endsection
