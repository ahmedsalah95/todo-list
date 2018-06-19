<?php

namespace App\Http\Controllers;

use App\File;
use App\Image;
use Illuminate\Http\Request;

use App\Note;
use App\User;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use response;
use App\http\Requests;
use Mail;
use Carbon\Carbon;
class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Auth_user = Auth::user();

        $notes = $Auth_user->notes;
        $today = Carbon::today();
     //   $notes=Note::paginate(4);
        // return View::make('notes.index')->with('notes',$notes);
        return view('notes.index',['notes'=>$notes,'today'=>$today]);
    }




    public function addNote(Request $request)
    {


        $this->validate($request,[

            'name'=>'required',
            'description'=>'required',
            'dueDate'=>'required'

        ]);



        $noteSave = new Note();
        $noteSave->name = $request['name'];
        $noteSave->description=$request['description'];
        $noteSave->dueDate=$request['dueDate'];
        $noteSave->user_id=Auth()->id();
        $noteSave->save();

       return response()->json($noteSave);



    }

    public function editNote(Request $request)
    {

        $noteSave = Note::find($request->id);

      /*  $noteSave->name = $request['name'];
        $noteSave->description=$request['description'];
        $noteSave->dueDate=$request['dueDate'];
        $noteSave->user_id=Auth()->id();*/
        $noteSave->name = $request->name;
        $noteSave->description = $request->description;
       // $noteSave->dueDate = $request->dueDate;
       // $noteSave->user_id=Auth()->id();
        $noteSave->save();
        return response()->json($noteSave);
    }


    public function deleteNote(Request $request)
    {
        $noteSave = Note::find($request->id)->delete();
        return response()->json();
    }

    public function addAlt($id)
    {
        $note = Note::where('id',$id)->get();

       return view('notes.img',['note'=>$note,'id'=>$id]);
    }

    public function submitAlt(Request $request)
    {
         $file = $request->file('image');
        $filename = $file->getClientOriginalName();
        $path = "img/alt_images";
        $file->move($path,$filename);


       // dd($request->all());
        $imageSave = new Image();
        $imageSave->status  = $request['status'];
        $imageSave->note_id = $request['note_id'];
        $imageSave->img   = $filename;

        $imageSave->save();

        return back();

    }

    public function addFile($id)
    {
        $note = Note::where('id',$id)->get();
        return view('notes.file',['note'=>$note,'id'=>$id]);
    }

    public function submitFile(Request $request)
    {
        $file = $request->file('file');
        $filename = $file->getClientOriginalName();
        $path = "file/alt_files";
        $file->move($path,$filename);

        $fileSave = new File();
        $fileSave->status = $request['status'];
        $fileSave->note_id = $request['note_id'];
        $fileSave->file = $filename;
        $fileSave->save();
        return back();
    }

}
