<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Libraries\CommentLibrary;
use Session;

class NotificationsAPIController extends BaseController
{
    public function __construct()
    {

    }

    // Get data all comment
    public function getNotifications()
    {
        // Set Variable
        $user = Session::get('id');

        // Get Response JSON From Comment Library
        $response = CommentLibrary::getCommentsToUser($user);

        // Render Response As A Array
        $response_rendered = [
            'comments' => $response,
            'total' => $response['total']['unread']
        ];

        // Return A JSON
        return response()->json($response_rendered);
    }

    // Delete comment profile
    public function deactiveNotifications()
    {
        // Set Variable
        $user = Session::get('id');

        // Get Response JSON From Comment Library
        $response = CommentLibrary::deactiveCommentsToUser($user);

        // Return A JSON
        return $response;
    }

    function __destruct() {

    }
}
