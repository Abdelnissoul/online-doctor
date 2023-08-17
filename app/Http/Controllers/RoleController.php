<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hamburger()
    {
        $hamburger = Role::where('role_type', 'Hamburger Menu')->get();
        return response()->json($hamburger);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $reports = Role::where('role_type', 'Reports access')->get();
        return response()->json($reports);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rolesSelect($id)
    {
        $role = UserRole::where('user_id', $id)->select('role_id')->pluck('role_id');
        $roles = Role::whereIn('role_id', $role)->where('role_type', 'Hamburger Menu')->get();
        return response()->json($roles);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function rolesNotSelect($id)
    {
        $role = UserRole::where('user_id', $id)->select('role_id')->pluck('role_id');
        $roles = Role::whereNotIn('role_id', $role)->where('role_type', 'Hamburger Menu')->get();
        return response()->json($roles);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportsSelect($id)
    {
        $role = UserRole::where('user_id', $id)->select('role_id')->pluck('role_id');
        $roles = Role::whereIn('role_id', $role)->where('role_type', 'Reports access')->get();
        return response()->json($roles);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function reportsNotSelect($id)
    {
        $role = UserRole::where('user_id', $id)->select('role_id')->pluck('role_id');
        $roles = Role::whereNotIn('role_id', $role)->where('role_type', 'Reports access')->get();
        return response()->json($roles);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function my_reports()
    {
        $role = UserRole::where('user_id', Auth::user()->user_id)->select('role_id')->pluck('role_id');
        $roles = Role::whereIn('role_id', $role)->where('role_type', 'Reports access')->get();
        return response()->json($roles);
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
