@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Daily Expenses</h5>
                        <a href="{{ route('admin.dailyExpenses.create') }}" class="btn btn-primary">Add New Daily Expense</a>
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
                                            <a href="{{ route('admin.dailyExpenses.edit', $expense->id) }}"
                                                class="btn btn-sm btn-warning">Edit</a>
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
@endsection
