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
                    <li><span class="text-main-600 fw-normal text-15">Students</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <a href="{{ route('admin.addStudent') }}"
                    class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8">
                    <i class="ph ph-user-plus d-flex text-xl"></i> 
                    Add Student
                </a>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="studentTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="fixed-width">
                                <div class="form-check">
                                    <input class="form-check-input border-gray-200 rounded-4" type="checkbox"
                                        id="selectAll">
                                </div>
                            </th>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Phone Number</th>
                            <th class="h6 text-gray-300">Pickup Sector</th>
                            <th class="h6 text-gray-300">Admission</th>
                            <th class="h6 text-gray-300">Course Enrolled</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($students as $student)
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
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->user->name }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->phone }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->pickup_sector }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $student->admission_date }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300"> {{ $student->course->car->make }}
                                        {{ $student->course->car->model }} -
                                        {{ $student->course->car->registration_number }} -
                                        ({{ $student->course->duration_days }} Days)
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.editStudent', ['id' => $student->id]) }}"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>

                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-student-id="{{ $student->id }}">Delete</button>
                                    <button type="button"
                                        class="bg-info text-white py-2 px-14 rounded-pill hover-bg-info-600"
                                        data-bs-toggle="modal" data-bs-target="#viewStudentModal"
                                        data-student="{{ json_encode($student) }}">View</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">
                    Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of {{ $students->total() }}
                    entries
                </span>

                <!-- Default pagination links -->
                {{ $students->links() }}
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
                        Are you sure you want to delete this student?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteStudentForm" method="POST" action="">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- View Student Modal -->
        <div class="modal fade" id="viewStudentModal" tabindex="-1" aria-labelledby="viewStudentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title" id="viewStudentModalLabel">Student Details</h3>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="studentDetails"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Script for passing student data to delete and view modals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Delete modal
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const studentId = button.getAttribute('data-student-id'); // Get the student ID

                // Set the form action URL
                const form = document.getElementById('deleteStudentForm');
                form.action = `/admin/students/delete/${studentId}`;
            });

            // View student modal
            const viewStudentModal = document.getElementById('viewStudentModal');
            viewStudentModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget; // Button that triggered the modal
                const student = button.getAttribute('data-student'); // Extract student data
                const studentDetails = JSON.parse(student); // Parse student JSON data

                // Build the student details HTML
                let detailsHtml = `
                    <p><strong>Name:</strong> ${studentDetails.user.name}</p>
                    <p><strong>Father/Husband Name:</strong> ${studentDetails.father_or_husband_name}</p>
                    <p><strong>CNIC:</strong> ${studentDetails.cnic}</p>
                    <p><strong>Address:</strong> ${studentDetails.address}</p>
                    <p><strong>Phone:</strong> ${studentDetails.phone}</p>
                    <p><strong>Optional Phone:</strong> ${studentDetails.optional_phone}</p>
                    <p><strong>Admission Date:</strong> ${studentDetails.admission_date}</p>
                    <p><strong>Email:</strong> ${studentDetails.email}</p>
                    <p><strong>Fees:</strong> ${studentDetails.fees}</p>
                    <p><strong>Practical Driving Hours:</strong> ${studentDetails.practical_driving_hours}</p>
                    <p><strong>Theory Classes:</strong> ${studentDetails.theory_classes}</p>
                    <p><strong>Course:</strong> ${studentDetails.course.car.make} ${studentDetails.course.car.model} (${studentDetails.course.car.registration_number}) - ${studentDetails.course.duration_days} Days</p>
                    <p><strong>Instructor:</strong> ${studentDetails.instructor ? studentDetails.instructor.employee.user.name : 'N/A'}</p>
                    <p><strong>Course Duration:</strong> ${studentDetails.course_duration}</p>
                    <p><strong>Class Start Time:</strong> ${studentDetails.class_start_time}</p>
                    <p><strong>Class End Time:</strong> ${studentDetails.class_end_time}</p>
                    <p><strong>Class Duration:</strong> ${studentDetails.class_duration}</p>
                    <p><strong>Course End Date:</strong> ${studentDetails.course_end_date}</p>
                    <p><strong>Form Type:</strong> ${studentDetails.form_type}</p>
                `;
                document.getElementById('studentDetails').innerHTML = detailsHtml; // Update modal content
            });
        });
    </script>
@endsection
