<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);;
        return view('employee', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id','name')->get();
        return view('create_employee',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $validated = $request->validate([
            'inputEmployeeFirstName' => 'required|max:255',
            'inputEmployeeLastName' => 'required|max:255',
            'inputEmployeeEmail1' => 'nullable|email|unique:employees,email|max:255',
            'inputEmployeePhone' => 'nullable|min:9|numeric',
            'inputEmployeeCompany' => 'required',
        ]);

        //store data to databse
        $company = new Employee;
        $company->first_name = $request->inputEmployeeFirstName;
        $company->last_name = $request->inputEmployeeLastName;
        $company->company_id = $request->inputEmployeeCompany;
        $company->email = $request->inputEmployeeEmail1;
        $company->phone = $request->inputEmployeePhone;
        $company->save();

        return redirect('employee')->with('status', 'Successfully added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        $companies = Company::select('id','name')->get();
        return view('edit_employee', compact('employee','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $validated = $request->validate([
            'inputEmployeeFirstName' => 'required|max:255',
            'inputEmployeeLastName' => 'required|max:255',
            'inputEmployeeEmail1' => 'nullable|email|max:255|unique:employees,email,'.$id,
            'inputEmployeePhone' => 'nullable|min:9|numeric',
            'inputEmployeeCompany' => 'required',
        ]);

        //store data to databse
        $company = Employee::find($id);
        $company->first_name = $request->inputEmployeeFirstName;
        $company->last_name = $request->inputEmployeeLastName;
        $company->company_id = $request->inputEmployeeCompany;
        $company->email = $request->inputEmployeeEmail1;
        $company->phone = $request->inputEmployeePhone;
        $company->save();

        return redirect('employee')->with('status', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee=Employee::find($id);
        $employee->delete();

        return redirect('employee')->with('status', 'Successfully deleted!');
    }
}
