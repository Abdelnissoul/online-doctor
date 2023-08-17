<?php

namespace App\Http\Controllers;

use App\Models\Survey;
use Illuminate\Http\Request;

class SurveyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('surveys');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function surveys()
    {
        return view('hamburger_menu.surveys');

    }

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
        $survey = new Survey();
        $survey->survey_name = $request->survey_name;
        $survey->survey_duration = $request->survey_duration;
        $survey->survey_end_date = $request->survey_end_date;
        $survey->survey_heading = $request->survey_heading;
        $survey->survey_subject = $request->survey_subject;
        $survey->survey_description = $request->survey_description;
        if ($request->survey_active == "1" || $request->survey_active == 1 || $request->survey_active == '1' || $request->survey_active == true) {
            $survey->survey_active = "true";
        } else {
            $survey->survey_active = "false";
        }
        $survey->save();
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
        $survey = Survey::find($id);
        return response()->json($survey);
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
        $survey = Survey::find($id);
        $survey->survey_name = $request->survey_name;
        $survey->survey_duration = $request->survey_duration;
        $survey->survey_end_date = $request->survey_end_date;
        $survey->survey_heading = $request->survey_heading;
        $survey->survey_subject = $request->survey_subject;
        $survey->survey_description = $request->survey_description;
        if ($request->survey_active == "1" || $request->survey_active == 1 || $request->survey_active == '1' || $request->survey_active == true) {
            $survey->survey_active = "true";
        } else {
            $survey->survey_active = "false";
        }
        $survey->save();
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
        $survey = Survey::find($id);
        $survey->delete();
        return $this->refresh();
    }

    public function refresh()
    {
        $surveys = Survey::orderbydesc('created_at')->get();
        return response()->json($surveys);
    }
}
