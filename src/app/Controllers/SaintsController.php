<?php

namespace App\Controllers;

class SaintsController
{
    public function index()
    {
        view('saints/index.php');
    }

    public function create()
    {
        view('saints/create.php');
    }

    public function store()
    {
        //
    }

    public function show()
    {
        //
    }

    public function edit()
    {
        view('saints/edit.php');
    }

    public function update()
    {
        //
    }

    public function destroy()
    {
        //
    }
}
