<?php

namespace App\Http\Controllers;

use App\Models\UCCJurisdictionMap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UccJurisdictionMapController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $state = $request->state;
        $county = $request->county;
        if ($request->state && $request->county) {
            $uccs = DB::table('jurisdiction_county')
                ->where('jurisdiction_county_state', 'LIKE', '%'.$state.'%')
                ->where('jurisdiction_county_name', 'LIKE', '%'.$county.'%')
                ->get();
        } else if ($request->state) {
            $uccs = DB::table('jurisdiction_county')
                ->where('jurisdiction_county_state', 'LIKE', '%'.$state.'%')
                ->get();
        } else if ($request->county) {
            $uccs = DB::table('jurisdiction_county')
                ->where('jurisdiction_county_name', 'LIKE', '%'.$county.'%')
                ->get();
        } else {
            $uccs = DB::table('jurisdiction_county')->get();

        }
        return response()->json($uccs);
        // return view('hamburger_menu.ucc')->with('uccs', $uccs);
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
    public function store(Request $request, $id)
    {
        // $validated = $request->validate([
        //     'jurisdiction_name' => 'required',
        // ]);
        $ucc = new UCCJurisdictionMap();
        $ucc->jurisdiction_county_id = $id;
        $ucc->jurisdiction_name = $request->jurisdiction_name;
        $ucc->federal_tax_lien_search = $request->federal_tax_lien_search;
        $ucc->fixture_dot_search = $request->fixture_dot_search;
        $ucc->judgment_lien_search = $request->judgment_lien_search;
        $ucc->mechanic_lien_search = $request->mechanic_lien_search;
        $ucc->state_tax_lien_search = $request->state_tax_lien_search;
        $ucc->save();
        // return redirect()->route('hamburger_menu.ucc');
        return response()->json($ucc);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
