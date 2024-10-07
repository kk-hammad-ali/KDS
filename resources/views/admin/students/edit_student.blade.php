@extends('layout.admin-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Edit Student</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <!-- Student Edit Form Start -->
        <div class="card">
            <div class="card-body">
                <form id="studentForm" action="{{ route('admin.students.update', $student->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Step 1: Personal Information -->
                    <div class="step-content" id="step-1">
                        <h5>Personal Information</h5>
                        <div class="row gy-20">
                            <div class="col-sm-6">
                                <label for="name" class="h5 mb-8 fw-semibold font-heading">Name <span
                                        class="text-13 text-gray-400 fw-medium">(Required)</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $student->user->name) }}" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="fatherName" class="h5 mb-8 fw-semibold font-heading">Father's Name / Husband's
                                    Name</label>
                                <input type="text"
                                    class="form-control @error('father_or_husband_name') is-invalid @enderror"
                                    id="fatherName" name="father_or_husband_name"
                                    value="{{ old('father_or_husband_name', $student->father_or_husband_name) }}" required>
                                @error('father_or_husband_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="cnic" class="h5 mb-8 fw-semibold font-heading">CNIC No</label>
                                <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                    id="cnic" name="cnic" value="{{ old('cnic', $student->cnic) }}" required>
                                @error('cnic')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="address" class="h5 mb-8 fw-semibold font-heading">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror"
                                    id="address" name="address" value="{{ old('address', $student->address) }}" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="phone" class="h5 mb-8 fw-semibold font-heading">Phone No</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
                                @error('phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="optionalPhone" class="h5 mb-8 fw-semibold font-heading">Optional Phone
                                    No</label>
                                <input type="text" class="form-control @error('optional_phone') is-invalid @enderror"
                                    id="optionalPhone" name="optional_phone"
                                    value="{{ old('optional_phone', $student->optional_phone) }}">
                                @error('optional_phone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email field -->
                            <div class="col-sm-6">
                                <label for="email" class="h5 mb-8 fw-semibold font-heading">Email (Optional)</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $student->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Buttons -->
                    <div class="flex-align justify-content-end gap-8 mt-3">
                        <button type="submit" class="btn btn-main rounded-pill py-9">Update</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Student Edit Form End -->
    </div>
@endsection
