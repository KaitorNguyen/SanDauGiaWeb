<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        // $user = User::all();
        $user = User::paginate(10);
        return view('admin.listuser', compact('user'));
    }

    public function lockUser($id)
    {
        $user = User::where("id", $id)->first();
        if ($user->is_active)
        {
            $user->is_active = false;
        }
        else
        {
            $user->is_active = true;
        }
        $user->save();
        return back();
    }
}
