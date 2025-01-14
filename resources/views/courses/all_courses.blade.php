@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Courses</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCourseModal">
                    <i class="ph ph-book-open d-flex text-xl"></i> Add Course
                </button>
            </div>
        </div>

        <!-- Courses Table Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="coursesTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Car Model</th> <!-- Updated Column -->
                            <th class="h6 text-gray-300">Duration (Days)</th>
                            <th class="h6 text-gray-300">Duration (Minutes)</th>
                            <th class="h6 text-gray-300">Fees</th>
                            <th class="h6 text-gray-300">Course Type</th> <!-- New Column -->
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr>
                                <td class="fixed-width">
                                    <div class="form-check">
                                        <input class="form-check-input border-gray-200 rounded-4" type="checkbox">
                                    </div>
                                </td>
                                <td>
                                    <div class="flex-align gap-8">
                                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                    </div>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        {{ $course->carModel ? $course->carModel->name . ' (' . ucfirst($course->carModel->transmission) . ')' : 'N/A' }}
                                    </span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $course->duration_days }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $course->duration_minutes }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ number_format($course->fees, 2) }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ ucfirst($course->course_type) }}</span>
                                </td>
                                <td>
                                    <button
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCourseModal"
                                        data-id="{{ $course->id }}" data-car_model_id="{{ $course->car_model_id }}"
                                        data-duration_days="{{ $course->duration_days }}"
                                        data-duration_minutes="{{ $course->duration_minutes }}"
                                        data-fees="{{ $course->fees }}" data-course_type="{{ $course->course_type }}">
                                        Edit
                                    </button>
                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-course-id="{{ $course->id }}">
                                        Delete
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $courses->firstItem() }} to {{ $courses->lastItem() }} of
                    {{ $courses->total() }} entries</span>
                <ul class="pagination flex-align flex-wrap">
                    @if ($courses->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Prev</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $courses->previousPageUrl() }}">Prev</a>
                        </li>
                    @endif

                    @foreach ($courses->links()->elements[0] as $page => $url)
                        @if ($page == $courses->currentPage())
                            <li class="page-item active">
                                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                    href="#">{{ $page }}</a>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                    href="{{ $url }}">{{ $page }}</a>
                            </li>
                        @endif
                    @endforeach

                    @if ($courses->hasMorePages())
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $courses->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Next</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
        <!-- Courses Table End -->
    </div>
    <!-- Courses Table End -->

    <!-- Add Course Modal -->
    <div class="modal fade" id="addCourseModal" tabindex="-1" aria-labelledby="addCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addCourseModalLabel">Add New Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.courses.store') }}" method="POST">
                        @csrf

                        <!-- Car Model Selection -->
                        <div class="mb-3">
                            <label for="car_model_id" class="form-label">Car Model</label>
                            <select class="form-select" id="car_model_id" name="car_model_id" required>
                                <option value="">Select Car Model</option>
                                @foreach ($carModels as $carModel)
                                    <option value="{{ $carModel->id }}">{{ $carModel->name }}
                                        ({{ ucfirst($carModel->transmission) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Duration (Days) -->
                        <div class="mb-3">
                            <label for="duration_days" class="form-label">Duration (Days)</label>
                            <input type="number" class="form-control" id="duration_days" name="duration_days" required>
                        </div>

                        <!-- Duration (Minutes) -->
                        <div class="mb-3">
                            <label for="duration_minutes" class="form-label">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="duration_minutes" name="duration_minutes"
                                required>
                        </div>

                        <!-- Fees -->
                        <div class="mb-3">
                            <label for="fees" class="form-label">Fees</label>
                            <input type="number" class="form-control" id="fees" name="fees" step="0.01"
                                required>
                        </div>

                        <!-- Course Type -->
                        <div class="mb-3">
                            <label for="course_type" class="form-label">Course Type</label>
                            <select class="form-select" id="course_type" name="course_type" required>
                                <option value="">Select Course Type</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="both">Both</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Add Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCourseForm" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Car Model Selection -->
                        <div class="mb-3">
                            <label for="edit_car_model_id" class="form-label">Car Model</label>
                            <select class="form-select" id="edit_car_model_id" name="car_model_id" required>
                                <option value="">Select Car Model</option>
                                @foreach ($carModels as $carModel)
                                    <option value="{{ $carModel->id }}">{{ $carModel->name }}
                                        ({{ ucfirst($carModel->transmission) }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Duration (Days) -->
                        <div class="mb-3">
                            <label for="edit_duration_days" class="form-label">Duration (Days)</label>
                            <input type="number" class="form-control" id="edit_duration_days" name="duration_days"
                                required>
                        </div>

                        <!-- Duration (Minutes) -->
                        <div class="mb-3">
                            <label for="edit_duration_minutes" class="form-label">Duration (Minutes)</label>
                            <input type="number" class="form-control" id="edit_duration_minutes"
                                name="duration_minutes" required>
                        </div>

                        <!-- Fees -->
                        <div class="mb-3">
                            <label for="edit_fees" class="form-label">Fees</label>
                            <input type="number" class="form-control" id="edit_fees" name="fees" step="0.01"
                                required>
                        </div>

                        <!-- Course Type -->
                        <div class="mb-3">
                            <label for="edit_course_type" class="form-label">Course Type</label>
                            <select class="form-select" id="edit_course_type" name="course_type" required>
                                <option value="">Select Course Type</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="both">Both</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex-align justify-content-end gap-8 mt-4">
                            <button type="submit" class="btn btn-main rounded-pill py-9">Update Course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this course?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deleteCourseForm" method="GET" action="">
                        @csrf
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Delete Confirmation Modal -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Delete Modal
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const courseId = button.getAttribute('data-course-id');
                const deleteForm = document.getElementById('deleteCourseForm');
                deleteForm.action = `/admin/courses/delete/${courseId}`;
            });

            // Handling Edit Modal
            const editCourseModal = document.getElementById('editCourseModal');
            editCourseModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const courseId = button.getAttribute('data-id');
                const carModelId = button.getAttribute('data-car_model_id');
                const durationDays = button.getAttribute('data-duration_days');
                const durationMinutes = button.getAttribute('data-duration_minutes');
                const fees = button.getAttribute('data-fees');
                const courseType = button.getAttribute('data-course_type');

                document.getElementById('edit_car_model_id').value = carModelId;
                document.getElementById('edit_duration_days').value = durationDays;
                document.getElementById('edit_duration_minutes').value = durationMinutes;
                document.getElementById('edit_fees').value = fees;
                document.getElementById('edit_course_type').value = courseType;

                const editForm = document.getElementById('editCourseForm');
                editForm.action = `/admin/courses/${courseId}`;
            });
        });
    </script>
@endsection
