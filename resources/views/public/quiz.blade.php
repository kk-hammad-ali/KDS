@extends('layout.app')

@section('title', 'Theory Test')
@section('breadcrumb', 'Quiz')

@section('content')
    <div class="container mt-5">
        @if (session('score'))
            <div class="alert alert-info">
                <h3>Your Score: {{ session('score') }}/10</h3>
                <p>Thank you for taking the quiz!</p>
            </div>
        @endif
        <form action="{{ route('public.quiz') }}" method="POST">
            @csrf

            <div class="mb-4">
                <h3>1. What is the maximum speed limit in city areas for cars?</h3>
                <input type="radio" name="q1" value="50"> 50 km/h<br>
                <input type="radio" name="q1" value="60"> 60 km/h<br>
                <input type="radio" name="q1" value="70"> 70 km/h<br>
            </div>

            <div class="mb-4">
                <h3>2. When should you use a seatbelt?</h3>
                <input type="radio" name="q2" value="Always"> Always<br>
                <input type="radio" name="q2" value="Sometimes"> Sometimes<br>
                <input type="radio" name="q2" value="Never"> Never<br>
            </div>

            <div class="mb-4">
                <h3>3. What should you do when you see a red traffic light?</h3>
                <input type="radio" name="q3" value="Stop"> Stop<br>
                <input type="radio" name="q3" value="Speed up"> Speed up<br>
                <input type="radio" name="q3" value="Slow down"> Slow down<br>
            </div>

            <div class="mb-4">
                <h3>4. When should you give way to pedestrians?</h3>
                <input type="radio" name="q4" value="At crosswalks"> At crosswalks<br>
                <input type="radio" name="q4" value="Never"> Never<br>
                <input type="radio" name="q4" value="When they are on the sidewalk"> When they are on the
                sidewalk<br>
            </div>

            <div class="mb-4">
                <h3>5. What does a yellow traffic light mean?</h3>
                <input type="radio" name="q5" value="Prepare to stop"> Prepare to stop<br>
                <input type="radio" name="q5" value="Speed up"> Speed up<br>
                <input type="radio" name="q5" value="Stop"> Stop<br>
            </div>

            <div class="mb-4">
                <h3>6. How close can you legally park to a fire hydrant?</h3>
                <input type="radio" name="q6" value="5 meters"> 5 meters<br>
                <input type="radio" name="q6" value="10 meters"> 10 meters<br>
                <input type="radio" name="q6" value="15 meters"> 15 meters<br>
            </div>

            <div class="mb-4">
                <h3>7. What should you do if an emergency vehicle with flashing lights is approaching?</h3>
                <input type="radio" name="q7" value="Pull over and stop"> Pull over and stop<br>
                <input type="radio" name="q7" value="Continue driving"> Continue driving<br>
                <input type="radio" name="q7" value="Speed up to get out of the way"> Speed up to get out of the
                way<br>
            </div>

            <div class="mb-4">
                <h3>8. What should you do when approaching a railway crossing without barriers?</h3>
                <input type="radio" name="q8" value="Slow down, look, and listen"> Slow down, look, and listen<br>
                <input type="radio" name="q8" value="Drive through quickly"> Drive through quickly<br>
                <input type="radio" name="q8" value="Honk the horn"> Honk the horn<br>
            </div>

            <div class="mb-4">
                <h3>9. What is the meaning of a broken white line on the road?</h3>
                <input type="radio" name="q9" value="You may change lanes"> You may change lanes<br>
                <input type="radio" name="q9" value="No overtaking"> No overtaking<br>
                <input type="radio" name="q9" value="No parking"> No parking<br>
            </div>

            <div class="mb-4">
                <h3>10. What should you do if your vehicle starts to skid?</h3>
                <input type="radio" name="q10" value="Steer into the skid"> Steer into the skid<br>
                <input type="radio" name="q10" value="Brake hard"> Brake hard<br>
                <input type="radio" name="q10" value="Steer in the opposite direction"> Steer in the opposite
                direction<br>
            </div>
            {{--
            <div class="link"><a href="{{ route('public.about') }}" class="theme-btn btn-style-one"><span>Read
                        More</span></a></div> --}}

            <div class="mb-4">
                <button type="submit" class="theme-btn btn-style-one">Submit Quiz</button>
            </div>
        </form>
    </div>
@endsection
