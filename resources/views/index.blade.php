@extends('layouts.app')

@section('title', '| Login')

@section('content')
    <div class="content">
        <form class="login-form sul-box-raised-2" action="{{ route('signin') }}" method="post">
            <h1>Login</h1>
            @csrf
            <input class="sul-text-field" type="email" name="email" placeholder="E-mail">
            <input class="sul-text-field" type="password" name="password" placeholder="Senha">
            <div class="remember-box">
                <input class="sul-checkbox-type-2" type="checkbox" name="remember"> Lembrar
            </div>
            <button class="sul-btn btn-block" type="submit">Entrar</button>
            <a class="sul-link" href="{{ route('register') }}">Registrar</a>
        </form>
    </div>
@endsection
