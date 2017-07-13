<form action="{{ url('post/create') }}" method="post" enctype="multipart/form-data">
    <!-- CSRF TOKEN -->
    {{ csrf_field() }}

    <div class="form-group">
        <label>Title</label>
        <textarea class="form-control main-form-control" placeholder="Title here..." name="title" required></textarea>
    </div>
    <div class="form-group">
        <label>Text</label>
        <textarea class="form-control main-form-control" placeholder="Text here..." name="text" required></textarea>
    </div>
    <div class="form-group">
        <label>Media</label>
        <input type="file" name="media" id="image">
    </div>
    <div class="form-group">
        <label>Category (only one category)</label>
        <div id="post-category">
            <input type="text" name="category" class="form-control main-form-control typeahead" placeholder="Type to see the suggestions..." required>
        </div>
    </div>
    <div class="form-group">
        <label>Refrences (optional)</label>
        <input type="text" name="refrence" class="form-control main-form-control" placeholder="Refrence here...">
    </div>
    <div class="form-group">
        By submitting this form I agree <a data-target="#tc-modal" data-toggle="modal">Terms and Condition</a>
    </div>
    <button type="submit" class="btn btn-blue pull-right">Post</button>
</form>
