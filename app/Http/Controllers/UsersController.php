<?php

namespace App\Http\Controllers;


use Flash;

use App\User;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
 

    /**
     * Display a listing of the User.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
       
        if(auth()->user()->type =="admin")
     $users = User::all();
        elseif(auth()->user()->type =="customer")
        $users =User::where('id',auth()->user()->id)->get();
  

        return view('users.index')
            ->with('users', $users);
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
       
        
        return view('users.create');
        
    }

    /**
     * Store a newly created User in storage.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => 'required',
        'email' => 'required|string|email|max:255|unique:users,email,'.auth()->user()->email,
        'password' => 'required|confirmed',
        'type'=>'required|not_in:0'
    ],
        [ 
      'name.required' => 'Name is Required',
      'email.required' => 'Email is Required',
       'password.required'=>'Password is Required',
       'type.required'=>'User type is Required'
       
        ]);

        $input = $request->all();

        $input['password'] =Hash::make($input['password']);
        
        $user = User::create($input);
 
        //send mail 

        Flash::success('User saved successfully.');

        return redirect(route('user.index'));
    
    }

    /**
     * Display the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id = null)
    {
        if(!isset($id)){
            $user = User::where('id',Auth::user()->id)->first();
           
        }else {
         $user = User::find($id);

        }
       
       

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('users.index'));
        }

    
        return view('users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id=null)
    {
       if(!isset($id)){
            $user = User::where('id',Auth::user()->id)->first();
           
        }else {
         $user = User::find($id);

        }

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('user.index'));
        }
       
        return view('users.edit')
        ->with('user', $user);
         
      
   
    }

    /**
     * Update the specified User in storage.
     *
     * @param int $id
     * @param Request $request
     *
     * @return Response
     */
    public function update($id,Request $request)
    {
       
        
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('user not found');

            return redirect(route('user.index'));
        }

        $input = $request->all();
     $request->validate([
      'email' => 'required|email|unique:users,email,'.$user->id,
      'name' => 'required',
      'password' => 'sometimes|confirmed',
  ]);

   if(Auth::user()->role_id == 1)
   User::where('id', $id)->update(['role_id' => $request->role_id]);

  
   //

     if ($input['password']=="")
    $input = $request->except('password', 'password_confirmation');
   else
   $input['password'] =Hash::make($input['password']);

 
        $user->update($input);
 
        //send Mail
        Flash::success('User updated successfully.');

        return redirect(route('user.index'));
     
     
    }

    /**
     * Remove the specified User from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('user.index'));
        }

        $user->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('user.index'));
    }
}
