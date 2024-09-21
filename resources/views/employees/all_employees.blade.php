@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Employees</h4>
                        <a href="{{ route('admin.addEmployee') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add Employee
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Profile Picture</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">ID Card Number</th>
                                    <th scope="col">Phone Number</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Salary</th>
                                    <th scope="col">Designation</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if ($employee->picture)
                                                <img src="{{ asset('storage/' . $employee->picture) }}"
                                                    class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @else
                                                <img src="{{ asset('storage/default-profile.png') }}"
                                                    class="img-fluid rounded-circle" style="width: 50px; height: 50px;">
                                            @endif
                                        </td>
                                        <td>{{ $employee->user->name }}</td>
                                        <td>{{ $employee->email }}</td>
                                        <td>{{ $employee->id_card_number }}</td>
                                        <td>{{ $employee->phone }}</td>
                                        <td>{{ $employee->address }}</td>
                                        <td>{{ ucfirst($employee->gender) }}</td>
                                        <td>{{ $employee->salary }}</td>
                                        <td>{{ $employee->designation ?? 'N/A' }}</td>
                                        <td>
                                            <a href="{{ route('admin.editEmployee', $employee->id) }}"
                                                class="btn btn-warning mb-2">Edit</a>
                                            <button class="btn btn-danger"
                                                onclick="setDeleteRoute('{{ route('admin.deleteEmployee', $employee->id) }}')">Delete</button>
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

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this employee? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function setDeleteRoute(route) {
            const deleteButton = document.getElementById('deleteConfirmButton');
            deleteButton.href = route;
            $('#deleteModal').modal('show');
        }
    </script>
@endsection
