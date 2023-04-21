<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserRequest;
use App\Http\Requests\EditUserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        if($search != null){
            $user = User::where('name', 'iLIKE', "%{$search}%")->orWhere('email', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString();
        } else {
            $user = User::paginate(10)->withQueryString();
        }

        return view('user.index',[
            'users' => $user
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateUserRequest $request)
    {
        $data = $request->validated();

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect('/user')->with('peringtan', 'Berhasil menambahkan data user.');
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
        $user = User::where('id', $id)->first();

        return view('user.edit',[
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EditUserRequest $request, string $id)
    {
        $data = $request->validated();

        User::where('id', $id)->update($data);

        return redirect('/user')->with('peringatan', 'Berhasil mengubah data user.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);

        return back()->with('peringatan', 'Berhasil menghapus data user.');
    }

    // public function search(Request $request)
    // {
    //     $search = $request->input('search');

    //     if($search != null){
    //         $admin = User::where('role', 'admin')->where('name', 'iLIKE', "%{$search}%")->orWhere('email', 'iLIKE', "%{$search}%")->paginate(6); 
    //     } else {
    //         $admin = User::where('role','admin')->paginate(6);
    //     }

    //     return view('user_cms.index',[
    //         'admins' => $admin
    //     ]);
    // }
}
