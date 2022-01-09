@extends('layouts.app')

@section('title', '| Contato')

@section('content')
    <div class="content">
        <a href="{{ route('logout') }}" id="logout-btn" class="sul-btn top-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        <a href="{{ route('contacts.index') }}" id="back-btn" class="sul-btn top-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <div class="sul-box-raised-2 contact-container">
            <a
                href="{{ route('contacts.edit', $contact->id) }}"
                id="edit-btn"
                class="sul-btn top-right-btn"
            >
                <i class="fas fa-edit"></i>
            </a>
            <form action="{{ route('contacts.destroy', $contact->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" id="delete-btn" class="sul-btn top-right-btn">
                    <i class="fas fa-trash"></i>
                </button>
            </form>
            <h1>Contato</h1>
            <p><i class="fas fa-user"></i> {{ $contact->name }}</p>
            <p><i class="fas fa-at"></i> {{ $contact->email }}</p>
            <p><i class="fas fa-phone"></i> {{ $contact->phone }}</p>
        </div>
    </div>
@endsection
