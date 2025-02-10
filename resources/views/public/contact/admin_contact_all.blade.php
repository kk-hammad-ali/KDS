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
                    <li><span class="text-main-600 fw-normal text-15">Contacts</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->
        </div>

        <div class="card overflow-hidden">
            <div class="card-body p-0">
                <table id="contactTable" class="table table-striped">
                    <thead>
                        <tr>

                            <th class="h6 text-gray-300">Name</th>
                            <th class="h6 text-gray-300">Email</th>
                            <th class="h6 text-gray-300">Address</th>
                            <th class="h6 text-gray-300">Message</th>
                            <th class="h6 text-gray-300">Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                            <tr>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $contact->name }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $contact->email }}</span>
                                </td>
                                <td>
                                    <span class="h6 mb-0 fw-medium text-gray-300">{{ $contact->address }}</span>
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ \Str::limit($contact->message, 50) }}</span>
                                    <!-- Expand full message on hover or click, as desired -->
                                </td>
                                <td>
                                    <span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $contact->created_at->format('d M, Y h:i A') }}</span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of
                    {{ $contacts->total() }} entries</span>
                {{ $contacts->links() }}
            </div>
        </div>
    </div>
@endsection
