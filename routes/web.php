<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'pusher', 'middleware' => ['auth']], function(){
    Route::post('posts/{id}', function($id, \Illuminate\Http\Request $request){
        $comment = new \App\Comment([
            'comment' => $reques->input('comment'),
            'user' => auth()->user()->id,
            'post_id' => $id
        ]);
            $comment->save();
            // Emite el siguiente evento a Excepción de a Nosotros mismos...
            broadcast(new \App\Events\FireComment($comment))->toOthers();
    })->name('comments.create');


    // Retorna Vista Chat Con Comentarios
    Route::get('posts/{id}', function($id){
        $post = \App\Post::findOrFail($id);
        return view('chat', compact('post'));
    })->name('comments.list');

    // Ruta que Retorna un Json Con Comentarios de Acuerdo al POST_ID 
    Route::get('comments/{id}', function($id){
        $comments = \App\Comment::where('post_id', $id)->with('user')->get();
        return response()->json($coments);
    });
});