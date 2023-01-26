@extends('layouts.dashboard')

@section('content')
{{-- Form per la creazione di un nuovo post --}}
{{-- la destinazione della create e' la funzione store --}}

<form action="{{route('admin.posts.update',$post_edit->id)}}" method='POST'>
    {{-- token obbligatorio del form --}}
    @csrf
    {{-- invio informazione con metodo put --}}
    @method('PUT')
    {{-- Nella edit va aggiunto anche il value che estraggo da show(l'id del singolo post) --}}
    <div>
        <label class="mt-3 form-label" >Titolo</label>
        <input value="{{$post_edit->title}}" class="form-control" type="text" name="title">
        @error('title')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    {{-- per i testi lunghi si usa textarea  --}}
    <div>
        <label class="mt-3 form-label">Body</label>
        <textarea class="form-control" type="text" name="body">{{$post_edit->body}}</textarea>
        @error('body')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
    </div>
    {{-- bottone per mandare l'informazione a store con l'attributo type='submit' --}}
    <button type='submit' class="mt-3 btn btn-primary">Modifica</button>
</form>


@endsection
