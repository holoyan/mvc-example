<?php

namespace App\Http\Controllers;
use App\Models\User;
use Core\Request;

class UserController
{
    public function getProfile()
    {
        return view('login.welcome', [
            'hello' => 'hello world'
        ]);
    }

    public function home($id)
    {
        dd($id);
    }

    public function foo($id)
    {
        dd('foo ' . $id);
    }

    public function fooBar($id, $name)
    {
        dd('fooBar ' . $id, $name);
    }

    public function store()
    {
        $data = Request::make()->all();
        $user = new User();
        $user->insert($data);

        return redirect('/profile');
    }
}