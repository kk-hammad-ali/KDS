@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Instructors</h4>
                        <a href="{{ route('admin.addInstructor') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add Instructor
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Profile Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">License City</th>
                                    <th scope="col">License Number</th>
                                    <th scope="col">ID Card Number</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($instructors as $instructor)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if ($instructor->employee->picture)
                                                <img src="{{ asset('storage/' . $instructor->employee->picture) }}"
                                                    class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @else
                                                <img src="{{ asset('storage/default-profile.png') }}"
                                                    class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                        <td>{{ $instructor->employee->user->name }}</td>
                                        <td>{{ $instructor->employee->phone }}</td>
                                        <td>{{ $instructor->employee->address }}</td>
                                        <td>{{ ucfirst($instructor->employee->gender) }}</td>
                                        <td>{{ $instructor->license_city }}</td>
                                        <td>{{ $instructor->license_number }}</td>
                                        <td>{{ $instructor->employee->id_card_number }}</td>
                                        <td>
                                            <a href="{{ route('admin.editInstructor', $instructor->id) }}"
                                                class="btn btn-warning mb-2">Edit</a>
                                            <button class="btn btn-danger"
                                                onclick="setDeleteRoute('{{ route('admin.deleteInstructor', $instructor->id) }}')">Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
