@extends('layouts.app')

@section('title', '| Editar Contato')

@section('content')
    <div class="content">
        <a href="{{ route('logout') }}" id="logout-btn" class="sul-btn top-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        <a href="{{ route('contacts.show', $contact->id) }}" id="back-btn" class="sul-btn top-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <form class="login-form sul-box-raised-2" action="{{ route('contacts.update', $contact->id) }}" method="post">
            <h1>Editar Contato</h1>
            @csrf
            @method('PUT')
            <input class="sul-text-field" type="name" name="name" value="{{ $contact->name }}">
            <input class="sul-text-field" type="email" name="email" value="{{ $contact->email }}">
            <input class="sul-text-field" type="phone" name="phone" value="{{ $contact->phone }}">
            <button class="sul-btn btn-block" type="submit">Editar</button>
        </form>
    </div>
@endsection
