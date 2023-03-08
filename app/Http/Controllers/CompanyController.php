<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;


class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);;
        return view('company', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create_company');
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
            'inputCompanyName' => 'required|unique:companies,name|max:255',
            'inputCompanyEmail1' => 'nullable|email|unique:companies,email|max:255',
            'inputCompanyLogo' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);

        $imageName =""; 
        //image uploading
        if($request->hasFile('inputCompanyLogo')){
            //filename with Extension
            $image = $request->file('inputCompanyLogo');
            $imageName =  time() . '.' . $image->extension();
            //file to store
            $request->file('inputCompanyLogo')->storeAs('public/logo/',$imageName);
        }

        //store data to databse
        $company = new Company;
        $company->name = $request->inputCompanyName;
        $company->email = $request->inputCompanyEmail1;
        $company->website = $request->inputCompanyWebsite;
        $company->logo = $imageName;
        $company->save();

        return redirect('company')->with('status', 'Successfully added!');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('edit_company', compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validation
        $validated = $request->validate([
            'inputCompanyName' => 'required|max:255|unique:companies,name,'.$id,
            'inputCompanyEmail1' => 'nullable|email|unique:companies,email|max:255',
            'inputCompanyLogo' => 'image|mimes:jpg,png,jpeg,gif,svg|dimensions:min_width=100,min_height=100',
        ]);

        $imageName =""; 
        //image uploading
        if($request->hasFile('inputCompanyLogo')){
            //filename with Extension
            $image = $request->file('inputCompanyLogo');
            $imageName =  time() . '.' . $image->extension();
            //file to store
            $request->file('inputCompanyLogo')->storeAs('public/logo/',$imageName);
        }

        //store data to databse
        $company = Company::find($id);
        $company->name = $request->inputCompanyName;
        $company->email = $request->inputCompanyEmail1;
        $company->website = $request->inputCompanyWebsite;
        $company->logo = $imageName;
        $company->save();

        return redirect('company')->with('status', 'Successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company=Company::find($id);
        $company->delete();

        return redirect('company')->with('status', 'Successfully deleted!');
    }
}
