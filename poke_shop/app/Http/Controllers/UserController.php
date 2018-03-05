<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        /** Insert Image */
        $file = $request->file('profile_pic');
        $filename = $file->getClientOriginalName();
        $request->file('profile_pic')->move("image_profile/", $filename);
 
        $user->update([            
            'name' => $request->name,
            'email'=> $request->email, 
            'profile_picture'=> $filename, 
            'gender'=> $request->gender, 
            'dob'=> $request->dob, 
            'address'=> $request->address, 
            'role' => $request->role,
        ]);       
 
        return redirect('/admin/user')->with('msg-success', 'User Updated');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect('/admin/user')->with('msg-delete', 'User Deleted');
    }
}
