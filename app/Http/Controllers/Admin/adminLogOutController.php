<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class adminLogOutController extends Controller
{
    //admin Log out
    function adminLogout(){
        return view("admin.home");
    }
}
