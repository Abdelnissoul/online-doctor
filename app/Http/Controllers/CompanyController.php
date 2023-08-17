<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Contact;
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
        return $this->refresh();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $company = new Company();
        $company->company = $request->company;
        $company->company_locked = $request->company_locked;
        $company->account_manager_id = $request->account_manager_id;
        $company->clientid = $request->clientid;
        $company->phone = $request->phone;
        $company->fax = $request->fax;
        $company->fedex = $request->fedex;
        $company->company_tax_id = $request->company_tax_id;
        $company->type = $request->type;
        $company->customer_type_id = $request->customer_type_id;
        $company->company_tax_id = $request->company_tax_id;
        $company->tier = $request->tier;
        if ($request->company_bulk_order == true || $request->company_bulk_order == "true" || $request->company_bulk_order == 1) {
            $company->company_bulk_order = "true";
        } else {
            $company->company_bulk_order = "false";
        }
        // $company->company_ucc_monitoring = $request->company_ucc_monitoring;
        $company->special_instructions = $request->special_instructions;
        // $company->company_weekly_billing = $request->company_weekly_billing;
        $company->company_cc_surcharge = $request->company_cc_surcharge;
        $company->company_active = $request->company_active;
        $company->save();
        return $this->refresh();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return response()->json($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $company = Company::find($id);
        $company->company = $request->company;
        $company->company_locked = $request->company_locked;
        $company->account_manager_id = $request->account_manager_id;
        $company->clientid = $request->clientid;
        $company->phone = $request->phone;
        $company->fax = $request->fax;
        $company->fedex = $request->fedex;
        $company->company_tax_id = $request->company_tax_id;
        $company->type = $request->type;
        $company->customer_type_id = $request->customer_type_id;
        $company->company_tax_id = $request->company_tax_id;
        $company->tier = $request->tier;
        if ($request->company_bulk_order == true || $request->company_bulk_order == "true" || $request->company_bulk_order == 1) {
            $company->company_bulk_order = "true";
        } else {
            $company->company_bulk_order = "false";
        }
        // $company->company_ucc_monitoring = $request->company_ucc_monitoring;
        $company->special_instructions = $request->special_instructions;
        // $company->company_weekly_billing = $request->company_weekly_billing;
        $company->company_cc_surcharge = $request->company_cc_surcharge;
        $company->company_active = $request->company_active;
        $company->save();
        return $this->refresh();
    }

    public function company_info(Request $request, $id)
    {
        $company = Company::find($id);
        $company->company = $request->company;
        $company->save();
        return $this->refresh();
    }

    public function locations(Request $request, $id)
    {
        $company = Company::find($id);
        $company->street1 = $request->street1;
        $company->save();
        return $this->refresh();
    }

    public function contact(Request $request, $id)
    {
        $company = Company::find($id);
        $company->clientid = $request->clientid;
        $company->save();
        return $this->refresh();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->delete();
        return $this->refresh();
    }

    public function refresh()
    {
        $companies = Company::orderbydesc('created_at')->get();
        foreach ($companies as $company) {
            $contact = Contact::find($company->clientid);
            $company->setAttribute('contact', $contact);
        }
        return response()->json($companies);
    }
}
