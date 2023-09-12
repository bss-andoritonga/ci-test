<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        $session = session();

        // Set a session variable
        $session->set('username', 'JohnDoe');

        // Get a session variable
        $username = $session->get('username');

        return view('test', ['username' => $username]);
    }
}
