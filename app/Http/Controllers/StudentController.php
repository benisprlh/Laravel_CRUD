<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Subject;

class StudentController extends Controller
{
    //
    public function index() {
        $Students = Student::with('subjects')->get();
        return view('student.index', ['students' => $Students]);
    }

    public function search(Request $request)
    {
        $query = $request->input('search');

        $results = Student::where('name', 'LIKE', "%$query%")
                          ->orWhere('gender', 'LIKE', "%$query%")
                          ->orWhere('address', 'LIKE', "%$query%")
                          ->get();

        return view('student.index', ['students' => $results]);
    }

    public function create() {
        return view('student.create');
    }

    public function store(Request $request) {
        $dataStudent = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);
        $newStudent = Student::create($dataStudent);
        $dataSubjects = $request->input('nama');
        foreach ($dataSubjects as $subject) {
            Subject::create([
                'name' => $subject,
                'student_id' => $newStudent->id
            ]);
        };
        return redirect(route('student.index'));
        
    }

    public function edit(Student $student){
        return view('student.edit', ['student' => $student]);
    }

    public function update(Student $student, Request $request){
        $dataStudent = $request->validate([
            'name' => 'required',
            'gender' => 'required',
            'address' => 'required'
        ]);
        $student->update($dataStudent);

        foreach ($student->subjects as $key => $value) {
            $subject = Subject::where('name', $value->name)->where('student_id', $student->id)->first();
            if(!$subject){
                dd($value);
            }
            
            $flag = false;

                foreach ($request->nama as $key2 => $value2) {
                    if ($subject->name == $value2) {
                        $flag = false;
                        break;
                    }
                    $flag = true;
                }

            if ($flag) {
                $subject->delete();
            }
        }
        if($request->nama){

            foreach ($request->nama as $key => $value) {
                $subject = Subject::firstOrCreate(['name' => $value, 'student_id' => $student->id]);
            }
        }
        return redirect(route('student.index'));
    }

    public function destroy(Student $student) {
        $student->delete();
        return redirect(route('student.index'));
    }
}
