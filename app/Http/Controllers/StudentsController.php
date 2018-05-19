<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($id = null) {

        if ($id == null) {
            return Student::orderBy('id', 'asc')->get();
        } else {
            return $this->show($id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        return Student::find($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request) {


        if($request->hasfile('file'))
        {
            $file = $request->file;
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
        }

        $student= new Student();

        $student->name = $request->name;
        $date = date_create($request->admission_date);
        $format = date_format($date,"Y-m-d");
        $student->admission_date = $format;
        $student->email = $request->email;
        $student->faculty = $request->faculty;
        $student->major = $request->major;
        $student->filename = $request->filename;
        $student->country = $request->country;
        $student->file_original_name = $name;
        $student->selected_subjects = $request->selected_subjects;

        $student->save();

        return 'Student record successfully created with id ' . $student->id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id) {
        $student = Student::find($id);

        if($request->hasfile('file'))
        {
            $file = $request->file;
            $name=time().$file->getClientOriginalName();
            $file->move(public_path().'/images/', $name);
            $student->file_original_name = $name;
        }

        $student->name = $request->name;
        $date = date_create($request->admission_date);
        $format = date_format($date,"Y-m-d");
        $student->admission_date = $format;
        $student->email = $request->email;
        $student->faculty = $request->faculty;
        $student->major = $request->major;
        $student->country = $request->country;
        $student->filename = $request->filename;
        $student->selected_subjects = $request->selected_subjects;

        $student->save();

        return "Success updating student #" . $student->id;
    }


    /**
     * Remove the specified resource from storage.
     *
     * @return Response
     */
    public function destroy(Request $request) {

        $student = Student::find($request->input('id'));

        $student->delete();

        return "Student record successfully deleted #" . $request->input('id');
    }



}
