@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h3 class="mb-4">Edit Student</h3>
                    <form id="studentForm" action="{{ route('admin.students.update', $student->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                        id="name" name="name" value="{{ old('name', $student->user->name) }}"
                                        required>
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="fatherName" class="form-label">Father's Name / Husband's Name</label>
                                    <input type="text"
                                        class="form-control @error('father_or_husband_name') is-invalid @enderror"
                                        id="fatherName" name="father_or_husband_name"
                                        value="{{ old('father_or_husband_name', $student->father_or_husband_name) }}"
                                        required>
                                    @error('father_or_husband_name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="cnic" class="form-label">CNIC No</label>
                                    <input type="text" class="form-control @error('cnic') is-invalid @enderror"
                                        id="cnic" name="cnic" value="{{ old('cnic', $student->cnic) }}" required>
                                    @error('cnic')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control @error('address') is-invalid @enderror"
                                        id="address" name="address" value="{{ old('address', $student->address) }}"
                                        required>
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone No</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" value="{{ old('phone', $student->phone) }}" required>
                                    @error('phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="optionalPhone" class="form-label">Optional Phone No</label>
                                    <input type="text" class="form-control @error('optional_phone') is-invalid @enderror"
                                        id="optionalPhone" name="optional_phone"
                                        value="{{ old('optional_phone', $student->optional_phone) }}">
                                    @error('optional_phone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
