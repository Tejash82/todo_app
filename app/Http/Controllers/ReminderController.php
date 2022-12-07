<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\reminder;
use Illuminate\Support\Facades\Validator;

class ReminderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return view('reminder.index');

        $reminders = reminder::all();
        return view('reminder.index',compact('reminders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z]+$/u|max:255|unique:users,name',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('reminder.index')->withErrors($validator);
        }

        reminder::create([
            'title'=>$request->get('title'),
            'description'=>$request->get('description'),
            'date'=>$request->get('date'),
        ]);

        return redirect()->route('reminder.index')->with('success', 'Inserted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reminder=reminder::where('id',$id)->first();
        return view('reminder.edit',compact('reminder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|regex:/^[a-zA-Z]+$/u|max:255|',
            'description' => 'required',
            'date' => 'required|date',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('reminder.edit',['reminder'=>$id])->withErrors($validator);
        }
        
        $reminder=reminder::where('id',$id)->first();
        $reminder->title=$request->get('title');
        $reminder->description=$request->get('description');
        $reminder->date=$request->get('date');
        
        $reminder->save();

        return redirect()->route('reminder.index')->with('success', 'Updated Reminder');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        reminder::find($id)->delete();
        return redirect()->route('reminder.index')->with('success','Reminder deleted successfully');
    }
}
