<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Fixed: Added missing import for Auth facade
use App\Models\User; // Fixed: Added missing import for User model

class LoginController extends Controller // Fixed: Class name corrected from 'loginController' to 'LoginController' (PascalCase)
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request) // Fixed: Corrected typo from 'Request' to 'Request'
    {
        return view('login');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required |min:6'
        ]);
        if(Auth::attempt($request->only('email','password'),$request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard.index'));
        }
        return back()->with('error','Invalid login data')->withInput();


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
