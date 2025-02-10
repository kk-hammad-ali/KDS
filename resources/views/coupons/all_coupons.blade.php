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
                    <li><span class="text-main-600 fw-normal text-15">Coupons</span></li>
                </ul>
            </div>
            <!-- Breadcrumb End -->

            <!-- Breadcrumb Right Start -->
            <div class="flex-align gap-8 flex-wrap">
                <button class="btn btn-main text-sm btn-sm px-24 py-12 d-flex align-items-center gap-8"
                    data-bs-toggle="modal" data-bs-target="#addCouponModal">
                    <i class="ph ph-book-open d-flex text-xl"></i> Add Coupon
                </button>
            </div>
        </div>

        <!-- Coupons Table Start -->
        <div class="card overflow-hidden">
            <div class="card-body p-0 overflow-x-auto">
                <table id="couponsTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="h6 text-gray-300">#</th>
                            <th class="h6 text-gray-300">Code</th>
                            <th class="h6 text-gray-300">Discount (%)</th>
                            <th class="h6 text-gray-300">Expiry Date</th>
                            <th class="h6 text-gray-300">Active</th>
                            <th class="h6 text-gray-300">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($coupons as $coupon)
                            <tr>
                                <td>
                                    <div class="flex-align gap-8">
                                        <span class="h6 mb-0 fw-medium text-gray-300">{{ $loop->iteration }}</span>
                                    </div>
                                </td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $coupon->code }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $coupon->discount }}</span></td>
                                <td><span class="h6 mb-0 fw-medium text-gray-300">{{ $coupon->expiry_date }}</span></td>
                                <td><span
                                        class="h6 mb-0 fw-medium text-gray-300">{{ $coupon->is_active ? 'Yes' : 'No' }}</span>
                                </td>
                                <td>
                                    <button
                                        class="bg-main-50 text-main-600 py-2 px-14 rounded-pill hover-bg-main-600 hover-text-white"
                                        data-bs-toggle="modal" data-bs-target="#editCouponModal"
                                        data-id="{{ $coupon->id }}" data-code="{{ $coupon->code }}"
                                        data-discount="{{ $coupon->discount }}"
                                        data-expiry_date="{{ $coupon->expiry_date }}"
                                        data-is_active="{{ $coupon->is_active }}">Edit</button>

                                    <button type="button"
                                        class="bg-danger text-white py-2 px-14 rounded-pill hover-bg-danger-600"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal"
                                        data-coupon-id="{{ $coupon->id }}">Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer flex-between flex-wrap">
                <span class="text-gray-900">Showing {{ $coupons->count() }} entries</span>
            </div>
        </div>
        <!-- Coupons Table End -->

        <!-- Add Coupon Modal -->
        <div class="modal fade" id="addCouponModal" tabindex="-1" aria-labelledby="addCouponModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addCouponModalLabel">Add New Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.coupons.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="code" name="code" required>
                            </div>

                            <div class="mb-3">
                                <label for="discount" class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" id="discount" name="discount" min="0"
                                    max="100" required>
                            </div>

                            <div class="mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" id="expiry_date" name="expiry_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="is_active" class="form-label">Active</label>
                                <select class="form-select" id="is_active" name="is_active" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Add Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Add Coupon Modal -->

        <!-- Edit Coupon Modal -->
        <div class="modal fade" id="editCouponModal" tabindex="-1" aria-labelledby="editCouponModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCouponModalLabel">Edit Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCouponForm" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="edit_code" class="form-label">Code</label>
                                <input type="text" class="form-control" id="edit_code" name="code" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_discount" class="form-label">Discount (%)</label>
                                <input type="number" class="form-control" id="edit_discount" name="discount"
                                    min="0" max="100" required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_expiry_date" class="form-label">Expiry Date</label>
                                <input type="date" class="form-control" id="edit_expiry_date" name="expiry_date"
                                    required>
                            </div>

                            <div class="mb-3">
                                <label for="edit_is_active" class="form-label">Active</label>
                                <select class="form-select" id="edit_is_active" name="is_active" required>
                                    <option value="1">Yes</option>
                                    <option value="0">No</option>
                                </select>
                            </div>

                            <br>
                            <!-- Submit Button -->
                            <div class="flex-align justify-content-end gap-8 mt-4">
                                <button type="submit" class="btn btn-main rounded-pill py-9">Update Coupon</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Edit Coupon Modal -->

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this coupon?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form id="deleteCouponForm" method="GET" action="">
                            @csrf
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Delete Confirmation Modal -->

    </div>

    <!-- Script for handling Edit and Delete modals -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handling Edit Modal
            const editCouponModal = document.getElementById('editCouponModal');
            editCouponModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const couponId = button.getAttribute('data-id');
                const code = button.getAttribute('data-code');
                const discount = button.getAttribute('data-discount');
                const expiryDate = button.getAttribute('data-expiry_date');
                const isActive = button.getAttribute('data-is_active');

                // Fill form fields with existing data
                document.getElementById('edit_code').value = code;
                document.getElementById('edit_discount').value = discount;
                document.getElementById('edit_expiry_date').value = expiryDate;
                document.getElementById('edit_is_active').value = isActive;

                // Set form action
                const form = document.getElementById('editCouponForm');
                form.action = `/admin/coupons/${couponId}`;
            });

            // Handling Delete Modal
            const deleteModal = document.getElementById('deleteModal');
            deleteModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const couponId = button.getAttribute('data-coupon-id');
                const deleteForm = document.getElementById('deleteCouponForm');
                deleteForm.action = `/admin/coupons/delete/${couponId}`;
            });
        });
    </script>
@endsection
