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
                    <li><span class="text-main-600 fw-normal text-15">Edit Employee</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <!-- Employee Form Start -->
        <div class="card">
            <div class="card-body">
                <form id="editEmployeeForm" action="{{ route('admin.updateEmployee', $employee->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <h5 class="mb-24">Edit Employee Information</h5>
                    <div class="row gy-20">
                        <!-- Employee Name -->
                        <div class="col-sm-6">
                            <label for="name" class="h5 mb-8 fw-semibold font-heading">Employee Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $employee->user->name) }}" required>
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employee Email -->
                        <div class="col-sm-6">
                            <label for="email" class="h5 mb-8 fw-semibold font-heading">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" value="{{ old('email', $employee->email) }}" required>
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Employee Phone -->
                        <div class="col-sm-6">
                            <label for="phone" class="h5 mb-8 fw-semibold font-heading">Phone Number</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                name="phone" value="{{ old('phone', $employee->phone) }}" required>
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Address -->
                        <div class="col-sm-6">
                            <label for="address" class="h5 mb-8 fw-semibold font-heading">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                                name="address" value="{{ old('address', $employee->address) }}" required>
                            @error('address')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Salary -->
                        <div class="col-sm-6">
                            <label for="salary" class="h5 mb-8 fw-semibold font-heading">Salary</label>
                            <input type="number" class="form-control @error('salary') is-invalid @enderror" id="salary"
                                name="salary" value="{{ old('salary', $employee->salary) }}" required>
                            @error('salary')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Designation -->
                        <div class="col-sm-6">
                            <label for="designation" class="h5 mb-8 fw-semibold font-heading">Designation</label>
                            <select class="form-select @error('designation') is-invalid @enderror" id="designation"
                                name="designation">
                                <option value="" disabled>Select designation</option>
                                @foreach ($designations as $designation)
                                    <option value="{{ $designation }}"
                                        {{ old('designation', $employee->designation) == $designation ? 'selected' : '' }}>
                                        {{ $designation }}</option>
                                @endforeach
                            </select>
                            @error('designation')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Gender -->
                        <div class="col-sm-6">
                            <label for="gender" class="h5 mb-8 fw-semibold font-heading">Gender</label>
                            <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender"
                                required>
                                <option value="" disabled>Select gender</option>
                                <option value="male" {{ old('gender', $employee->gender) == 'male' ? 'selected' : '' }}>
                                    Male
                                </option>
                                <option value="female"
                                    {{ old('gender', $employee->gender) == 'female' ? 'selected' : '' }}>
                                    Female
                                </option>
                            </select>
                            @error('gender')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Profile Picture -->
                        <div class="col-sm-6">
                            <label for="picture" class="h5 mb-8 fw-semibold font-heading">Upload Picture</label>
                            <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture"
                                name="picture">
                            <small class="form-text text-muted">Leave blank to keep current picture.</small>
                            @error('picture')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- ID Card Number -->
                        <div class="col-sm-6">
                            <label for="id_card_number" class="h5 mb-8 fw-semibold font-heading">ID Card Number</label>
                            <input type="text" class="form-control @error('id_card_number') is-invalid @enderror"
                                id="id_card_number" name="id_card_number"
                                value="{{ old('id_card_number', $employee->id_card_number) }}" required>
                            @error('id_card_number')
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
        <!-- Employee Form End -->
    </div>
@endsection
