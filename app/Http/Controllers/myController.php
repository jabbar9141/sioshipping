<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\myNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class myController extends Controller
{
    public function notification(){
        $users = User::all();
        Notification::send($users, new myNotification($users)); 
        
        return view('home');
    }
}
