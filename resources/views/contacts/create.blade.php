@extends('layouts.app')

@section('title', '| Criar Contato')

@section('content')
    <div class="content">
        <a href="{{ route('logout') }}" id="logout-btn" class="sul-btn top-btn">
            <i class="fas fa-sign-out-alt"></i>
        </a>
        <a href="{{ route('contacts.index') }}" id="back-btn" class="sul-btn top-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
        <form class="login-form sul-box-raised-2" action="{{ route('contacts.store') }}" method="post">
            <h1>Criar Contato</h1>
            @csrf
            <input class="sul-text-field" type="name" name="name" placeholder="Nome">
            <input class="sul-text-field" type="email" name="email" placeholder="E-mail">
            <input class="sul-text-field" type="phone" name="phone" placeholder="Telefone">
            <button class="sul-btn btn-block" type="submit">Criar</button>
        </form>
    </div>
@endsection
