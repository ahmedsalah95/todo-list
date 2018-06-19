<?php

namespace App\Http\Controllers;

use App\Mail\Mailtrap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
class MailController extends Controller
{
    public function index()
    {


        Mail::to(Auth::user()->email)->send(new Mailtrap());
    }
}
