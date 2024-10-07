@extends('layout.admin-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Fixed Expenses</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button type="button" class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addFixedExpenseModal">
                    <i class="ph ph-plus-circle text-xl"></i> Add Fixed Expense
                </button>
            </div>
        </div>

        <!-- Card with table -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="fixedExpenseTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Type</th>
                            <th class="h6 text-gray-300">Amount</th>
                            <th class="h6 text-gray-300">Employee (Optional)</th>
                            <th class="h6 text-gray-300">Status</th>
                            <th class="h6 text-gray-300">Date</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($fixedExpenses as $expense)
                            <tr>
                                <td>{{ $expense->expense_type }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ $expense->employee ? $expense->employee->user->name : 'N/A' }}</td>
                                <td>{{ ucfirst($expense->status) }}</td>
                                <td>{{ $expense->expense_date }}</td>
                                <td>
                                    <button type="button"
                                        class="bg-warning text-white py-2 px-14 rounded-pill hover-bg-warning-600"
                                        data-bs-toggle="modal" data-bs-target="#editFixedExpenseModal"
                                        data-id="{{ $expense->id }}" data-expense_type="{{ $expense->expense_type }}"
                                        data-amount="{{ $expense->amount }}" data-status="{{ $expense->status }}"
                                        data-expense_date="{{ $expense->expense_date }}"
                                        data-employee_id="{{ $expense->employee_id }}">
                                        Edit
                                    </button>

                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-expense-id="{{ $expense->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Add Fixed Expense Modal -->
        <div class="modal fade" id="addFixedExpenseModal" tabindex="-1" aria-labelledby="addFixedExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addFixedExpenseModalLabel">Add Fixed Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.fixedExpenses.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Expense Type -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_type" class="h5 mb-8 fw-semibold font-heading">Expense Type <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select class="form-select @error('expense_type') is-invalid @enderror"
                                        id="expense_type" name="expense_type" required>
                                        <option value="" disabled selected>Select Expense Type</option>
                                        <option value="Rent">Rent</option>
                                        <option value="Salary">Salary</option>
                                        <option value="Utilities">Utilities</option>
                                    </select>
                                    @error('expense_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Employee Field (Only for Salary) -->
                                <div class="col-sm-12 mb-3" id="employee_field" style="display: none;">
                                    <label for="employee_id" class="h5 mb-8 fw-semibold font-heading">Select Employee (Only
                                        for Salary)</label>
                                    <select class="form-select @error('employee_id') is-invalid @enderror" id="employee_id"
                                        name="employee_id">
                                        <option value="" selected>No Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="col-sm-12 mb-3">
                                    <label for="amount" class="h5 mb-8 fw-semibold font-heading">Amount <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                        id="amount" name="amount" required>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-sm-12 mb-3">
                                    <label for="status" class="h5 mb-8 fw-semibold font-heading">Status <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status"
                                        name="status" required>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expense Date -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_date" class="h5 mb-8 fw-semibold font-heading">Expense Date <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="date" class="form-control @error('expense_date') is-invalid @enderror"
                                        id="expense_date" name="expense_date" required>
                                    @error('expense_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Fixed Expense</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Fixed Expense Modal -->
        <div class="modal fade" id="editFixedExpenseModal" tabindex="-1" aria-labelledby="editFixedExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editFixedExpenseModalLabel">Edit Fixed Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editFixedExpenseForm" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Expense Type -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_type_edit" class="h5 mb-8 fw-semibold font-heading">Expense Type
                                        <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select class="form-select @error('expense_type') is-invalid @enderror"
                                        id="expense_type_edit" name="expense_type" required>
                                        <option value="Rent">Rent</option>
                                        <option value="Salary">Salary</option>
                                        <option value="Utilities">Utilities</option>
                                    </select>
                                    @error('expense_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Employee Field (Only for Salary) -->
                                <div class="col-sm-12 mb-3" id="employee_field_edit" style="display: none;">
                                    <label for="employee_id_edit" class="h5 mb-8 fw-semibold font-heading">Select Employee
                                        (Only
                                        for Salary)</label>
                                    <select class="form-select @error('employee_id') is-invalid @enderror"
                                        id="employee_id_edit" name="employee_id">
                                        <option value="" selected>No Employee</option>
                                        @foreach ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->user->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('employee_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="col-sm-12 mb-3">
                                    <label for="amount_edit" class="h5 mb-8 fw-semibold font-heading">Amount <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="number" class="form-control @error('amount') is-invalid @enderror"
                                        id="amount_edit" name="amount" required>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Status -->
                                <div class="col-sm-12 mb-3">
                                    <label for="status_edit" class="h5 mb-8 fw-semibold font-heading">Status <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select class="form-select @error('status') is-invalid @enderror" id="status_edit"
                                        name="status" required>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expense Date -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_date_edit" class="h5 mb-8 fw-semibold font-heading">Expense Date
                                        <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="date" class="form-control @error('expense_date') is-invalid @enderror"
                                        id="expense_date_edit" name="expense_date" required>
                                    @error('expense_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this expense?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteExpenseForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- JavaScript -->
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

                // Delete modal
                var deleteModal = document.getElementById('deleteModal');
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const expenseId = button.getAttribute('data-expense-id');
                    const deleteForm = document.getElementById('deleteExpenseForm');
                    deleteForm.action = `/admin/expense/fixed/delete/${expenseId}`;
                });
            });
        </script>
    </div>
@endsection
