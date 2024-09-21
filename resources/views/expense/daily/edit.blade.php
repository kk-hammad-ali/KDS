@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <h5 class="mb-4">Edit Daily Expense</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.dailyExpenses.update', $dailyExpense->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control"
                                value="{{ $dailyExpense->description }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01"
                                value="{{ $dailyExpense->amount }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" class="form-control"
                                value="{{ $dailyExpense->expense_date }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
