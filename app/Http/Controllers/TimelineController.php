<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;

class TimelineController extends BaseController
{
    public function __construct()
    {

    }

    public function showTimeline()
    {
        return view('timeline');
    }

    function __destruct() {

    }
}
