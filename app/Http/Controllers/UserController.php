<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Foundation\Validation\ValidatesRequests;

class UserController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    use ValidatesRequests;

    public function index(Request $request): View
    {
        $data = User::where('host_id', auth()->user()->host_id)->latest()->paginate(5);
  
        return view('users.index',compact('data'))
            ->with('i', ($request->input('page', 1) - 1) * 5);
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        $roles = Role::where('host_id', auth()->user()->host_id)->pluck('name','name')->all();

        return view('users.create',compact('roles'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['host_id'] = auth()->user()->host_id;
    
        $user = User::create($input);
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('employees.index')
                        ->with('success','User created successfully');
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $user = User::where('host_id', auth()->user()->host_id)->find($id);

        return view('users.show',compact('user'));
    }
    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)#: View
    {
        
        if($id == auth()->user()->host_id && auth()->user()->id != auth()->user()->host_id){
           //return redirect()->route('employees.index'); 
           //return redirect()->route('employees');
           return redirect('/dashboard');
           //return Redirect::to(url('/'));
           exit;
        }else{
            $user = User::find($id);
            $roles = Role::where('host_id', auth()->user()->host_id)->pluck('name','name')->all();
            $userRole = $user->roles->pluck('name','name')->all();
        
            return view('users.edit',compact('user','roles','userRole'));
        }
        
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'password' => 'same:confirm-password',
            'roles' => 'required'
        ]);
    
        $input = $request->all();
        if(!empty($input['password'])){ 
            $input['password'] = Hash::make($input['password']);
        }else{
            $input = Arr::except($input,array('password'));    
        }
    
        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id',$id)->delete();
    
        $user->assignRole($request->input('roles'));
    
        return redirect()->route('employees.index')
                        ->with('success','Employee updated successfully');
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id): RedirectResponse
    {
        User::where('host_id', auth()->user()->host_id)->find($id)->delete();
        return redirect()->route('employees.index')
                        ->with('success','Employee deleted successfully');
    }
}
