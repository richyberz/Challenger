<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::id();
        
        if($id == null) {
            return redirect('/login');
        }


        $profile = User::findOrFail($id);
        return view('profile', compact('profile'));
    }

   /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $inputs = array(
        'starting_date' => '1900-01-01',
        'ending_date' => 'today'

       );
       
       
        $rules = array(
            'username' => 'required|string|min:5|max:30',
            'firstname' => 'required|string|min:2|max:30',
            'lastname' => 'required|string|min:2|max:30',
            'email' => 'required|string|min:5|max:70',
            'birthDate' => 'required|date|after:starting_date|before:ending_date',
        ); 

        $this->validate($request, $rules); 
        
        $profile = new Profile();
        $profile->id = $request->id;
        $profile->username = $request->username;
        $profile->firstname = $request->firstname;
        $profile->lastname = $request->lastname;
        $profile->email = $request->email;
        $profile->birthDate = $request->birthDate;
        $profile->save();        
        return back();      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $currentuserid = Auth::id();
        if(User::where('id', '=', $currentuserid)->value('role') == 1) {
            $profile = ReaderCard::findOrFail($id);
            return view('profile', compact('id', 'profile'));
        }
    }
}

