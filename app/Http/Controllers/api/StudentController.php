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
        $student->fullname = $request->input('fullname');
        $student->semester = $request->input('semester');
        $student->year = $request->input('year');
        $student->year_level = $request->input('year_level');
        $student->final_grade = $request->input('final_grade');
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
        $student->fullname = $request->input('fullname');
        $student->semester = $request->input('semester');
        $student->year = $request->input('year');
        $student->year_level = $request->input('year_level');
        $student->final_grade = $request->input('final_grade');
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
