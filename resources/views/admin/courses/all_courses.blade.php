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
                        <h4 class="mb-0">All Courses</h4>
                        <a href="{{ route('admin.addCourses') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add Course
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    {{-- <th scope="col">Course Name</th> --}}
                                    <th scope="col">Duration (Days)</th>
                                    <th scope="col">Duration (Minutes)</th>
                                    <th scope="col">Fees</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($courses as $course)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        {{-- <td>{{ $course->name }}</td> --}}
                                        <td>{{ $course->duration_days }}</td>
                                        <td>{{ $course->duration_minutes }}</td>
                                        <td>{{ $course->fees }}</td>
                                        <td>
                                            <a href="{{ route('admin.editCourse', $course->id) }}"
                                                class="btn btn-warning">Edit</a>
                                            <button class="btn btn-danger"
                                                onclick="setDeleteRoute('{{ route('admin.deleteCourse', $course->id) }}')">Delete</button>
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


    <div class="modal fade" id="editSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="editSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSucessfulyModalLabel">Updated Course</h5>
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
                    @if (session('successfully_edit'))
                        <div class="alert alert-success">
                            {{ session('successfully_edit') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addedSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="addedSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addedSucessfulyModalLabel">Added Course</h5>
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
                    @if (session('success_courses'))
                        <div class="alert alert-success">
                            {{ session('success_courses') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deletedSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="deletedSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletedSucessfulyModalLabel">Deleted Course</h5>
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
                    @if (session('success_deleted'))
                        <div class="alert alert-danger">
                            {{ session('success_deleted') }}
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Include only Bootstrap 5 CSS and JS -->
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
            @if (session('successfully_edit') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('editSucessfulyModal'));
                myModal.show();
            @elseif (session('success_courses') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('addedSucessfulyModal'));
                myModal.show();
            @elseif (session('success_deleted') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('deletedSucessfulyModal'));
                myModal.show();
            @endif
        });
    </script>
@endsection
