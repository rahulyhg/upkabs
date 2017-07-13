<form action="{{ url('profile/edit') }}" method="post" enctype="multipart/form-data">
    <!-- CSRF TOKEN -->
    {{ csrf_field() }}

    <div class="form-group">
        <label>Photo Profile (only jpg/jpeg/png)</label>
        <input type="file" name="avatar" id="image">
    </div>
    <div class="form-group">
        <label>Name</label>
        <input class="form-control main-form-control" placeholder="Real Name" name="name" value="{{ $user['name'] }}">
    </div>
    <div class="form-group">
        <label>Bio</label>
        <textarea class="form-control main-form-control" placeholder="Bio" name="bio">{{ $user['bio'] }}</textarea>
    </div>
    <div class="form-group">
        <label>Position</label>
        <input type="text" class="form-control main-form-control" placeholder="Position" name="position" value="{{ $user['position'] }}">
    </div>
    <div class="form-group">
        <label>Gender</label>
        <select name="gender" class="form-control main-form-control">
            @if ($user['gender'] == 1)
                <option value="1" selected>Man</option>
                <option value="0">Woman</option>
            @else
                <option value="0" selected>Woman</option>
                <option value="1">Man</option>
            @endif
        </select>
    </div>
    <div class="form-group">
        <label>Website</label>
        <input type="text" class="form-control main-form-control" placeholder="Website" name="website" value="{{ $user['website'] }}">
    </div>
    <div class="form-group">
        <label>Email</label>
        <input type="email" class="form-control main-form-control" placeholder="Email" name="email" value="{{ $user['email'] }}">
    </div>
    <div class="form-group">
        <label>Phone</label>
        <input type="text" class="form-control main-form-control" placeholder="Phone" name="phone" value="{{ $user['phone'] }}">
    </div>
    <div class="form-group">
        By submitting this form I agree <a data-target="#tc-modal" data-toggle="modal">Terms and Condition</a>
    </div>
    <button type="submit" class="btn btn-blue pull-right">Save</button>
</form>
