<?php

namespace App\Http\Controllers;

use App\Http\Services\UserService;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @var UserService
     */
    protected $service;

    /**
     * UserController constructor.
     *
     * @param UserService $service
     */
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    /**
     * Mostra página de autenticação de usuário
     *
     * @return view
     */
    public function login()
    {
        return view('index');
    }

    /**
     * Mostra página de registro de usuário
     *
     * @return view
     */
    public function register()
    {
        return view('register');
    }

    /**
     * Executa a autenticação do usuário
     *
     * @param SigninRequest $request
     *
     * @return redirect
     */
    public function signin(SigninRequest $request)
    {
        $serviceResponse = $this->service->signin(
            $request->email,
            $request->password,
            $request->remember
        );

        if (!$serviceResponse['success']) {
            return back()->withError($serviceResponse['message']);
        }

        $request->session()->regenerate();
        return redirect()->route('contacts.index');
    }

    /**
     * Executa o registro do usuário
     *
     * @param SignupRequest $request
     *
     * @return redirect
     */
    public function signup(SignupRequest $request)
    {
        $serviceResponse = $this->service->signup(
            $request->name,
            $request->email,
            bcrypt($request->password)
        );

        if (!$serviceResponse['success']) {
            return back()->withError($serviceResponse['message']);
        }

        return redirect()->route('contacts.index');
    }

    /**
     * Executa o logout do usuário
     *
     * @param Request $request
     *
     * @return redirect
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
