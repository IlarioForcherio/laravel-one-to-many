<?php

namespace App\Http\Controllers\Admin;
use  App\Model\Post;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(3);
        //con paginate crea delle pagine in caso in cui gli elementi siano tanti
        //funziona con il metodo links(), vedi index.blade.php
        //funziona solo importando l'ultima versione di bootstrap da cdn
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data =  $request->all();
       //la validazione(campi required), sara' presente in @error in create.blade
       $request->validate([
        'title' => 'required',
        'body' => 'required',
       ]);

       //una volta ricevuta una risposta si procere all'istanza di un nuovo record
       //si usa la funzione fill() per riempire le colonne automaticamente (bisogna renderle prima fillable dal modello)
       $new_post = new Post();
       $new_post->fill($data);
       //salvare sempre
       $new_post->save();

       return redirect()->route('admin.posts.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $singolo_post = Post::findOrFail($id);

        return view('admin.posts.show', compact('singolo_post', $singolo_post->$id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post_edit = Post::findOrFail($id);
        return view('admin.posts.edit', compact('post_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data =  $request->all();
        $post_update = Post::findOrFail($id);
        //mi recupero l'id e con update() effettuo effettivamente la modifica
        $post_update->update($data);

        return redirect()->route('admin.posts.show', $post_update->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_destroy =  Post::findOrFail($id);

        $post_destroy->delete();
        //mi recupero l'id e con delete() effettuo effettivamente la modifica
        return redirect()->route('admin.posts.index',  $post_destroy->id);

    }
}
