<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;


    protected $redirectTo = '/admin';


    public function username()
    {
        return 'name';
    }


    public function __construct()
    {
        $this->middleware('guest')->except('/admin-login-view');
    }


}