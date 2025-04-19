<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmployeeController extends Controller
{
    public function employeePage(): View
    {
        return view('employee');
    }

    public function list()
    {
        try {
            $employees = Employee::with('department')->get();
            return response()->json([
                'status' => true,
                'data' => $employees
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
                'name' => 'required|string',
                'email' => 'required|email|unique:employees,email',
                'department_id' => 'required|exists:departments,id',
            ]);
    
            $employee = Employee::create($request->only(['name', 'email', 'department_id']));
    
            return response()->json([
                'status' => true,
                'message' => 'Employee created',
                'data' => $employee
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
                'id' => 'required|exists:employees,id',
                'name' => 'required|string',
                'email' => 'required|email|unique:employees,email,' . $request->id,
                'department_id' => 'required|exists:departments,id',
            ]);
    
            $employee = Employee::findOrFail($request->id);
            $employee->update($request->only(['name', 'email', 'department_id']));
    
            return response()->json([
                'status' => true,
                'message' => 'Employee updated',
                'data' => $employee
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
    

    public function delete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|exists:employees,id',
            ]);

            Employee::destroy($request->id);
            return response()->json([
                'status' => true,
                'message' => 'Employee deleted'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
        }
    }
}

