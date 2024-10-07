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
                    <li><span class="text-main-600 fw-normal text-15">Car Expenses</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button type="button" class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCarExpenseModal">
                    <i class="ph ph-plus-circle text-xl"></i> Add Car Expense
                </button>
            </div>
        </div>

        <!-- Card with table -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="carExpenseTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">Car</th>
                            <th class="h6 text-gray-300">Expense Type</th>
                            <th class="h6 text-gray-300">Amount</th>
                            <th class="h6 text-gray-300">Date</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($carExpenses as $expense)
                            <tr>
                                <td>{{ $expense->car->make }} {{ $expense->car->model }}</td>
                                <td>{{ ucfirst($expense->expense_type) }}</td>
                                <td>{{ number_format($expense->amount, 2) }}</td>
                                <td>{{ $expense->expense_date }}</td>
                                <td>
                                    <!-- Edit and Delete buttons -->
                                    <button type="button"
                                        class="bg-warning text-white py-2 px-14 rounded-pill hover-bg-warning-600"
                                        data-bs-toggle="modal" data-bs-target="#editCarExpenseModal"
                                        data-id="{{ $expense->id }}" data-car_id="{{ $expense->car_id }}"
                                        data-expense_type="{{ $expense->expense_type }}"
                                        data-amount="{{ $expense->amount }}"
                                        data-expense_date="{{ $expense->expense_date }}">Edit</button>

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

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this car expense?
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

        <!-- Add Car Expense Modal -->
        <div class="modal fade" id="addCarExpenseModal" tabindex="-1" aria-labelledby="addCarExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCarExpenseModalLabel">Add Car Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for adding a car expense -->
                        <form action="{{ route('admin.carExpenses.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <!-- Select Car -->
                                <div class="col-sm-12 mb-3">
                                    <label for="car_id" class="h5 mb-8 fw-semibold font-heading">Select Car <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select name="car_id" class="form-select @error('car_id') is-invalid @enderror"
                                        required>
                                        <option value="" disabled selected>Select a car</option>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('car_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expense Type -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_type" class="h5 mb-8 fw-semibold font-heading">Expense Type <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select name="expense_type"
                                        class="form-select @error('expense_type') is-invalid @enderror" required>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="fuel">Fuel</option>
                                    </select>
                                    @error('expense_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="col-sm-12 mb-3">
                                    <label for="amount" class="h5 mb-8 fw-semibold font-heading">Amount <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="number" name="amount"
                                        class="form-control @error('amount') is-invalid @enderror" step="0.01"
                                        required>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expense Date -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_date" class="h5 mb-8 fw-semibold font-heading">Expense Date <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="date" name="expense_date"
                                        class="form-control @error('expense_date') is-invalid @enderror" required>
                                    @error('expense_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Car Expense</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Car Expense Modal -->
        <div class="modal fade" id="editCarExpenseModal" tabindex="-1" aria-labelledby="editCarExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCarExpenseModalLabel">Edit Car Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Form for editing a car expense -->
                        <form id="editCarExpenseForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <!-- Select Car -->
                                <div class="col-sm-12 mb-3">
                                    <label for="car_id" class="h5 mb-8 fw-semibold font-heading">Select Car <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select name="car_id" id="editCarId"
                                        class="form-select @error('car_id') is-invalid @enderror" required>
                                        @foreach ($cars as $car)
                                            <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('car_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expense Type -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_type" class="h5 mb-8 fw-semibold font-heading">Expense Type <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <select name="expense_type" id="editExpenseType"
                                        class="form-select @error('expense_type') is-invalid @enderror" required>
                                        <option value="maintenance">Maintenance</option>
                                        <option value="fuel">Fuel</option>
                                    </select>
                                    @error('expense_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Amount -->
                                <div class="col-sm-12 mb-3">
                                    <label for="amount" class="h5 mb-8 fw-semibold font-heading">Amount <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="number" name="amount" id="editAmount"
                                        class="form-control @error('amount') is-invalid @enderror" step="0.01"
                                        required>
                                    @error('amount')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Expense Date -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_date" class="h5 mb-8 fw-semibold font-heading">Expense Date <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="date" name="expense_date" id="editExpenseDate"
                                        class="form-control @error('expense_date') is-invalid @enderror" required>
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

        <!-- Script to handle Edit and Delete Modals -->
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editCarExpenseModal = document.getElementById('editCarExpenseModal');
                const deleteModal = document.getElementById('deleteModal');

                // Edit modal
                editCarExpenseModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const id = button.getAttribute('data-id');
                    const car_id = button.getAttribute('data-car_id');
                    const expense_type = button.getAttribute('data-expense_type');
                    const amount = button.getAttribute('data-amount');
                    const expense_date = button.getAttribute('data-expense_date');

                    const form = document.getElementById('editCarExpenseForm');
                    form.action = `/admin/expense/car/update/${id}`;

                    document.getElementById('editCarId').value = car_id;
                    document.getElementById('editExpenseType').value = expense_type;
                    document.getElementById('editAmount').value = amount;
                    document.getElementById('editExpenseDate').value = expense_date;
                });

                // Delete modal
                deleteModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const expenseId = button.getAttribute('data-expense-id');
                    const deleteForm = document.getElementById('deleteExpenseForm');
                    deleteForm.action = `/admin/expense/car/delete/${expenseId}`;
                });
            });
        </script>
    </div>
@endsection
