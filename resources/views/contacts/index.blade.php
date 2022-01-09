@extends('layouts.app')

@section('title', '| Contatos')

@section('content')
    <a href="{{ route('logout') }}" id="logout-btn" class="sul-btn top-btn">
        <i class="fas fa-sign-out-alt"></i>
    </a>
    <div class="page-title">
        <h1>Contatos</h1>
        <a href="{{ route('contacts.create') }}" class="sul-btn">
            <i class="fas fa-plus"></i>
        </a>
    </div>

    <div class="contacts-container">
        @foreach ($contacts as $contact)
            <a href="{{ route('contacts.show', $contact->id) }}" class="sul-box-raised-2 with-hover contact-container">
                <i class="fas fa-user"></i> {{ $contact->name }}
            </a>
        @endforeach
    </div>
@endsection
