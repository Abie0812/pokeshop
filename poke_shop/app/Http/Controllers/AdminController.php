<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;

class AdminController extends Controller
{
    public function dashboard() 
    {   
        $name = Auth::user()->name;
        return view('admin.index')->with('name', $name);
    }    

    
}
