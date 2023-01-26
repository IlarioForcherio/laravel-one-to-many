@extends('layouts.dashboard')

@section('content')
{{-- Form per la creazione di un nuovo post --}}
{{-- la destinazione della create e' la funzione store --}}

<form action="{{route('admin.posts.store')}}" method='POST'>
    {{-- token obbligatorio del form --}}
    @csrf
    {{-- il form sara' generalmente composto da una label e un input, e si deve aggiungere a input l'attributo name='nomeDellaColonna'  --}}
    <div>
        <label class="mt-3 form-label" >Titolo</label>
        <input class="form-control" type="text" name="title">
        @error('title')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
    </div>
    {{-- per i testi lunghi si usa textarea  --}}
    <div>
        <label class="mt-3 form-label">Body</label>
        <textarea class="form-control" type="text" name="body"></textarea>
        @error('body')
        <div class="alert alert-danger">{{$message}}</div>
    @enderror
    </div>
    {{-- bottone per mandare l'informazione a store con l'attributo type='submit' --}}
    <button type='submit' class="mt-3 btn btn-primary">Crea</button>
</form>


@endsection
