<?php
use Illuminate\Support\Facades\Route;

Route::get('/', 'HomeController@index');

Route::get('/stats/{id}', 'HomeController@admin')->name('stats');

Route::get('/dashboard', function(){
    $page = 'dashboard';
    return view('page.dashboard', compact('page'));
});

Route::get('/miners/{id}', 'HomeController@miners')->name('miners');

Route::get('/blocks', function(){
    $page = 'blocks';
    return view('page.blocks', compact('page'));
});

Route::get('/payments', function(){
    $page = 'payments';
    return view('page.payments', compact('page'));
});

Route::get('/connect', function(){
    $page = 'connect';
    return view('page.connect', compact('page'));
});

Route::get('/faq', function(){
    $page = 'faq';
    return view('page.faq', compact('page'));
});

Route::get('/support', function(){
    $page = 'support';
    return view('page.support',compact('page'));
});