<?php

namespace App\Http\Controllers;

use App\Models\Login2;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;

class Login2Controller extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $login2s = Login2::paginate(10);
            return response()->json($login2s);
        }

        return view('login2.index');
    }
    

    public function create()
    {
        return view('login2.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required',
            'email' => 'required|email|unique:login2',
            'password' => 'required',
        ]);

        Login2::create($request->all());

        return redirect()->route('login2.index')
                         ->with('success', 'User created successfully.');
    }

    public function show(Login2 $login2)
    {
        return view('login2.show', compact('login2'));
    }

    public function edit(Login2 $login2)
    {
        return view('login2.edit', compact('login2'));
    }

    public function update(Request $request, Login2 $login2)
    {
        $request->validate([
            'nama' => 'required',
            'nomor' => 'required',
            'email' => 'required|email|unique:login2,email,' . $login2->id,
            'password' => 'required',
        ]);

        $login2->update($request->all());

        return redirect()->route('login2.index')
                         ->with('success', 'User updated successfully');
    }

    public function destroy(Login2 $login2)
    {
        $login2->delete();

        return redirect()->route('login2.index')
                         ->with('success', 'User deleted successfully');
    }
}
