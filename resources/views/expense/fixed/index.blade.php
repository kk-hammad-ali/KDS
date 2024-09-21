@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="mb-0">Fixed Expenses</h5>
                        <a href="{{ route('admin.fixedExpenses.create') }}" class="btn btn-primary mb-3">Add Fixed Expense</a>
                    </div>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif



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
                                        <a href="{{ route('admin.fixedExpenses.edit', $expense->id) }}"
                                            class="btn btn-warning">Edit</a>
                                        <a href="{{ route('admin.fixedExpenses.delete', $expense->id) }}"
                                            class="btn btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
@endsection
