@extends('layout.instructor-new')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <!-- Breadcrumb Start -->
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('instructor.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li> <span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span> </li>
                    <li><span class="text-main-600 fw-normal text-15">Edit Leave Application</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <!-- Leave Edit Form Start -->
        <div class="card">
            <div class="card-body">
                <form action="{{ route('instructor.updateLeave', $leave) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <h5 class="mb-24">Update Leave Application</h5>
                    <div class="row gy-20">
                        <!-- Start Date -->
                        <div class="col-sm-6">
                            <label for="start_date" class="h5 mb-8 fw-semibold font-heading">Start Date</label>
                            <input type="date" class="form-control @error('start_date') is-invalid @enderror"
                                id="start_date" name="start_date" value="{{ old('start_date', $leave->start_date) }}"
                                required>
                            @error('start_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- End Date -->
                        <div class="col-sm-6">
                            <label for="end_date" class="h5 mb-8 fw-semibold font-heading">End Date</label>
                            <input type="date" class="form-control @error('end_date') is-invalid @enderror"
                                id="end_date" name="end_date" value="{{ old('end_date', $leave->end_date) }}" required>
                            @error('end_date')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Leave Reason -->
                        <div class="col-12">
                            <label for="leave_reason" class="h5 mb-8 fw-semibold font-heading">Leave Reason</label>
                            <textarea class="form-control @error('leave_reason') is-invalid @enderror" id="leave_reason" name="leave_reason"
                                rows="4" required>{{ old('leave_reason', $leave->leave_reason) }}</textarea>
                            @error('leave_reason')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="flex-align justify-content-end gap-8 mt-4">
                        <button type="submit" class="btn btn-main rounded-pill py-9">Update Leave</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Leave Edit Form End -->
    </div>
@endsection
