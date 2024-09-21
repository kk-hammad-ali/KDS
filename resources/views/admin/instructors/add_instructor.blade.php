@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h3 class="mb-4">Add Instructor</h3>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('admin.instructors.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <!-- User Data -->
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Instructor Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        placeholder="Enter instructor name" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        placeholder="Enter password" required>
                                </div>
                            </div>
                        </div>

                        <!-- Employee Data -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="Enter email" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                        placeholder="Enter phone number" required>
                                </div>
                            </div>
                        </div>

                        <!-- Missing Address Field -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        placeholder="Enter address" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="salary" class="form-label">Salary</label>
                                    <input type="number" class="form-control" id="salary" name="salary"
                                        placeholder="Enter salary" required>
                                </div>
                            </div>
                        </div>

                        <!-- Instructor Data -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="id_card_number" class="form-label">ID Card Number</label>
                                    <input type="text" class="form-control" id="id_card_number" name="id_card_number"
                                        placeholder="Enter ID card number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_city" class="form-label">License City</label>
                                    <input type="text" class="form-control" id="license_city" name="license_city"
                                        placeholder="Enter license city" required>
                                </div>
                            </div>
                        </div>

                        <!-- Missing License Number Field -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_number" class="form-label">License Number</label>
                                    <input type="text" class="form-control" id="license_number" name="license_number"
                                        placeholder="Enter license number" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_start_date" class="form-label">License Start Date</label>
                                    <input type="date" class="form-control" id="license_start_date"
                                        name="license_start_date" required>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="license_end_date" class="form-label">License End Date</label>
                                    <input type="date" class="form-control" id="license_end_date"
                                        name="license_end_date" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="experience" class="form-label">Experience (in years)</label>
                                    <input type="text" class="form-control" id="experience" name="experience"
                                        placeholder="Enter experience (years)">
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option value="" disabled selected>Select gender</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="picture" class="form-label">Upload Picture</label>
                                    <input type="file" class="form-control" id="picture" name="picture">
                                </div>
                            </div>

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
