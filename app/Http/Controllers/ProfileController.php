<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('front.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->all();
        unset($data['_token']);
        unset($data['user_id']);
        if ($data['password'] != "") {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        User::where('id', auth()->user()->id)->update($data);
        return redirect()->back()->with('success_message', 'User Berhasil Diperbarui!');
    }
}
