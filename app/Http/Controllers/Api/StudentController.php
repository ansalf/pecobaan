<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{

    public function StudentIndex(){
        $student = Student::latest()->get();
        return response()->json($student);
    } // End Method

    public function StudentStore(Request $request){

      $validateData = $request->validate([
            'name' => 'required|unique:students|max:25',
            'email' => 'required|unique:students|max:25'
        ]);

            Student::insert([
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => $request->photo,
                'gender' => $request->gender,
                'created_at' => Carbon::now(),
            ]);
            return response('Student Inserted Successfully');

    } // End Method 


    public function StudentEdit($id){

         $student = Student::findOrFail($id);
        return response()->json($student);

    }// End Method 


    public function StudentUpdate(Request $request,$id){

          Student::findOrFail($id)->update([
                'class_id' => $request->class_id,
                'section_id' => $request->section_id,
                'name' => $request->name,
                'address' => $request->address,
                'phone' => $request->phone,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'photo' => $request->photo,
                'gender' => $request->gender,

        ]);
        return response('Student Updated Successfully');

    } // End Method 


    public function StudentDelete($id){

         Student::findOrFail($id)->delete();
        return response('Student Deleted Successfully');

    } // End Method 

} 
