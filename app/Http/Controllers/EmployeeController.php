<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if($search != null){
            $employee = Employee::where('name', 'iLIKE', "%{$search}%")->orWhere('address', 'iLIKE', "%{$search}%")->paginate(10)->withQueryString(); 
        } else {
            $employee = Employee::paginate(10)->withQueryString();
        }

        return view('employee.index',[
            'employees' => $employee
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employee.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EmployeeRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);
        
        $data['user_id'] = $user->id;
        
        if($request->file('logo')){
            $extension  = request()->file('logo')->getClientOriginalExtension();
            $image_name = time() .'.' . $extension;
            $data['image'] = $request->file('logo')->storePubliclyAs('image', $image_name, 'public');
        }

        Employee::create($data);

        return redirect('/employee')->with('peringatan', 'Berhasil menambahkan data karyawan baru.');
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
        $employee = Employee::where('id', $id)->first();

        return view('employee.edit',[
            'employee' => $employee
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, string $id)
    {
        $employee = Employee::where('id', $id)->first();
        $data = $request->validated();

        $data['user_id'] = $employee->user_id;
        $data['password'] = Hash::make($data['password']);
        
        if($request->file('logo')){
            if($employee->image != null){
                $file_path = storage_path('/app/public/'.$employee->image);
                unlink($file_path);                
            }
            $extension  = request()->file('logo')->getClientOriginalExtension();
            $image_name = time() .'.' . $extension;
            $data['image'] = $request->file('logo')->storePubliclyAs('image', $image_name, 'public');
        }

        User::where('id', $employee->user_id)->update([
            'email' => $data['email'],
            'password' => $data['password'],
            'role' => $data['role']
        ]);
        Employee::where('id', $id)->update([
            'name' => $data['name'],
            'job_position' => $data['job_position'],
            'address' => $data['address'],
            'phone' => $data['phone'],
            'image' => $data['image'],
        ]);

        return redirect('/employee')->with('peringatan','Berhasil mengubah data karyawan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::where('user_id', $id)->first();

        User::destroy($id);
        if($employee->image != null){
            $file_path = storage_path('/app/public/'.$employee->image);
            unlink($file_path); 
        }

        return back()->with('peringatan', 'Berhasil menghapus data pelanggan.');
    }
}
