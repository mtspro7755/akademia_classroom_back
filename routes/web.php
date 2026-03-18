<?php

use Illuminate\Support\Facades\Route;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-mail', function () {
    Mail::to('talla.salla@terangacode.com')->send(new TestMail());
    //Mail::to('mstpro7755@gmail.com')->send(new TestMail());
    return "Email envoyé";
});
