<form id="change-password-form" method="post">
    <!-- CSRF TOKEN -->
    {{ csrf_field() }}

    <div class="form-group">
        <label>Current Password</label>
        <input type="password" class="form-control main-form-control" placeholder="Current Password" id="current-password">
    </div>
    <div class="form-group">
        <label>New Password</label>
        <input type="password" class="form-control main-form-control" placeholder="New Password" id="new-password">
    </div>
    <div class="form-group">
        By submitting this form I agree <a data-target="#tc-modal" data-toggle="modal">Terms and Condition</a>
    </div>
    <button type="submit" class="btn btn-blue pull-right">Change Password</button>
</form>
