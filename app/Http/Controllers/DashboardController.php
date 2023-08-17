<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\Models\Entity;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count_orders()
    {
        $orders = Order::where('order_owner_user_id', Auth::user()->user_id)->where('order_primary_contact_id', '!=', null)->count();
        return response()->json($orders);
    }

    public function my_orders()
    {
        $orders = Order::where('order_owner_user_id', Auth::user()->user_id)->where('order_primary_contact_id', '!=', null)->orderbydesc('created_at')->get();
        foreach ($orders as $order) {
            $contact = DB::table('contacts')->where('contact_id', $order->order_primary_contact_id)->first();
            if ($contact != null) {
                $order->setAttribute('contact', $contact);
                $count = DB::table('entity')->where('work_order_id', $order->order_id)->count();
                $order->setAttribute('count', $count);
            }
        }
        return response()->json($orders);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count_entities()
    {
        $entities = Entity::where('entity_owner_user_id', Auth::user()->user_id)->count();
        return response()->json($entities);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count_users()
    {
        $users = User::count();
        return response()->json($users);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function count_contacts()
    {
        $contacts = Contact::count();
        return response()->json($contacts);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
