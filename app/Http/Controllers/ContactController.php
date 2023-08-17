<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ContactController extends Controller
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
        $contact = new Contact();
        $contact->contact_fname = $request->contact_fname;
        $contact->contact_lname = $request->contact_lname;
        $contact->contact_email = $request->contact_email;
        $contact->contact_dept = $request->contact_dept;
        $contact->contact_phone = $request->contact_phone;
        $contact->contact_fax = $request->contact_fax;
        $contact->contact_position = $request->contact_position;
        $contact->contact_area_of_law = $request->contact_area_of_law;
        $contact->contact_role = $request->contact_role;
        $contact->contact_referred_by = $request->contact_referred_by;
        $contact->contact_notes = $request->contact_notes;
        $contact->contact_ssn = $request->contact_ssn;
        $contact->contact_extension = $request->contact_extension;
        $contact->contact_password = Hash::make($request->contact_password);
        $contact->save();
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
        $contact = Contact::find($id);
        return response()->json($contact);
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
        $contact = Contact::find($id);
        $contact->contact_fname = $request->contact_fname;
        $contact->contact_lname = $request->contact_lname;
        $contact->contact_email = $request->contact_email;
        $contact->contact_dept = $request->contact_dept;
        $contact->contact_phone = $request->contact_phone;
        $contact->contact_fax = $request->contact_fax;
        $contact->contact_position = $request->contact_position;
        $contact->contact_area_of_law = $request->contact_area_of_law;
        $contact->contact_role = $request->contact_role;
        $contact->contact_referred_by = $request->contact_referred_by;
        $contact->contact_notes = $request->contact_notes;
        $contact->contact_ssn = $request->contact_ssn;
        $contact->contact_extension = $request->contact_extension;
        if ($request->contact_password != null) {
            $contact->contact_password = Hash::make($request->contact_password);

        } else {

        }
        $contact->save();
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
        $contact = Contact::find($id);
        $contact->delete();
        return $this->refresh();
    }

    private function refresh()
    {
        $contacts = Contact::orderbydesc('created_at')->get();
        return response()->json($contacts);
    }
}
