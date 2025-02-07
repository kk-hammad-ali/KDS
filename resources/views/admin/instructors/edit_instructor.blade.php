@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Edit Instructor</span></li>
                </ul>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.updateInstructor', $instructor->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="name" class="form-label">Instructor Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name', $instructor->employee->user->name) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Enter new password if you want to change">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email', $instructor->employee->email) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ old('phone', $instructor->employee->phone) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address', $instructor->employee->address) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="salary" class="form-label">Salary</label>
                            <input type="number" class="form-control" id="salary" name="salary"
                                value="{{ old('salary', $instructor->employee->salary) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="id_card_number" class="form-label">ID Card Number</label>
                            <input type="text" class="form-control" id="id_card_number" name="id_card_number"
                                value="{{ old('id_card_number', $instructor->employee->id_card_number) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="license_city" class="form-label">License City</label>
                            <input type="text" class="form-control" id="license_city" name="license_city"
                                value="{{ old('license_city', $instructor->license_city) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="license_number" class="form-label">License Number</label>
                            <input type="text" class="form-control" id="license_number" name="license_number"
                                value="{{ old('license_number', $instructor->license_number) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="license_start_date" class="form-label">License Start Date</label>
                            <input type="date" class="form-control" id="license_start_date" name="license_start_date"
                                value="{{ old('license_start_date', $instructor->license_start_date) }}" required>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="license_end_date" class="form-label">License End Date</label>
                            <input type="date" class="form-control" id="license_end_date" name="license_end_date"
                                value="{{ old('license_end_date', $instructor->license_end_date) }}" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="experience" class="form-label">Experience (in years)</label>
                            <input type="text" class="form-control" id="experience" name="experience"
                                value="{{ old('experience', $instructor->experience) }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-select" id="gender" name="gender" required>
                                <option value="male"
                                    {{ old('gender', $instructor->employee->gender) == 'male' ? 'selected' : '' }}>Male
                                </option>
                                <option value="female"
                                    {{ old('gender', $instructor->employee->gender) == 'female' ? 'selected' : '' }}>Female
                                </option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="branch_id" class="h5 mb-8 fw-semibold font-heading">Assign Branch</label>
                            <select class="form-select @error('branch_id') is-invalid @enderror" id="branch_id"
                                name="branch_id" required>
                                <option value="" disabled>Select branch</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        {{ old('branch_id', $instructor->employee->branch->name) == $branch->id ? 'selected' : '' }}>
                                        {{ $branch->name }}</option>
                                @endforeach
                            </select>
                            @error('branch_id')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-lg-6">
                            <label for="picture" class="form-label">Upload Picture</label>
                            <input type="file" class="form-control" id="picture" name="picture">
                            @if ($instructor->employee->picture)
                                <img src="{{ asset('storage/' . $instructor->employee->picture) }}"
                                    class="img-thumbnail mt-2" style="width: 100px;">
                            @endif
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
@endsection
