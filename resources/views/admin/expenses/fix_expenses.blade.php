@extends('layout.admin')

@section('page_content')

<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-5">
            <label for="expenseType" class="form-label">Select Expense Type</label>
            <select id="expenseType" class="form-select">
                <option selected>Select expense...</option>
                <option value="salary">Salary</option>
                <option value="rent">Rent</option>
                <option value="utilities">Utilities</option>
                <!-- Add more options as needed -->
            </select>
        </div>
        <div class="col-md-6 d-flex align-items-end">
            <div class="w-100 me-2">
                <label for="expenseAmount" class="form-label">Expense Amount</label>
                <input type="number" class="form-control" id="expenseAmount" placeholder="Enter amount">
            </div>
            <button class="btn btn-primary" id="addExpenseBtn">
                <i class="fas fa-plus"></i>
            </button>
        </div>

    </div>

    <!-- Expense DataTable -->
    <div class="row">
        <div class="col-12">
            <table id="expenseTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>Expense Type</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Salary</td>
                        <td>$2000</td>
                        <td>2024-08-01</td>
                    </tr>
                    <tr>
                        <td>Rent</td>
                        <td>$1500</td>
                        <td>2024-08-05</td>
                    </tr>
                    <tr>
                        <td>Utilities</td>
                        <td>$300</td>
                        <td>2024-08-10</td>
                    </tr>
                    <!-- Add more static data rows as needed -->
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

{{-- @section('scripts')
<script>
    // Initialize DataTable (if not already included in your admin template)
    $(document).ready(function() {
        $('#expenseTable').DataTable();
    });
</script>
@endsection --}}
