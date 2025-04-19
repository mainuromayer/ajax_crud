<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\Request;

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

            $employee = Employee::create([
                'name' => $request->name,
                'email' => $request->email,
                'department_id' => $request->department_id,
            ]);

            return response()->json([
                'status' => true,
                'message' => 'Employee created',
                'data' => $employee
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
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

            $employee = Employee::find($request->id);
            $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->department_id = $request->department_id;
            $employee->save();

            return response()->json([
                'status' => true,
                'message' => 'Employee updated',
                'data' => $employee
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => $e->getMessage()
            ]);
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

