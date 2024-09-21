@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h3 class="mb-4">Edit Instructor</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.updateInstructor', $instructor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- User Data -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Instructor Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $instructor->employee->user->name) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter new password if you want to change">
                                </div>
                            </div>
                        </div>

                        <!-- Employee Data -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        value="{{ old('email', $instructor->employee->email) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        value="{{ old('phone', $instructor->employee->phone) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Address and Salary -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $instructor->employee->address) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" class="form-control" id="salary" name="salary"
                                        value="{{ old('salary', $instructor->employee->salary) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- Instructor Data -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="id_card_number" class="form-label">ID Card Number</label>
                                    <input type="text" class="form-control" id="id_card_number" name="id_card_number"
                                        value="{{ old('id_card_number', $instructor->employee->id_card_number) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_city" class="form-label">License City</label>
                                    <input type="text" class="form-control" id="license_city" name="license_city"
                                        value="{{ old('license_city', $instructor->license_city) }}" required>
                                </div>
                            </div>
                        </div>

                        <!-- License and Experience -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_number" class="form-label">License Number</label>
                                    <input type="text" class="form-control" id="license_number" name="license_number"
                                        value="{{ old('license_number', $instructor->license_number) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_start_date" class="form-label">License Start Date</label>
                                    <input type="date" class="form-control" id="license_start_date"
                                        name="license_start_date"
                                        value="{{ old('license_start_date', $instructor->license_start_date) }}" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_end_date" class="form-label">License End Date</label>
                                    <input type="date" class="form-control" id="license_end_date"
                                        name="license_end_date"
                                        value="{{ old('license_end_date', $instructor->license_end_date) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="experience" class="form-label">Experience (in years)</label>
                                    <input type="text" class="form-control" id="experience" name="experience"
                                        value="{{ old('experience', $instructor->experience) }}">
                                </div>
                            </div>
                        </div>

                        <!-- Gender and Picture -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="male"
                                            {{ old('gender', $instructor->employee->gender) == 'male' ? 'selected' : '' }}>
                                            Male</option>
                                        <option value="female"
                                            {{ old('gender', $instructor->employee->gender) == 'female' ? 'selected' : '' }}>
                                            Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Upload Picture</label>
                                    <input type="file" class="form-control" id="picture" name="picture">
                                    @if ($instructor->employee->picture)
                                        <img src="{{ asset('storage/' . $instructor->employee->picture) }}"
                                            class="img-thumbnail mt-2" style="width: 100px;">
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary w-75">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
