@extends('layout.admin')

@section('page_content')
    <style>
        td {
            min-width: 120px;
        }
    </style>
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
                                        <td style="text-align: center; vertical-align: middle;">
                                            @if ($instructor->picture)
                                                <img src="{{ asset('storage/' . $instructor->picture) }}"
                                                    alt="Profile Picture" class="img-fluid rounded-circle"
                                                    style="width: 50px; height: 50px;">
                                            @else
                                                <img src="{{ asset('storage/default-profile.png') }}"
                                                    alt="Default Profile Picture" class="img-fluid rounded-circle"
                                                    style="width: 50px; height: 50px;">
                                            @endif
                                        </td>

                                        <td>{{ $instructor->user->name }}</td>
                                        <td style="min-width: 150px;">{{ $instructor->phone_number }}</td>
                                        <td>{{ $instructor->address }}</td>
                                        <td>{{ ucfirst($instructor->gender) }}</td>
                                        <td>{{ $instructor->license_city }}</td>
                                        <td style="min-width: 150px;">{{ $instructor->license_number }}</td>
                                        <td style="min-width: 150px;">{{ $instructor->id_card_number }}</td>
                                        <td style="min-width: 150px;">
                                            {{-- <a href="{{ route('admin.editInstructor', ['id' => $instructor->id]) }}" class="btn btn-warning">Edit</a> --}}
                                            {{-- <a href="{{route('admin.editInstructor')}}" class="btn btn-warning">Edit</a> --}}
                                            <a href="{{ route('admin.editInstructor', $instructor->id) }}"
                                                class="btn btn-warning">Edit</a>
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



    <div class="modal fade" id="addedSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="addedSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addedSucessfulyModalLabel">Added Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success_instructor'))
                        <div class="alert alert-success">
                            {{ session('success_instructor') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="editSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="editSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSucessfulyModalLabel">Updated Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success_updated_instructor'))
                        <div class="alert alert-success">
                            {{ session('success_updated_instructor') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Are you sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a id="deleteConfirmButton" class="btn btn-danger" href="#">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletedSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="deletedSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletedSucessfulyModalLabel">Deleted Instructor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if (session('success_deleted_instructor'))
                        <div class="alert alert-danger">
                            {{ session('success_deleted_instructor') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.bundle.min.js"></script>


    <script>
        function setDeleteRoute(route) {
            const deleteButton = document.getElementById('deleteConfirmButton');
            deleteButton.href = route;
            $('#deleteModal').modal('show');
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success_updated_instructor') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('editSucessfulyModal'));
                myModal.show();
            @elseif (session('success_instructor') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('addedSucessfulyModal'));
                myModal.show();
            @elseif (session('success_deleted_instructor') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('deletedSucessfulyModal'));
                myModal.show();
            @endif
        });
    </script>



@endsection
