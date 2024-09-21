@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4 shadow-sm">
                    <h5 class="mb-4">Edit Car Expense</h5>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.carExpenses.update', $carExpense->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="car_id" class="form-label">Select Car</label>
                            <select name="car_id" class="form-select" required>
                                @foreach ($cars as $car)
                                    <option value="{{ $car->id }}"
                                        {{ $car->id == $carExpense->car_id ? 'selected' : '' }}>
                                        {{ $car->make }} {{ $car->model }} - {{ $car->registration_number }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="expense_type" class="form-label">Expense Type</label>
                            <select name="expense_type" class="form-select" required>
                                <option value="maintenance"
                                    {{ $carExpense->expense_type == 'maintenance' ? 'selected' : '' }}>Maintenance</option>
                                <option value="fuel" {{ $carExpense->expense_type == 'fuel' ? 'selected' : '' }}>Fuel
                                </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount</label>
                            <input type="number" name="amount" class="form-control" step="0.01"
                                value="{{ $carExpense->amount }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="expense_date" class="form-label">Expense Date</label>
                            <input type="date" name="expense_date" class="form-control"
                                value="{{ $carExpense->expense_date }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Expense</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
