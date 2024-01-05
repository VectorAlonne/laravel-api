<?php

namespace App\Http\Controllers\Api;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class StundentController extends Controller
{
    public function index()
    {
        $students = Student::all();
        if($students->count() > 0){

            return response()->json([
                'status' => 200,
                'students' => $students
            ], 200);
        }else{

            return response()->json([
                'status' => 404,
                'message' => 'No Records Found'
            ], 404);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else{
            $student = Student::create([
                'name' => $request->name,
                'course' => $request->course,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if($student){
                return response()->json([
                    'status' => 200,
                    'message' => "Student Created Succesfully"
                ], 200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' => "Something Went Wrong"
                ], 500);
            }
        }
    }

    public function show($id)
    {
        $student = Student::find($id);
        if($student){
            return response()->json([
                'status' => 200,
                'Student' => $student
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Student Found!"
            ], 404);
        }
    }
    public function update(Request $request, int $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:191',
            'course' => 'required|string|max:191',
            'email' => 'required|email|max:191',
            'phone' => 'required|digits:9',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages()
            ], 422);
        } else{

            $student = Student::find($id);

            if($student){
                $student->update([
                    'name' => $request->name,
                    'course' => $request->course,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);

                return response()->json([
                    'status' => 200,
                    'message' => "Student Update Succesfully"
                ], 200);
            }else{
                return response()->json([
                    'status' => 404,
                    'message' => "No Such Student Found"
                ], 404);
            }
        }
    }
    public function destroy($id)
    {
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status' => 200,
                'message' => "Student Deleted Succesfully"
            ], 200);

        }else{
            return response()->json([
                'status' => 404,
                'message' => "No Such Student Found"
            ], 404);
        }
    }
}
