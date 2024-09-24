@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Daily Expenses</h5>
                        <!-- Trigger for add modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                            Add New Daily Expense
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
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($dailyExpenses as $expense)
                                    <tr>
                                        <td>{{ $expense->description }}</td>
                                        <td>{{ number_format($expense->amount, 2) }}</td>
                                        <td>{{ $expense->expense_date }}</td>
                                        <td>
                                            <!-- Edit button trigger modal -->
                                            <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editExpenseModal" data-id="{{ $expense->id }}"
                                                data-description="{{ $expense->description }}"
                                                data-amount="{{ $expense->amount }}"
                                                data-expense_date="{{ $expense->expense_date }}">
                                                Edit
                                            </button>
                                            <a href="{{ route('admin.dailyExpenses.delete', $expense->id) }}"
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

    <!-- Add Expense Modal -->
    <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addExpenseModalLabel">Add Daily Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for adding an expense -->
                    <form action="{{ route('admin.dailyExpenses.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" placeholder="Tea, Dinner, etc."
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Expense Modal -->
    <div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editExpenseModalLabel">Edit Daily Expense</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Form for editing an expense -->
                    <form id="editExpenseForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" id="editDescription" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" id="editAmount" class="form-control" step="0.01"
                                required>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" id="editExpenseDate" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        var editExpenseModal = document.getElementById('editExpenseModal');
        editExpenseModal.addEventListener('show.bs.modal', function(event) {
            // Button that triggered the modal
            var button = event.relatedTarget;

            // Extract info from data-* attributes
            var id = button.getAttribute('data-id');
            var description = button.getAttribute('data-description');
            var amount = button.getAttribute('data-amount');
            var expense_date = button.getAttribute('data-expense_date');

            // Update the form action
            var form = document.getElementById('editExpenseForm');
            form.action = "/admin/expense/daily/update/" + id;

            // Update modal input values
            document.getElementById('editDescription').value = description;
            document.getElementById('editAmount').value = amount;
            document.getElementById('editExpenseDate').value = expense_date;
        });
    </script>
@endsection
