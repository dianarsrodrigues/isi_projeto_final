<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function getAllUsers() {
        $allUsers = User::get();
        $search = request()->query('search') ? request()->query('search') : null;

        if(request()->query('user_id')){
            $users = User::where('id', request()->query('user_id'))->get();
        } elseif($search) {
            $users = User::where('name', "LIKE", "%{$search}%")
            ->orwhere('email', "LIKE", "%{$search}%")
            ->get();
        } else {
            $users = User::get();
        }
        return view('users.all_users', compact('users', 'allUsers'));
    }

    public function addUser(Request $request) {
        $id = $request->query('id');
        $user = User::where('id', $id)->first();
        return view('users.add_users', compact('user'));
    }

    public function storeUser(Request $request) {
        $validated = $request->validate([
            'name' => 'string|max:50',
            'email' => 'email|unique:users|required',
            'password' => 'min:8',
        ]);

        User::insert([
            'name' => $request->name,
            'email' => $request->email,
            'created_at' => new DateTime(),
            'password' => Hash::make($request->password),
            'user_type' => $request->user_type
        ]);

        return redirect()->route('users.all')->with('message', 'User adicionado com sucesso');
    }

    public function updateUser(Request $request, $id) {
        $validated = $request->validate([
            'name' => 'string|max:50',
            'password' => 'nullable|min:8',
        ]);

        $data = ['name' => $request->name, 'user_type' => $request->user_type];

        if ($request->has('password') && !empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($data);
        return redirect()->route('users.all')->with('message', 'User atualizado com sucesso');
    }

    public function viewUser($id) {
        $user = User::where('id', $id)->first();
        return view('users.viewUser', compact('user'));
    }

    public function deleteUser($id) {
        $user = User::where('id', $id)->delete();
        return redirect()->route('users.all')->with('message', 'User eliminado com sucesso');
    }
}
