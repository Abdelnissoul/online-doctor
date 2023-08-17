<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Entity;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HamburgerMenuController extends Controller
{

    public function si_alerts(Request $request)
    {
        $name = $request->name;
        $end_date = $request->end_date;
        $start_date = $request->start_date;

        if ($request->name && $request->start_date && $request->end_date) {

            $si_alerts = Entity::where('entity_name', 'LIKE', '%'.$name.'%')
                                ->whereDate('created_at','>=',$start_date)
                                ->whereDate('created_at','<=',$end_date)
                                ->get();

        } else if($request->name){

            $si_alerts = Entity::where('entity_name', 'LIKE', '%'.$name.'%')->get();

        } else if($request->start_date) {

            $si_alerts = Entity::whereDate('created_at','>=',$start_date)->get();

        } else if($request->end_date) {

            $si_alerts = Entity::whereDate('created_at','<=',$end_date)->get();

        } else if($request->name && $request->start_date) {

            $si_alerts = Entity::where('entity_name', 'LIKE', '%'.$name.'%')
                        ->whereDate('created_at','>=',$start_date)
                        ->get();

        } else if($request->name && $request->end_date) {

            $si_alerts = Entity::where('entity_name', 'LIKE', '%'.$name.'%')
                        ->whereDate('created_at','<=',$end_date)
                        ->get();

        } else if($request->start_date && $request->end_date) {

            $si_alerts = Entity::whereDate('created_at','>=',$start_date)
                        ->whereDate('created_at','<=',$end_date)
                        ->get();
        } else {
            $si_alerts = Entity::get();
        }
        foreach ($si_alerts as $si) {
            if ($si->entity_contact_id != null) {

                $contact = Contact::where('contact_id', $si->entity_contact_id)->first();
                $si->setAttribute('contact', $contact);
            } else {

            }
        }
        return response()->json($si_alerts);
    }

    public function scans(Request $request)
    {
        $id = $request->id;
        $i=0;
        if ($request->id) {
            $orders = Order::where('order_id', $id)->select('created_at')->groupBy('created_at')->get();
        } else {
            $orders = Order::select('created_at')->groupBy('created_at')->get();
        }
        foreach ($orders as $order) {
            $ord = DB::table('orders')->where('created_at',$order->created_at)->get();
            $order->setAttribute('orders',$ord);
            $count = DB::table('orders')->where('created_at',$order->created_at)->count();
            $order->setAttribute('count',$count);
            $i++;
            $order->setAttribute('i',$i);

        }
        return response()->json($orders);
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
        //
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
