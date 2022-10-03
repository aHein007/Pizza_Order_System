<?php

namespace App\Http\Controllers\User;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class userController extends Controller
{
    function userLogout(){
        return view("user.home");
    }




}
