<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use View;
use Input;
use Illuminate\Support\Facades\Redirect;
use Session;

class HomeController extends Controller
{
  public function getHome()
  {
    if(UserController::checkLogin()) return View::make('admin.dashboard');
    else {
      return Redirect::route('getLogin')->with("mensagem", "Sua sessão expirou.");;
    }
  }

  public function getLogin()
  {
    return View::make('login');
  }

  public function getAbout()
  {
    return View::make('about');
  }
}
