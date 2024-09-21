@extends('layout.admin')

@section('page_content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h3 class="mb-4">Edit Instructor</h3>
                <form action="{{ route('admin.updateInstructor', $instructor->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Instructor Name</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $instructor->user->name) }}" placeholder="Enter instructor's name" required>
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="id_card_number" class="form-label">ID Card Number</label>
                                <input type="text" class="form-control @error('id_card_number') is-invalid @enderror" id="id_card_number" name="id_card_number" value="{{ old('id_card_number', $instructor->id_card_number) }}" placeholder="Enter ID card number" required>
                                @error('id_card_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="license_city" class="form-label">License City</label>
                                <input type="text" class="form-control @error('license_city') is-invalid @enderror" id="license_city" name="license_city" value="{{ old('license_city', $instructor->license_city) }}" placeholder="Enter the city where the license was issued" required>
                                @error('license_city')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="license_number" class="form-label">License Number</label>
                                <input type="text" class="form-control @error('license_number') is-invalid @enderror" id="license_number" name="license_number" value="{{ old('license_number', $instructor->license_number) }}" placeholder="Enter license number" required>
                                @error('license_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="license_start_date" class="form-label">License Start Date</label>
                                <input type="date" class="form-control @error('license_start_date') is-invalid @enderror" id="license_start_date" name="license_start_date" value="{{ old('license_start_date', $instructor->license_start_date) }}" required>
                                @error('license_start_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="license_end_date" class="form-label">License End Date</label>
                                <input type="date" class="form-control @error('license_end_date') is-invalid @enderror" id="license_end_date" name="license_end_date" value="{{ old('license_end_date', $instructor->license_end_date) }}" required>
                                @error('license_end_date')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="experience" class="form-label">Experience</label>
                                <input type="text" class="form-control @error('experience') is-invalid @enderror" id="experience" name="experience" value="{{ old('experience', $instructor->experience) }}" placeholder="Enter years of experience">
                                @error('experience')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" class="form-control @error('phone_number') is-invalid @enderror" id="phone_number" name="phone_number" value="{{ old('phone_number', $instructor->phone_number) }}" placeholder="Enter phone number" required>
                                @error('phone_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $instructor->address) }}" placeholder="Enter address" required>
                                @error('address')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="male" {{ old('gender', $instructor->gender) === 'male' ? 'selected' : '' }}>Male</option>
                                    <option value="female" {{ old('gender', $instructor->gender) === 'female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('gender')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="picture" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control @error('picture') is-invalid @enderror" id="picture" name="picture">
                        @error('picture')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @if($instructor->picture)
                            <img src="{{ asset('storage/' . $instructor->picture) }}" alt="Profile Picture" class="img-thumbnail mt-2" style="width: 100px;">
                        @endif
                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">Update Instructor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
