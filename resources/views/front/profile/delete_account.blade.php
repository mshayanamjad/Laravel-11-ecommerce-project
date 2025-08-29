@extends('front.profile.layouts.app')
@section('title', 'Delete Account - ')

@section('content')

<!-- Main Content -->
<div class="container">
    <div class="page-inner pt-md-5 mt-md-3">
        {{-- Message Alert --}}
        <div class="col-12">
            @include('front.profile.layouts.message')
        </div>

        <form action="" method="POST">
            <div class="row">
                <div class="col-md-12">
                    <div class="card mb-2">
                        <div class="card-header">
                            <div class="card-title">Delete Account</div>
                        </div>
                        <div class="card-body px-5 py-4">
                            <p class="bg-warning text-center py-4 rounded mb-2">
                                ⚠ <strong>Important Notice:</strong>  
                                Deleting your account is <strong>permanent</strong> and cannot be undone.<br> 
                                However, your data will be temporarily stored for <strong>30 days</strong>.  
                                If you change your mind, you can restore your account within this period.
                            </p>
        
                            <div class="text-center mb-4 bg-info rounded py-4">
                                <p class="text-white m-0">
                                <i class="fas fa-info-circle"></i>
                                Need to restore your account? <br>
                                    Simply log in within <strong>30 days</strong>, and you'll see an option to reactivate your account.
                                </p>
                            </div>
                            <div class="action-btns mt-3 text-center">
                                <button type="button" id="openDeletePopup" class="btn btn-danger">Delete Account</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirm Account Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route("front.deleteAccProcess") }}" method="POST" id="deleteAccountForm">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <p class="text-danger">
                        Are you sure you want to delete your account? This action is irreversible after 30 days.
                    </p>
                    <div class="mb-3">
                        <label for="passwordInput" class="form-label">Enter Your Password to Confirm:</label>
                        <input type="password" class="form-control" id="passwordInput" name="deletion_password" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" id="confirmDelete" class="btn btn-danger">Confirm Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('customJs')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const openDeletePopup = document.getElementById("openDeletePopup");
        const deleteConfirmModal = new bootstrap.Modal(document.getElementById("deleteConfirmModal"));
        const confirmDeleteButton = document.getElementById("confirmDelete");
        const deleteAccountForm = document.getElementById("deleteAccountForm");

        openDeletePopup.addEventListener("click", function () {
            deleteConfirmModal.show();
        });
    });
</script>
@endsection
