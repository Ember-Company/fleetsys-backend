<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class Controller extends \Illuminate\Routing\Controller
{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }
}
