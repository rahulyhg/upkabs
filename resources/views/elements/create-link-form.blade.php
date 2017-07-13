<form action="{{ url('post/create') }}" method="post" enctype="multipart/form-data">
    <!-- CSRF TOKEN -->
    {{ csrf_field() }}

    <div class="form-group">
        <label>Link (should be http not https)</label>
        <input type="text" class="form-control main-form-control" placeholder="Link here..." id="link" required>
    </div>
    <div class="panel panel-default main-container">
        <div class="panel-body">
            <div class="media" id="link-preview-container">
                Click here for load the preview 
            </div>
            <button type="button" class="btn btn-default btn-block">Reload preview</button>
        </div>
    </div>
    <div class="form-group">
        <label>Category (only one category)</label>
        <div id="post-category">
        <input type="text" name="category" class="form-control main-form-control typeahead" placeholder="Type to see the suggestions..." required>
    </div>
    <div class="form-group">
        By submitting this form I agree <a data-target="#tc-modal" data-toggle="modal">Terms and Condition</a>
    </div>

    <!-- Hidden Input -->
    <input type="hidden" name="title" id="input-title" required>
    <input type="hidden" name="text" id="input-text" required>
    <input type="hidden" name="media" id="input-media" required>
    <input type="hidden" name="refrence" id="input-refrence" required>

    <button type="submit" class="btn btn-blue pull-right">Post</button>
</form>
