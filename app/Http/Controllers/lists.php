<?php

namespace App\Http\Controllers;

use App\Models\Lists as ModelsLists;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;


class lists extends Controller
{
    public function create(Request $request)
    {
        // dd($request->all());
        // $request->validate([
        //     'listName' => 'required',
        // ]);
        ModelsLists::create([
            'title' => $request->listName,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->back()
            ->with('success', 'List created successfully.');
    }

    public function getList(Request $request)
    {
        $lists = ModelsLists::all();

        return view('dashboard', compact('lists'));
    }


    public function newUser(Request $request)
    {

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'permission' => $request->permission
        ]);
        return redirect()->back();
    }
}
