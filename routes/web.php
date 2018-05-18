<?php

Auth::routes();
Route::get('/home', 'PostsController@index');

//Hard Coded Login and Registration
//Route::get('/register','RegistrationController@create');
//Route::post('/register','RegistrationController@store');
//Route::get('/login','SessionsController@create');
//Route::post('/logIn','SessionsController@store');
Route::get('/logout', 'SessionsController@destroy');

Route::get('/', 'PostsController@index')->name('home');

Route::prefix('posts')->group(function () {
    Route::get('/old', 'PostsController@index_oldest');
    Route::get('/create', 'PostsController@create');
    Route::post('/store', 'PostsController@store');
    Route::get('/{post}', 'PostsController@show');
    Route::post('/{post}/comments', 'CommentsController@store');
});


Route::group(['middleware' => ['admin']], function () {
    Route::prefix('admin')->group(function () {
        Route::any('/', 'AdminController@index');

        Route::get('/{admin}/profile','AdminController@show');

        Route::get('/{id}/show', 'AdminController@show');
        Route::get('/{id}/edit', 'AdminController@edit');
        Route::post('/{id}/update', 'AdminController@update');
        Route::post('/{id}/destroy', 'AdminController@destroy');

        Route::post('/store/user', 'AdminController@createUser');
        Route::get('/create/user', 'AdminController@getUserField');
        Route::get('/{id}/deuser', 'AdminController@deuser'); //deactivate all user posts and comments


        Route::get('/post', 'AdminController@posts');
        Route::get('/waitingPosts','AdminController@waitingPosts');
        Route::get('/updatedPosts','AdminController@updatedPosts');
        Route::get('/activePosts','AdminController@activePosts');
        Route::get('/deactivePosts','AdminController@deactivePosts');
        Route::get('/{post}/showpost', 'AdminController@showPost');
        Route::get('/{post}/editpost', 'AdminController@editPost');
        Route::post('/{post}/updatepost', 'AdminController@updatepost');
        Route::get('/{post}/activepost', 'AdminController@activePost');
        Route::get('/{post}/deactivepost', 'AdminController@deactivePost');
        Route::get('/{post}/destroypost', 'AdminController@destroypost');

        Route::get('/comments', 'AdminController@comments');
        Route::get('/waitingComments','AdminController@waitingComments');
        Route::get('/updatedComments','AdminController@updatedComments');
        Route::get('/activeComments','AdminController@activeComments');
        Route::get('/deactiveComments','AdminController@deactiveComments');
        Route::get('/{post}/showcomments', 'AdminController@showComment');
        Route::get('/{comment}/editcomment', 'AdminController@editComment');
        Route::post('/{post}/updatecomment', 'AdminController@updatecomment');
        Route::get('/{comment}/activecomment', 'AdminController@activeComment');
        Route::get('/{comment}/deactivecomment', 'AdminController@deactiveComment');
        Route::get('/{comment}/destroycomment', 'AdminController@destroyComment');
        Route::get('session', 'AdminController@showS');
    });
});





Route::prefix('user')->group(function () {

    Route::get('/{id}/profile', 'UserController@profile');

    Route::get('/{id}/edit', 'UserController@edit');
    Route::post('/{id}/update', 'UserController@update');
    Route::get('/{id}/destroy', 'UserController@destroy');
    Route::get('/{id}/deuser', 'UserController@deuser');

    Route::get('/{id}/posts', 'UserController@posts');
    Route::get('{user}/{post}/showpost','UserController@showPost');
    Route::get('/{user}/{post}/editpost', 'UserController@editPost');
    Route::post('/{post}/updatepost', 'UserController@updatepost');
    Route::get('/{user}/{post}/activepost', 'UserController@activePost');
    Route::get('/{user}/{post}/deactivepost', 'UserController@deactivePost');
    Route::get('/{user}/{post}/destroypost', 'UserController@destroypost');

    Route::get('/{id}/comments', 'UserController@comments');
    Route::get('/{user}/{comment}/editcomment', 'UserController@editComment');
    Route::post('/{comment}/updatecomment', 'UserController@updatecomment');
    Route::get('/{user}/{comment}/activecomment', 'UserController@activeComment');
    Route::get('/{user}/{comment}/deactivecomment', 'UserController@deactiveComment');
    Route::get('/{user}/{comment}/destroycomment', 'UserController@destroyComment');

    Route::get('/{id}/editcomments', 'UserController@editComment');

});