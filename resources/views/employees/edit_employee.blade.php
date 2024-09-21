@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h3 class="mb-4">Edit Employee</h3>
                    <form action="{{ route('admin.updateEmployee', $employee->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Employee Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter employee name"
                                        value="{{ old('name', $employee->user->name) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter employee email" value="{{ old('email', $employee->email) }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter phone number" value="{{ old('phone', $employee->phone) }}"
                                        required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter address" value="{{ old('address', $employee->address) }}"
                                        required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" class="form-control" id="salary" name="salary"
                                        placeholder="Enter salary" value="{{ old('salary', $employee->salary) }}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="designation" class="form-label">Designation</label>
                                    <select class="form-select" id="designation" name="designation">
                                        <option value="" disabled>Select designation</option>
                                        @foreach ($designations as $designation)
                                            <option value="{{ $designation }}"
                                                {{ $employee->designation == $designation ? 'selected' : '' }}>
                                                {{ $designation }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="" disabled>Select gender</option>
                                        <option value="male" {{ $employee->gender == 'male' ? 'selected' : '' }}>Male
                                        </option>
                                        <option value="female" {{ $employee->gender == 'female' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Upload Picture</label>
                                    <input type="file" class="form-control" id="picture" name="picture">
                                    <small class="form-text text-muted">Leave blank to keep current picture.</small>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="id_card_number" class="form-label">ID Card Number</label>
                                    <input type="text" class="form-control" id="id_card_number" name="id_card_number"
                                        placeholder="Enter ID card number"
                                        value="{{ old('id_card_number', $employee->id_card_number) }}" required>
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
