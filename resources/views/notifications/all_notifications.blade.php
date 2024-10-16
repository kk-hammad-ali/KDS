@extends('layout.layout')

@section('content')
    <div class="dashboard-body">
        <div class="breadcrumb-with-buttons mb-24 flex-between flex-wrap gap-8">
            <div class="breadcrumb mb-24">
                <ul class="flex-align gap-4">
                    <li><a href="{{ route('admin.dashboard') }}"
                            class="text-gray-200 fw-normal text-15 hover-text-main-600">Home</a></li>
                    <li><span class="text-gray-500 fw-normal d-flex"><i class="ph ph-caret-right"></i></span></li>
                    <li><span class="text-main-600 fw-normal text-15">Notifications</span></li>
                </ul>
            </div>
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Notification</th>
                            <th class="h6 text-gray-300">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $notification->data['message'] }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $notification->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
