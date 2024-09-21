@extends('layout.admin')

@section('page_content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h3 class="mb-4">Edit Course</h3>
                <form action="{{ route('admin.updateCourse', $course->id) }}" method="POST">
                    @csrf
                    {{-- Course fields --}}
                    <div class="row mb-3">
                        {{-- <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="course_name" class="form-label">Course Name</label>
                                <input type="text" class="form-control @error('course_name') is-invalid @enderror" id="course_name" name="course_name" value="{{ old('course_name', $course->name) }}" placeholder="Enter course name" required>
                                @error('course_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="fees" class="form-label">Fees</label>
                                <input type="number" class="form-control @error('fees') is-invalid @enderror" id="fees" name="fees" value="{{ old('fees', $course->fees) }}" placeholder="Enter course fees" required>
                                @error('fees')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <label for="duration_days" class="form-label">Duration (Days)</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="duration_days" name="duration_days"
                                    value="{{ old('duration_days', $course->duration_days) }}" placeholder="Enter course duration" required>
                                <span class="input-group-text">Days</span>
                                @error('duration_days')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-lg-6">
                            <label for="duration_minutes" class="form-label">Duration (Minutes)</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control @error('duration_minutes') is-invalid @enderror" id="duration_minutes" name="duration_minutes" value="{{ old('duration_minutes', $course->duration_minutes) }}" placeholder="Enter course duration" required>
                                <span class="input-group-text">Minutes</span>
                                @error('duration_minutes')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-primary w-75">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
