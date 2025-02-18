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

        <div class="card mt-24">
            <div class="card-body">
                <form class="search-input-form">
                    <!-- Student Name Input -->
                    <input type="text" id="studentName" class="form-control h6 rounded-4 mb-0 py-6 px-8"
                        placeholder="Enter Student Name">

                    <!-- Phone Number Input -->
                    <input type="text" id="studentPhone" class="form-control h6 rounded-4 mb-0 py-6 px-8 mt-3"
                        placeholder="Enter Phone Number">

                    <button type="button" class="btn btn-main rounded-pill py-9 w-100 mt-3" onclick="filterStudents()">
                        Search
                    </button>
                </form>
            </div>
        </div>
        <br>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="studentTable" class="table table-striped">
                    <thead>
                        <tr>
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
                                    <span class="h6 mb-0 fw-medium text-gray-300">
                                        {{ $student->course->carModel->name }}
                                        ({{ ucfirst($student->course->carModel->transmission) }})
                                        - {{ $student->course->duration_days }} Days
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.editStudent', ['id' => $student->id]) }}"
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white">Edit</a>
                                    <!-- other actions -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $students->firstItem() }} to {{ $students->lastItem() }} of
                    {{ $students->total() }} entries</span>
                <ul class="pagination flex-align flex-wrap">
                    @if ($students->onFirstPage())
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Prev</a>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $students->previousPageUrl() }}">Prev</a>
                        </li>
                    @endif

                    @foreach ($students->links()->elements[0] as $page => $url)
                        @if ($page == $students->currentPage())
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

                    @if ($students->hasMorePages())
                        <li class="page-item">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium"
                                href="{{ $students->nextPageUrl() }}">Next</a>
                        </li>
                    @else
                        <li class="page-item disabled">
                            <a class="page-link h-44 w-44 flex-center text-15 rounded-8 fw-medium" href="#">Next</a>
                        </li>
                    @endif
                </ul>
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


    <script>
        document.getElementById('studentName').addEventListener('input', filterStudents);
        document.getElementById('studentPhone').addEventListener('input', filterStudents);

        function filterStudents() {
            const studentNameInput = document.getElementById('studentName').value.toLowerCase();
            const studentPhoneInput = document.getElementById('studentPhone').value.toLowerCase();
            const tableRows = document.querySelectorAll('#studentTable tbody tr');

            tableRows.forEach(function(row) {
                const studentName = row.cells[1].innerText.toLowerCase();
                const studentPhone = row.cells[2].innerText.toLowerCase();

                // Show or hide the row based on both the name and phone number input
                if (studentName.includes(studentNameInput) && studentPhone.includes(studentPhoneInput)) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        }
    </script>
@endsection
