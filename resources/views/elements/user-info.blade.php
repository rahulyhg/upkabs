<div class="panel panel-default main-container">
    <a href="{{ $avatar_url.$user['avatar'] }}">
        <div class="thumbnail card-thumbnail">
            <img class="media-object" src="{{ $avatar_url.$user['avatar'] }}" alt="{{ $user['name'] }}">
        </div>
    </a>
    <div class="panel-body card-body">
        <h3>{{ $user['name'] }}</h3>
        <ul class="list-group">
            <li class="list-group-item list-item"><i class="fa fa-quote-left list-item-icon"></i>{{ $user['bio'] }}</li>
        </ul>
    </div>
    <div class="panel-footer">
        <div class="btn-group btn-group-justified" role="group">
            <a data-target="#info-modal" data-toggle="modal" class="btn btn-default">Info</a>
            <a data-target="#contact-modal" data-toggle="modal" class="btn btn-default">Contact</a>
        </div>
    </div>

    <!-- Contact Modal -->
    <div class="modal fade" id="contact-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog deactive-modal-dialog" role="document">
            <div class="modal-content main-container">
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item list-item"><i class="fa fa-envelope-o list-item-icon"></i>{{ $user['email'] }}</li>
                        <li class="list-group-item list-item"><i class="fa fa-phone list-item-icon"></i>{{ $user['phone'] }}</li>
                        <li class="list-group-item list-item"><i class="fa fa-globe list-item-icon"></i>{{ $user['website'] }}</li>
                    </ul>
                </div>
                <div class="modal-footer deactive-modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="deactive-cancel-button">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Info Modal -->
    <div class="modal fade" id="info-modal" tabindex="-1" role="dialog">
        <div class="modal-dialog deactive-modal-dialog" role="document">
            <div class="modal-content main-container">
                <div class="modal-body">
                    <ul class="list-group">
                        <li class="list-group-item list-item"><i class="fa fa-clock-o list-item-icon"></i>Since <time class="timeago" datetime="{{ $user['date'] }}"></time></li>
                        <li class="list-group-item list-item"><i class="fa fa-id-badge list-item-icon"></i>{{ $user['position'] }}</li>
                        @if ($user['gender'] == 1)
                            <li class="list-group-item list-item"><i class="fa fa-mars list-item-icon"></i>Man</li>
                        @else
                            <li class="list-group-item list-item"><i class="fa fa-venus list-item-icon"></i>Woman</li>
                        @endif
                    </ul>
                </div>
                <div class="modal-footer deactive-modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" id="deactive-cancel-button">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
