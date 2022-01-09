@extends('layouts.app')

@section('title', '| Registrar')

@section('content')
    <div class="content">
        <form class="login-form sul-box-raised-2" action="{{ route('signup') }}" method="post">
            <h1>Registrar</h1>
            @csrf
            <input class="sul-text-field" type="name" name="name" placeholder="Nome">
            <input class="sul-text-field" type="email" name="email" placeholder="E-mail">
            <input class="sul-text-field" type="password" name="password" placeholder="Senha">
            <input class="sul-text-field" type="password" name="password_confirmation" placeholder="Confirmar Senha">
            <button class="sul-btn btn-block" type="submit">Cadastrar</button>
            <a class="sul-link" href="{{ route('login') }}">Login</a>
        </form>
    </div>
@endsection
