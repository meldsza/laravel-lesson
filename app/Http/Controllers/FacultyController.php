<?php

namespace App\Http\Controllers;

use App\Faculty;
use App\User;
use DB;
use Hash;
use Auth;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $faculties = Faculty::paginate(50);
        if ($request->wantsJson()) {
            return $faculties;
        }
        else{
            return view('faculty.index', ['faculties'=>$faculties]);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('faculty.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'password' => 'string|required|min:5|confirmed',
            'employee_code' => 'string|required',
            'designation' => 'string|required',
        ]);
        $data['password'] = Hash::make($data['password']);
        DB::transaction(function () use($data) {
            $faculty = new Faculty();
            $faculty->fill($data);
            $faculty->save();
            $user = new User();
            $user->fill($data);
            $user->details()->associate($faculty)->save();
        }, 5);
        if ($request->wantsJson()) {
            return ['message' => 'success'];
        }
        else{
            return redirect(route('faculties.index'))->with(['message' => 'success']);
        }
    }
    public function addDetails(Request $request)
    {
        $data = $request->validate([
            
            'employee_code' => 'string|required',
            'designation' => 'string|required',
        ]);
        
        DB::transaction(function () use($data) {
            $faculty = new Faculty();
            $faculty->fill($data);
            $faculty->save();
            $user = Auth::user();
            $user->details()->associate($faculty)->save();
        }, 5);
        return redirect()->intended('/');
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,Faculty $faculty)
    {
        if ($request->wantsJson()) {
            return $faculty;
        }
        else{
            return view('faculty.show',['faculty' => $faculty]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function edit(Faculty $faculty)
    {
        return view('faculty.edit',['faculty' => $faculty]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Faculty $faculty)
    {
        $data = $request->validate([
            'name' => 'string|required',
            'employee_code' => 'string|required|unique:faculties,employee_code,' . $faculty->id . ',id',
            'designation' => 'string|required',
        ]);
        DB::transaction(function () use($faculty, $data){
            $faculty->fill($data);
            $user = $faculty->user;
            $user->fill($data);
            $user->save();
            $faculty->save();
        }, 5);
        if ($request->wantsJson()) {
            return ['message' => 'success'];
        }
        else{
            return redirect(route('faculties.index'))->with(['message' => 'success']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,Faculty $faculty)
    {
        DB::transaction(function () use($faculty) {
            $faculty->user->delete();
            $faculty->delete();
        });
        if ($request->wantsJson()) {
            return ['message' => 'success'];
        }
        else{
            return redirect(route('faculties.index'))->with(['message' => 'success']);
        }
    }
}
