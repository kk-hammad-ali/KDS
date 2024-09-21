@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <h3>Edit Fixed Expense</h3>

                    <form action="{{ route('admin.fixedExpenses.update', $fixedExpense->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Expense Type</label>
                            <select class="form-select" id="expense_type" name="expense_type" required>
                                <option value="" disabled>Select Expense Type</option>
                                <option value="Rent" {{ $fixedExpense->expense_type == 'Rent' ? 'selected' : '' }}>Rent
                                </option>
                                <option value="Salary" {{ $fixedExpense->expense_type == 'Salary' ? 'selected' : '' }}>
                                    Salary</option>
                                <option value="Utilities"
                                    {{ $fixedExpense->expense_type == 'Utilities' ? 'selected' : '' }}>Utilities</option>
                            </select>
                        </div>

                        <div class="mb-3" id="employee_field">
                            <label for="employee_id" class="form-label">Select Employee (Only for Salary)</label>
                            <select class="form-select" id="employee_id" name="employee_id">
                                <option value="" selected>No Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}"
                                        {{ old('employee_id', $fixedExpense->employee_id) == $employee->id ? 'selected' : '' }}>
                                        {{ $employee->user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount"
                                value="{{ old('amount', $fixedExpense->amount) }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="paid"
                                    {{ old('status', $fixedExpense->status) == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="unpaid"
                                    {{ old('status', $fixedExpense->status) == 'unpaid' ? 'selected' : '' }}>Unpaid
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" class="form-control" id="expense_date" name="expense_date"
                                value="{{ old('expense_date', $fixedExpense->expense_date) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Expense</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var expenseTypeField = document.getElementById('expense_type');
            var employeeField = document.getElementById('employee_field');

            // Show or hide employee field based on the existing expense type
            if (expenseTypeField.value === 'Salary') {
                employeeField.style.display = 'block'; // Show employee dropdown
            } else {
                employeeField.style.display = 'none'; // Hide employee dropdown
            }

            // Show or hide employee field based on changes to the expense type
            expenseTypeField.addEventListener('change', function() {
                if (expenseTypeField.value === 'Salary') {
                    employeeField.style.display = 'block'; // Show employee dropdown
                } else {
                    employeeField.style.display = 'none'; // Hide employee dropdown
                }
            });
        });
    </script>
@endsection
