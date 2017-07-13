<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Libraries\UpLibrary;

use Session;

class UpAPIController extends BaseController
{
    // Get Data All Post's Up
    public function getPostUps($post)
    {
        // Get Response JSON From Up Library
        $response = UpLibrary::getPostUps($post);

        // Return A JSON
        return $response;
    }

    // Register new comment
    public function createUp(Request $request)
    {

        // Set variable
        $post = $request->input('post');
        $upper = Session::get('id');

        // Parameter to be passed to API
        $params = array(
            'post' => $post,
            'upper' => $upper
        );

        // Get Response JSON From Up Library
        $response = UpLibrary::createUp($params);

        // Return A JSON
        return $response;
    }

    // Delete comment profile
    public function deleteUp($post, $bookmark)
    {
        // Get Response JSON From Up Library
        $response = UpLibrary::deleteUp($post, $bookmark);

        // Redirect to a page
        return $response;
    }

    function __destruct() {

    }
}
