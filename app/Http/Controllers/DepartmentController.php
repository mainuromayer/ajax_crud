<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\View\View;
use App\Models\Department;
use Illuminate\Http\Request;
use Dotenv\Exception\ValidationException;

class DepartmentController extends Controller
{
    public function departmentPage(): View
    {
        return view('department');
    }

    public function list()
    {
        try {
            $departments = Department::with('department')->get();
            return response()->json([
                'status' => true,
                'data' => $departments
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function create(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|unique:departments,name',
            ]);
    
            $department = Department::create([
                'name' => $request->name,
            ]);
    
            return response()->json([
                'status' => true,
                'message' => 'Department created',
                'data' => $department
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $e->errors()
            ], 422);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:departments,id',
                'name' => 'required|unique:departments,name,' . $request->id,
            ]);

            $department = Department::find($request->id);
            $department->name = $request->name;
            $department->save();

            return response()->json([
                'status' => true,
                'message' => 'Department updated',
                'data' => $department
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false, 
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:departments,id',
            ]);

            Department::destroy($request->id);
            return response()->json([
                'status' => true,
                'message' => 'Department deleted'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false, 
                'message' => $e->getMessage()
            ], 500);
        }
    }
}