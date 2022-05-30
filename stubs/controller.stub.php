<?php

namespace Descom\Supervisor\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SupervisorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([]);
    }
}
