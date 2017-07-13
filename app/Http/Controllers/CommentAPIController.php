<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use App\Libraries\CommentLibrary;
use Session;

class CommentAPIController extends BaseController
{
    public function __construct()
    {

    }

    // Get Data All Post's Comment
    public function getPostComments($post)
    {
        // Get Response JSON From Comment Library
        $response = CommentLibrary::getPostComments($post);

        // Return A JSON
        return response()->json($response);
    }

    // Register new comment
    public function createComment(Request $request)
    {

        // Set variable
        $text = $request->input('text');
        $post = $request->input('post');
        $commentator = Session::get('id');

        // Parameter to be passed to API
        $params = array(
            'text' => $text,
            'post' => $post,
            'commentator' => $commentator
        );

        // Get Response JSON From Comment Library
        $response = CommentLibrary::createComment($params);

        // Return A JSON
        return response()->json($response);
    }

    // Delete comment profile
    public function deactiveComment(Request $request)
    {
        // Set variable
        $comment = $request->input('comment');

        // Parameter to be passed to API
        $params = array(
            'id' => $comment
        );

        // Get Response JSON From Comment Library
        $response = CommentLibrary::deactiveComment($params);

        // Redirect to a page
        return $response;
    }

    function __destruct() {

    }
}
