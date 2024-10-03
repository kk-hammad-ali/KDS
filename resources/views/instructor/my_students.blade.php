@extends('layout.instructor')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h4 class="mb-4">My Students</h4>

                    @if ($students->isEmpty())
                        <p>No students found.</p>
                    @else
                        <table class="table table-bordered table-hover">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Name</th>
                                    <th>Father's/Husband's Name</th>
                                    <th>CNIC</th>
                                    <th>Phone</th>
                                    <th>Course</th>
                                    <th>Admission Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $student)
                                    <tr>
                                        <td>{{ $student->user->name }}</td>
                                        <td>{{ $student->father_or_husband_name }}</td>
                                        <td>{{ $student->cnic }}</td>
                                        <td>{{ $student->phone }}</td>
                                        <td>{{ $student->course->duration_days }}</td>
                                        <td>{{ \Carbon\Carbon::parse($student->admission_date)->format('d-m-Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
