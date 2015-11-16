<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/books/', function() {
//   return 'Here are all the books:';
// });

Route::get('/books', 'BookController@getIndex');

// Route::get('/books/{category}', function($category) {
//   return 'Here are all the books in catagory of '.$category;
// });
Route::get('/books/create', 'BookController@getCreate');

Route::get('/books/show/{title?}', 'BookController@getShow');
// Adding ? end of title making title optional

Route::get('/new', function(){
    $view  = '<form method="POST">';
    $view .= csrf_field(); # This will be explained more later
    $view .= 'Title: <input type="text" name="title">';
    $view .= '<input type="submit">';
    $view .= '</form>';
    return $view;
});

Route::post('/new', function(){
  $input = Input::all();
  print_r($input);
});

Route::get('/image', function(){
  $img = Image::make('foo.jpg')->resize(1000, 800);
  $img->blur(15);
   return $img->response('jpg');
});

Route::get('/logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

Route::get('/tag', 'TagController@index');
Route::get('/tag/create', 'TagController@create');
Route::post('/tag', 'TagController@store');
Route::get('/tag/{tag_id}', 'TagController@show');
Route::get('/tag/{tag_id}/edit', 'TagController@edit');
Route::put('/tag/{tag_id}', 'TagController@update');
Route::delete('/tag/{tag_id}', 'TagController@destroy');

Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(config('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    /*
    The following line will output your MySQL credentials.
    Uncomment it only if you're having a hard time connecting to the database and you
    need to confirm your credentials.
    When you're done debugging, comment it back out so you don't accidentally leave it
    running on your live server, making your credentials public.
    */
    //print_r(config('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    }
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
