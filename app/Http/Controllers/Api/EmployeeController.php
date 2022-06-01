<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Resources\EmployeeResource;
use App\Models\Employee;

class EmployeeController extends Controller
{

    public function __construct()
    {

        $this->middleware("auth:api");

    }

    public function index()
    {

        $employees = Employee::filter()->sort()->getOrPaginate();

        return EmployeeResource::collection($employees);

    }

    public function store(Request $request)
    {

        $request->validate([

            "names" => "required",
            "job" => "required"

        ]);

        $employee = Employee::create($request->all());

        return EmployeeResource::make($employee);

    }

    public function show($id)
    {

        $employee = Employee::included()->findOrFail($id);

        return EmployeeResource::make($employee);

    }

    public function update(Request $request, Employee $employee)
    {

        $request->validate([

            "names" => "required",
            "job" => "required"

        ]);

        $employee->update($request->all());

        return EmployeeResource::make($employee);

    }

    public function destroy(Employee $employee)
    {

        $employee->delete();

        return EmployeeResource::make($employee);

    }

}