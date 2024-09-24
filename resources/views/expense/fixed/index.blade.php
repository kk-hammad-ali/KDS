@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Fixed Expenses</h5>
                        <!-- Add Fixed Expense Button -->
                        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addFixedExpenseModal">
                            Add Fixed Expense
                        </button>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <!-- Fixed Expenses Table -->
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Type</th>
                                <th>Amount</th>
                                <th>Employee (Optional)</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fixedExpenses as $expense)
                                <tr>
                                    <td>{{ $expense->expense_type }}</td>
                                    <td>{{ $expense->amount }}</td>
                                    <td>{{ $expense->employee ? $expense->employee->user->name : 'N/A' }}</td>
                                    <td>{{ ucfirst($expense->status) }}</td>
                                    <td>{{ $expense->expense_date }}</td>
                                    <td>
                                        <!-- Edit Button -->
                                        <button class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editFixedExpenseModal" data-id="{{ $expense->id }}"
                                            data-expense_type="{{ $expense->expense_type }}"
                                            data-amount="{{ $expense->amount }}" data-status="{{ $expense->status }}"
                                            data-expense_date="{{ $expense->expense_date }}"
                                            data-employee_id="{{ $expense->employee_id }}">
                                            Edit
                                        </button>
                                        <a href="{{ route('admin.fixedExpenses.delete', $expense->id) }}"
                                            class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this expense?')">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Salary Expenses Table -->
                    <h5 class="mt-4">Salary Expenses</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Month</th>
                                <th>Salary Amount</th>
                                <th>Status</th>
                                <th>Date Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($salaries as $salary)
                                <tr>
                                    <td>{{ $salary->employee->user->name }}</td>
                                    <td>{{ \Carbon\Carbon::parse($salary->month)->format('F Y') }}</td>
                                    <td>{{ $salary->amount }}</td>
                                    <td>{{ ucfirst($salary->payment_status) }}</td>
                                    <td>{{ $salary->payment_date ? \Carbon\Carbon::parse($salary->payment_date)->format('Y-m-d') : 'Not Paid' }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Fixed Expense Modal -->
    <div class="modal fade" id="addFixedExpenseModal" tabindex="-1" aria-labelledby="addFixedExpenseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addFixedExpenseModalLabel">Add Fixed Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.fixedExpenses.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Expense Type</label>
                            <select class="form-select" id="expense_type" name="expense_type" required>
                                <option value="" disabled selected>Select Expense Type</option>
                                <option value="Rent">Rent</option>
                                <option value="Salary">Salary</option>
                                <option value="Utilities">Utilities</option>
                            </select>
                        </div>

                        <div class="mb-3" id="employee_field" style="display: none;">
                            <label for="employee_id" class="form-label">Select Employee (Only for Salary)</label>
                            <select class="form-select" id="employee_id" name="employee_id">
                                <option value="" selected>No Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount" name="amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" id="status" name="status">
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" class="form-control" id="expense_date" name="expense_date" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Fixed Expense Modal -->
    <div class="modal fade" id="editFixedExpenseModal" tabindex="-1" aria-labelledby="editFixedExpenseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFixedExpenseModalLabel">Edit Fixed Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editFixedExpenseForm" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="expense_type_edit" class="form-label">Expense Type</label>
                            <select class="form-select" id="expense_type_edit" name="expense_type" required>
                                <option value="Rent">Rent</option>
                                <option value="Salary">Salary</option>
                                <option value="Utilities">Utilities</option>
                            </select>
                        </div>

                        <div class="mb-3" id="employee_field_edit" style="display: none;">
                            <label for="employee_id_edit" class="form-label">Select Employee (Only for Salary)</label>
                            <select class="form-select" id="employee_id_edit" name="employee_id">
                                <option value="" selected>No Employee</option>
                                @foreach ($employees as $employee)
                                    <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount_edit" class="form-label">Amount</label>
                            <input type="number" class="form-control" id="amount_edit" name="amount" required>
                        </div>

                        <div class="mb-3">
                            <label for="status_edit" class="form-label">Status</label>
                            <select class="form-select" id="status_edit" name="status">
                                <option value="paid">Paid</option>
                                <option value="unpaid">Unpaid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date_edit" class="form-label">Expense Date</label>
                            <input type="date" class="form-control" id="expense_date_edit" name="expense_date"
                                required>
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

            expenseTypeField.addEventListener('change', function() {
                if (expenseTypeField.value === 'Salary') {
                    employeeField.style.display = 'block';
                } else {
                    employeeField.style.display = 'none';
                }
            });

            var editExpenseTypeField = document.getElementById('expense_type_edit');
            var employeeFieldEdit = document.getElementById('employee_field_edit');

            editExpenseTypeField.addEventListener('change', function() {
                if (editExpenseTypeField.value === 'Salary') {
                    employeeFieldEdit.style.display = 'block';
                } else {
                    employeeFieldEdit.style.display = 'none';
                }
            });

            var editModal = document.getElementById('editFixedExpenseModal');
            editModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;

                var id = button.getAttribute('data-id');
                var expense_type = button.getAttribute('data-expense_type');
                var amount = button.getAttribute('data-amount');
                var status = button.getAttribute('data-status');
                var expense_date = button.getAttribute('data-expense_date');
                var employee_id = button.getAttribute('data-employee_id');

                var form = document.getElementById('editFixedExpenseForm');
                form.action = "/admin/expense/fixed/update/" + id;

                document.getElementById('expense_type_edit').value = expense_type;
                document.getElementById('amount_edit').value = amount;
                document.getElementById('status_edit').value = status;
                document.getElementById('expense_date_edit').value = expense_date;

                if (expense_type === 'Salary') {
                    employeeFieldEdit.style.display = 'block';
                    document.getElementById('employee_id_edit').value = employee_id;
                } else {
                    employeeFieldEdit.style.display = 'none';
                }
            });
        });
    </script>
@endsection
