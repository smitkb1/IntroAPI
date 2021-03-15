<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Car;
use Illuminate\Http\Request;
use Validator;

class ApiController extends Controller
{
    public function createStudent(Request $request) {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], 403);
        } else {
            Student::create($request->all());
            return response()->json(['message' => 'Student created.'], 201);
        }

    }

    public function updateStudent(Request $request, $id) {
        $students = Student::query();
        if ($students->where('id', $id)->exists()) {
            $student = $students->find($id);
            $student->first_name = is_null($request->first_name) ? $student->first_name : $request->first_name;
            $student->last_name = is_null($request->last_name) ? $student->last_name : $request->last_name;
            $student->phone_number = is_null($request->phone_number) ? $student->phone_number : $request->phone_number;
            $student->email_address = is_null($request->email_address) ? $student->email_address : $request->email_address;
            $student->save();
            return response()->json(['message' => 'Student updated.'], 200);
        } else {
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }

    public function deleteStudent($id) {
        $students = Student::query();
        if ($students->where('id', $id)->exists()) {
            $student = $students->find($id);
            $student->delete();
            return response()->json(['message' => 'Student deleted.'], 202);
        } else {
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }

    public function getAllStudents(Request $request)
    {
        $students = Student::query();
        if ($request->get('first_name')) {
            $students->where('first_name', '=', $request->get('first_name'))->get();
        }
        return $students->get();
    }
    
    public function getStudent($id) {
        $students = Student::query();
        if ($students->where('id', $id)->exists()) {
            $student = $students->where('id', $id)->get();
            return response($student, 200);
        } else {
            return response()->json(['message' => 'Student not found.'], 404);
        }
    }

    public function createCar(Request $request) {
        Car::create($request->all());
        return response()->json(['message' => 'Car created.'], 201);
    }

    public function updateCar(Request $request, $id) {
        $cars = Car::query();
        if ($cars->where('id', $id)->exists()) {
            $cars = $students->find($id);
            $cars->name = is_null($request->name) ? $car->name : $request->name;
            $cars->year = is_null($request->year) ? $car->year : $request->year;
            $cars->price = is_null($request->price) ? $car->price : $request->price;
            $car->save();
            return response()->json(['message' => 'Car updated.'], 200);
        } else {
            return response()->json(['message' => 'Car not found.'], 404);
        }
    }

    public function deleteCar($id) {
        $cars = Car::query();
        if ($cars->where('id', $id)->exists()) {
            $car = $cars->find($id);
            $car->delete();
            return response()->json(['message' => 'Car deleted.'], 202);
        } else {
            return response()->json(['message' => 'Car not found.'], 404);
        }
    }

    public function getAllCars(Request $request)
    {
        $cars = Car::query();
        if ($request->get('name')) {
            $cars->where('name', '=', $request->get('name'))->get();
        }
        return $cars->get();
    }

    public function getCar($id) {
        $cars = Car::query();
        if ($cars->where('id', $id)->exists()) {
            $car = $cars->where('id', $id)->get();
            return response($car, 200);
        } else {
            return response()->json(['message' => 'Car not found.'], 404);
        }
    }
}