@extends('layout.admin')

@section('page_content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h3 class="mb-4">Edit Car</h3>
                <form action="{{ route('admin.updateCar', $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="make" class="form-label">Make</label>
                                <input type="text" class="form-control @error('make') is-invalid @enderror" id="make" name="make" value="{{ old('make', $car->make) }}" placeholder="Enter car make" required>
                                @error('make')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="model" class="form-label">Model</label>
                                <input type="number" class="form-control @error('model') is-invalid @enderror" id="model" name="model" value="{{ old('model', $car->model) }}" placeholder="Enter car model" required>
                                @error('model')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="registration_number" class="form-label">Registration Number</label>
                                <input type="text" class="form-control @error('registration_number') is-invalid @enderror" id="registration_number" name="registration_number" value="{{ old('registration_number', $car->registration_number) }}" placeholder="Enter registration number" required>
                                @error('registration_number')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="transmission" class="form-label">Transmission</label>
                                <select class="form-control @error('transmission') is-invalid @enderror" id="transmission" name="transmission" required>
                                    <option value="automatic" {{ old('transmission', $car->transmission) == 'automatic' ? 'selected' : '' }}>Automatic</option>
                                    <option value="manual" {{ old('transmission', $car->transmission) == 'manual' ? 'selected' : '' }}>Manual</option>
                                </select>
                                @error('transmission')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
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
