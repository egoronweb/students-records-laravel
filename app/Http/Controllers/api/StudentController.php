<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function index(){
        $students = Student::all();

        return response()->json([
            'status' => 200,
            'students' => $students,
        ]);
    }


    public function create(Request $request){
        $student = new Student;
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->subject_code = $request->input('subject_code');
        $student->descriptive_title = $request->input('descriptive_title');
        $student->semester = $request->input('semester');
        $student->year = $request->input('year');
        $student->grade = $request->input('grade');
        $student->re_exam = $request->input('re_exam');
        $student->save();

        return response()->json([
            'status' => 200,
            'message' => 'Added Successfully'
        ]);
    }

    public function edit($id){
        $student = Student::find($id);
    
        return response()->json([
            'status' => 200,
            'student' => $student,
        ]);
    }

    public function update(Request $request, $id){
        $student = Student::find($id);
        $student->first_name = $request->input('first_name');
        $student->last_name = $request->input('last_name');
        $student->subject_code = $request->input('subject_code');
        $student->descriptive_title = $request->input('descriptive_title');
        $student->semester = $request->input('semester');
        $student->year = $request->input('year');
        $student->grade = $request->input('grade');
        $student->re_exam = $request->input('re_exam');
        $student->save();

        return response()->json([
            'status' => 200,
            'message' => 'Students updated Successfully',
        ]);
    }

    public function destroy($id){
        $student = Student::find($id);
        $student->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Users deleted Successfully',
        ]);
    }



}
