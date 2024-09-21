@extends('layout.admin')

@section('page_content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="bg-light rounded h-100 p-4">
                    <h3 class="mb-4">Add Schedule</h3>
                    <form action="{{ route('admin.storeSchedule') }}" method="POST">
                        @csrf

                        <!-- Student Selection -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="student" class="form-label">Select Student</label>
                                <select class="form-control @error('student_id') is-invalid @enderror" id="student"
                                    name="student_id" required>
                                    <option value="" disabled selected>Select Student</option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->id }}"
                                            {{ old('student_id') == $student->id ? 'selected' : '' }}>
                                            {{ $student->user->name }} ({{ $student->cnic }})
                                        </option>
                                    @endforeach
                                </select>
                                @error('student_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Instructor Selection -->
                            <div class="col-lg-6">
                                <label for="instructor" class="form-label">Select Instructor</label>
                                <select class="form-control @error('instructor_id') is-invalid @enderror" id="instructor"
                                    name="instructor_id" required>
                                    <option value="" disabled selected>Select Instructor</option>
                                    @foreach ($instructors as $instructor)
                                        <option value="{{ $instructor->id }}"
                                            {{ old('instructor_id') == $instructor->id ? 'selected' : '' }}>
                                            {{ $instructor->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('instructor_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Transmission and Car Selection -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="transmission" class="form-label">Select Transmission Type</label>
                                <select class="form-control @error('transmission') is-invalid @enderror" id="transmission"
                                    name="transmission" required>
                                    <option value="" disabled selected>Select Transmission Type</option>
                                    <option value="automatic" {{ old('transmission') == 'automatic' ? 'selected' : '' }}>
                                        Automatic</option>
                                    <option value="manual" {{ old('transmission') == 'manual' ? 'selected' : '' }}>Manual
                                    </option>
                                </select>
                                @error('transmission')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-lg-6">
                                <label for="car" class="form-label">Select Car</label>
                                <select class="form-control @error('car_id') is-invalid @enderror" id="car"
                                    name="car_id" required>
                                    <option value="" disabled selected>Select Car</option>
                                    @foreach ($cars as $car)
                                        <option value="{{ $car->id }}" data-transmission="{{ $car->transmission }}"
                                            {{ old('car_id') == $car->id ? 'selected' : '' }}>
                                            {{ $car->make }} {{ $car->model }} - {{ $car->registration_number }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('car_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Time Slot Selection -->
                        <!-- Time Slot Selection -->
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <div class="mb-3">
                                    <label for="timeslot" class="form-label">Select Time Slot</label>
                                    <select class="form-control @error('timeslot_id') is-invalid @enderror" id="timeslot"
                                        name="timeslot_id" required>
                                        <option value="" disabled selected>Select Time Slot</option>
                                        @foreach ($timeslots as $timeslot)
                                            <option value="{{ $timeslot->id }}">
                                                {{ \Carbon\Carbon::parse($timeslot->start_time)->format('Y-m-d h:i A') }} -
                                                {{ \Carbon\Carbon::parse($timeslot->end_time)->format('h:i A') }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('timeslot_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <!-- Submit Button -->
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary">Create Schedule</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function updateAvailableTimeslots() {
            var studentId = document.getElementById('student').value;
            var instructorId = document.getElementById('instructor').value;
            var carId = document.getElementById('car').value;

            if (studentId && instructorId && carId) {
                $.ajax({
                    url: "{{ route('admin.getBookedTimeslots') }}",
                    type: "POST",
                    data: {
                        student_id: studentId,
                        instructor_id: instructorId,
                        car_id: carId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var bookedTimeslots = response;
                        var timeslotSelect = document.getElementById('timeslot');
                        var timeslotOptions = timeslotSelect.options;

                        // Loop through timeslot options and hide the booked ones
                        for (var i = 0; i < timeslotOptions.length; i++) {
                            var option = timeslotOptions[i];
                            var timeslotId = option.value;

                            // Hide timeslot if it's booked
                            if (bookedTimeslots.includes(parseInt(timeslotId))) {
                                option.style.display = 'none'; // Hide booked timeslots
                            } else {
                                option.style.display = ''; // Show available timeslots
                            }
                        }
                    },
                    error: function() {
                        alert('An error occurred while fetching timeslots.');
                    }
                });
            }
        }



        // Reset fields after selecting instructor
        function resetFieldsAfterInstructor() {
            document.getElementById('car').selectedIndex = 0;
            document.getElementById('timeslot').selectedIndex = 0;

            // Optionally reset visibility of cars and timeslots
            var timeslotOptions = document.getElementById('timeslot').options;
            for (var i = 0; i < timeslotOptions.length; i++) {
                timeslotOptions[i].style.display = '';
            }
        }

        // Add event listeners to all relevant select elements
        document.getElementById('student').addEventListener('change', updateAvailableTimeslots);
        document.getElementById('instructor').addEventListener('change', function() {
            resetFieldsAfterInstructor();
            updateAvailableTimeslots();
        });
        document.getElementById('car').addEventListener('change', updateAvailableTimeslots);

        // Initial call to populate the available timeslots
        document.addEventListener('DOMContentLoaded', updateAvailableTimeslots);

        // Update car list based on selected transmission type
        document.getElementById('transmission').addEventListener('change', function() {
            var selectedTransmission = this.value;
            var carSelect = document.getElementById('car');
            var carOptions = carSelect.options;

            for (var i = 0; i < carOptions.length; i++) {
                var option = carOptions[i];

                if (option.dataset.transmission === selectedTransmission || option.value === "") {
                    option.style.display = '';
                } else {
                    option.style.display = 'none';
                }
            }

            // Reset car selection
            carSelect.selectedIndex = 0;
        });
    </script>
@endsection
