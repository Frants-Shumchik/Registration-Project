<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

use App\Http\Middleware\CheckRole;
use App\Http\Middleware\AdminRedirect;

Route::middleware([ CheckRole::class ])->prefix('admin')->group(function() {
    Route::get('tests/create', 'AdminController@newTest');
    Route::post('tests/create', 'AdminController@postNewTest');

    Route::get('tests', 'AdminController@tests');
    Route::get('tests/{id}', 'AdminController@editTest');
    Route::post('tests/{id}', 'AdminController@postEditedTest');
    Route::delete('tests/{id}', 'AdminController@removeTest');
    Route::patch('tests/{id}', 'AdminController@patchTest');

    Route::get('results/', 'AdminController@results');

    Route::get('members', 'AdminController@showMembers');
    Route::post('members', 'AdminController@addMember');

    Route::post('organization', 'AdminController@editOrganization');
});

Route::middleware([ AdminRedirect::class ])->group(function() {
    Route::get('/results', 'TestsController@results');

    Route::get('/tests', 'TestsController@tests');
    Route::get('/tests/{id}', 'TestsController@test');
    Route::post('/tests/{id}', 'TestsController@postTest');

    Route::get('/', function() {
        if (Auth::check()) {
            View::share('user', Auth::user());
            // $organization = \App\Organization::find(Auth::user()->organization_id);\
            $organization = new \App\Organization();
            $organization->name = 'MRK';
            return view('pages.home', [ 'organization' => $organization]);
        } else {
            return redirect('login');
        }
    });
});

Route::get('/logout', 'Auth\LoginController@logout');
Auth::routes();
