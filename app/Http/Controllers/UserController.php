<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() {
        $faker = \Faker\Factory::create();
        $users = array();
        for ($i = 0; $i < 15; $i++) {
            $users[] = array(
                'name' => $faker->name,
                'about' => $faker->paragraph,
                'phoneNumber' => $faker->phoneNumber,
                'email' => $faker->email,
                'company' => $faker->company,
            );
        }

        return view('user.index', compact('users'));
    }
}
