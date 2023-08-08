<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $data = Auth::user();

        return view('auth.profile', compact('data'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('old_password') && $request->filled('new_password')) {
            $request->validate([
                'old_password' => 'required_with:new_password|string',
                'new_password' => 'nullable|string|min:8|confirmed',
                'new_password_confirmation' => 'same:new_password'
            ]);

            if (Hash::check($request->old_password, $user->password)) {
                $user->password = bcrypt($request->new_password);
            } else {
                return redirect()->back()->withErrors(['old_password' => 'Password lama tidak sesuai.']);
            }
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil berhasil diupdate.');
    }
}
