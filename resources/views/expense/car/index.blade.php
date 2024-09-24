@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Car Expenses</h5>
                        <!-- Trigger for add modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#addCarExpenseModal">
                            Add New Car Expense
                        </button>
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
                                    <th>Car</th>
                                    <th>Expense Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
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
                                            <!-- Edit button trigger modal -->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editCarExpenseModal" data-id="{{ $expense->id }}"
                                                data-car_id="{{ $expense->car_id }}"
                                                data-expense_type="{{ $expense->expense_type }}"
                                                data-amount="{{ $expense->amount }}"
                                                data-expense_date="{{ $expense->expense_date }}">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.carExpenses.delete', $expense->id) }}"
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this expense?')">Delete</a>
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

    <!-- Add Car Expense Modal -->
    <div class="modal fade" id="addCarExpenseModal" tabindex="-1" aria-labelledby="addCarExpenseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCarExpenseModalLabel">Add Car Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding a car expense -->
                    <form action="{{ route('admin.carExpenses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="car_id" class="form-label">Select Car</label>
                            <select name="car_id" class="form-control" required>
                                <option value="" disabled selected>Select a car</option>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Expense Type</label>
                            <select name="expense_type" class="form-control" required>
                                <option value="maintenance">Maintenance</option>
                                <option value="fuel">Fuel</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Car Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Car Expense Modal -->
    <div class="modal fade" id="editCarExpenseModal" tabindex="-1" aria-labelledby="editCarExpenseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
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
                        <div class="mb-3">
                            <label for="car_id" class="form-label">Select Car</label>
                            <select name="car_id" id="editCarId" class="form-control" required>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}">{{ $car->make }} {{ $car->model }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Expense Type</label>
                            <select name="expense_type" id="editExpenseType" class="form-control" required>
                                <option value="maintenance">Maintenance</option>
                                <option value="fuel">Fuel</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="editAmount" class="form-control" step="0.01"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" id="editExpenseDate" class="form-control"
                                required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Car Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        var editCarExpenseModal = document.getElementById('editCarExpenseModal');
        editCarExpenseModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var id = button.getAttribute('data-id');
            var car_id = button.getAttribute('data-car_id');
            var expense_type = button.getAttribute('data-expense_type');
            var amount = button.getAttribute('data-amount');
            var expense_date = button.getAttribute('data-expense_date');

            // Update the form action
            var form = document.getElementById('editCarExpenseForm');
            form.action = "/admin/expense/car/update/" + id;

            // Update modal input values
            document.getElementById('editCarId').value = car_id;
            document.getElementById('editExpenseType').value = expense_type;
            document.getElementById('editAmount').value = amount;
            document.getElementById('editExpenseDate').value = expense_date;
        });
    </script>
@endsection
