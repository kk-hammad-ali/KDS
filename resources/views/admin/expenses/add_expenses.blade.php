@extends('layout.admin')

@section('page_content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h3 class="mb-4">Add Expense</h3>
                <form action="{{ route('admin.expenses.store') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">Expense Type</label>
                                <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                    <option value="" disabled selected>Select Expense Type</option>
                                    <option value="rent" {{ old('type') == 'rent' ? 'selected' : '' }}>Rent</option>
                                    <option value="salary" {{ old('type') == 'salary' ? 'selected' : '' }}>Salary</option>
                                    <option value="utilities" {{ old('type') == 'utilities' ? 'selected' : '' }}>Utilities</option>
                                    <option value="bills" {{ old('type') == 'bills' ? 'selected' : '' }}>Bills</option>
                                </select>
                                @error('type')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">Amount</label>
                                <input type="number" step="0.01" class="form-control @error('amount') is-invalid @enderror" id="amount" name="amount" value="{{ old('amount') }}" placeholder="Enter expense amount" required>
                                @error('amount')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description (Optional)</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Enter a brief description">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-75">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
