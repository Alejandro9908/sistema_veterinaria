<?php

namespace sisVeterinaria\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use sisVeterinaria\Http\Requests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $loginView = 'acceso.login';
    protected $guard = 'admins';

    public function authenticated(){
        return redirect('ventas/venta');
    }

    public function secret(){
       
    }

}
