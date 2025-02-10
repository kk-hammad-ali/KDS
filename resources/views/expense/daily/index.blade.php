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
                    <li><span class="text-main-600 fw-normal text-15">Daily Expenses</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button type="button" class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addExpenseModal">
                    <i class="ph ph-plus-circle text-xl"></i> Add Daily Expense
                </button>
            </div>

        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="expenseTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Description</th>
                            <th class="h6 text-gray-300">Amount</th>
                            <th class="h6 text-gray-300">Date</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dailyExpenses as $expense)
                            <tr>
                                <td>
                                    <div class="flex-align gap-8">
                                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $expense->description }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ number_format($expense->amount, 2) }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $expense->expense_date }}</span>
                                </td>
                                <td>
                                    <button type="button"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editExpenseModal"
                                        data-id="{{ $expense->id }}" data-description="{{ $expense->description }}"
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
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">
                    Showing {{ $dailyExpenses->firstItem() }} to {{ $dailyExpenses->lastItem() }} of
                    {{ $dailyExpenses->total() }} entries
                </span>

                <!-- Default pagination links -->
                {{ $dailyExpenses->links() }}
            </div>
        </div>

        <!-- Add Expense Modal -->
        <div class="modal fade" id="addExpenseModal" tabindex="-1" aria-labelledby="addExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addExpenseModalLabel">Add Daily Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.dailyExpenses.store') }}" method="POST">
                            @csrf
                            <div class="row">

                                <!-- Description -->
                                <div class="col-sm-12 mb-3">
                                    <label for="description" class="h5 mb-8 fw-semibold font-heading">Description <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="text" name="description" class="form-control"
                                        placeholder="Tea, Dinner, etc." required>
                                </div>

                                <!-- Amount -->
                                <div class="col-sm-12 mb-3">
                                    <label for="amount" class="h5 mb-8 fw-semibold font-heading">Amount <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="number" name="amount" class="form-control" step="0.01" required>
                                </div>

                                <!-- Expense Date -->
                                <div class="col-sm-12 mb-3">
                                    <label for="expense_date" class="h5 mb-8 fw-semibold font-heading">Expense Date <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="date" name="expense_date" class="form-control" required>
                                </div>

                            </div> <!-- End of row -->
                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Daily Expense</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Edit Expense Modal -->
        <div class="modal fade" id="editExpenseModal" tabindex="-1" aria-labelledby="editExpenseModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editExpenseModalLabel">Edit Daily Expense</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editExpenseForm" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <!-- Description -->
                                <div class="col-sm-12 mb-3">
                                    <label for="editDescription" class="h5 mb-8 fw-semibold font-heading">Description
                                        <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="text" name="description" id="editDescription" class="form-control"
                                        required>
                                </div>

                                <!-- Amount -->
                                <div class="col-sm-12 mb-3">
                                    <label for="editAmount" class="h5 mb-8 fw-semibold font-heading">Amount <span
                                            class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="number" name="amount" id="editAmount" class="form-control"
                                        step="0.01" required>
                                </div>

                                <!-- Expense Date -->
                                <div class="col-sm-12 mb-3">
                                    <label for="editExpenseDate" class="h5 mb-8 fw-semibold font-heading">Expense Date
                                        <span class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                    <input type="date" name="expense_date" id="editExpenseDate" class="form-control"
                                        required>
                                </div>

                            </div> <!-- End of row -->
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

    </div>

    <!-- Script for handling edit and delete modals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const editExpenseModal = document.getElementById('editExpenseModal');
            editExpenseModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const id = button.getAttribute('data-id');
                const description = button.getAttribute('data-description');
                const amount = button.getAttribute('data-amount');
                const expense_date = button.getAttribute('data-expense_date');

                const form = document.getElementById('editExpenseForm');
                form.action = "/admin/expense/daily/update/" + id;

                document.getElementById('editDescription').value = description;
                document.getElementById('editAmount').value = amount;
                document.getElementById('editExpenseDate').value = expense_date;
            });

            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const expenseId = button.getAttribute('data-expense-id');
                const deleteForm = document.getElementById('deleteExpenseForm');
                deleteForm.action = `/admin/expense/daily/delete/${expenseId}`;
            });
        });
    </script>
@endsection
