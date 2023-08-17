<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('subscriptions');
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

    public function subscriptions()
    {
        return view('hamburger_menu.subscriptions');
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
        $subscription = new Subscription();
        $subscription->qb_item_id = $id;
        $subscription->subscription_name = $request->subscription_name;
        $subscription->subscription_fee = $request->subscription_fee;
        $subscription->save();
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
        $subscription = Subscription::find($id);
        return response()->json($subscription);
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
        $subscription = Subscription::find($id);
        $subscription->subscription_fee = $request->subscription_fee;
        $subscription->subscription_name = $request->subscription_name;
        $subscription->qb_item_id = $request->qb_item_id;
        $subscription->save();
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
        $subscription = Subscription::find($id);
        $subscription->delete();
        return $this->refresh();
    }

    private function refresh()
    {
        $subscriptions = Subscription::orderbydesc('created_at')->get();
        return response()->json($subscriptions);
    }
}
