<?php

namespace App\Http\Controllers;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home.index');
    }

    public function services()
    {
        return view('home.services');
    }

    public function industries()
    {
        return view('home.industries');
    }

    public function about_od()
    {
        return view('home.about');
    }
    public function privacy()
    {
        return view('home.privacy');
    }

    public function index1()
    {
        return view('index.index');
    }

    /************************************ Services  ****************************/
    public function business_entity()
    {
        return view('index.business_entity');
    }

    public function ucc_nationwide()
    {
        return view('index.ucc_nationwide');
    }

    public function registered_agent()
    {
        return view('index.registered_agent');
    }

    public function apostille()
    {
        return view('index.apostille');
    }

    public function additional_services()
    {
        return view('index.additional_services');
    }

    /********************** Industries *******************/

    public function law_firms_and_paralegal()
    {
        return view('index.law_firms_and_paralegal');
    }

    public function corporations()
    {
        return view('index.corporations');
    }

    public function businesses()
    {
        return view('index.businesses');
    }

    public function real_estate()
    {
        return view('index.real_state');
    }

    /********************** About *******************/

    public function about()
    {
        return view('index.about');
    }

    public function special_offers()
    {
        return view('index.special_offers');
    }

    public function contact()
    {
        return view('index.contact');
    }

    public function privacy_policy()
    {
        return view('index.privacy_policy');
    }

}
