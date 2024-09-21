@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="mb-0">All Cars</h4>
                        <a href="{{ route('admin.addCars') }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i> Add Cars
                        </a>
                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Registration Number</th>
                                <th>Transmission</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cars as $car)
                                <tr>
                                    <td>{{ $car->id }}</td>
                                    <td>{{ $car->make }}</td>
                                    <td>{{ $car->model }}</td>
                                    <td>{{ $car->registration_number }}</td>

                                    <td>{{ ucfirst($car->transmission) }}</td>
                                    <td>
                                        <a href="{{ route('admin.editCar', $car->id) }}" class="btn btn-warning">Edit</a>
                                        <button class="btn btn-danger"
                                            onclick="setDeleteRoute('{{ route('admin.deleteCars', $car->id) }}')">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="addedSucessfulyModal" tabindex="-1" role="dialog"
        aria-labelledby="addedSucessfulyModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addedSucessfulyModalLabel">Added Car</h5>
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
                    @if (session('success_cars'))
                        <div class="alert alert-success">
                            {{ session('success_cars') }}
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
                    <h5 class="modal-title" id="editSucessfulyModalLabel">Updated Car</h5>
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
                    @if (session('success_updated_cars'))
                        <div class="alert alert-success">
                            {{ session('success_updated_cars') }}
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
                    <h5 class="modal-title" id="deletedSucessfulyModalLabel">Deleted Car</h5>
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
                    @if (session('success_car_deleted'))
                        <div class="alert alert-danger">
                            {{ session('success_car_deleted') }}
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
            @if (session('success_updated_cars') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('editSucessfulyModal'));
                myModal.show();
            @elseif (session('success_cars') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('addedSucessfulyModal'));
                myModal.show();
            @elseif (session('success_car_deleted') || $errors->any() || session('error'))
                var myModal = new bootstrap.Modal(document.getElementById('deletedSucessfulyModal'));
                myModal.show();
            @endif
        });
    </script>




@endsection
