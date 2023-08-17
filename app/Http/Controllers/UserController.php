<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserRole;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function getAuthUser()
    {
        $user = User::find(Auth::user()->user_id);
        return response()->json($user);
    }

    public function edit_profile($id, Request $request)
    {
        $user = User::find($id);
        $user->user_fname = $request->user_fname;
        $user->user_lname = $request->user_lname;
        $user->user_title = $request->user_title;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);

        } else {

        }
        $user->user_address_1 = $request->user_address_1;
        $user->user_address_2 = $request->user_address_2;
        $user->save();
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users()
    {
        return view('hamburger_menu.users');
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
        $user = new User();
        $user->user_fname = $request->user_fname;
        $user->user_lname = $request->user_lname;
        $user->email = $request->email;
        $user->user_roles = $request->user_roles;
        $user->user_developer = $request->user_developer;

        $user->password = Hash::make($request->password);
        $user->save();
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
        $user = User::find($id);
        return response()->json($user);
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
        // $user = User::where('user_id', $id)->update([
        //     'user_fname' => $request->user_fname,
        // ]);

        $user = User::find($id);
        $user->user_fname = $request->user_fname;
        $user->user_lname = $request->user_lname;
        $user->email = $request->email;
        $user->user_roles = $request->user_roles;
        $user->user_signature_message = $request->user_signature_message;
        $user->user_title = $request->user_title;
        $user->user_address_2 = $request->user_address_2;
        $user->user_address_1 = $request->user_address_1;
        $user->user_hire_date = $request->user_hire_date;
        $user->user_time_zone = $request->user_time_zone;
        $user->user_print_sos_checks = $request->user_print_sos_checks;
        $user->user_out_of_office_forward_user_id = $request->user_out_of_office_forward_user_id;
        if ($request->password != null) {
            $user->password = Hash::make($request->password);

        } else {

        }

        if (!isset($request->user_accountant)) {
            if ($user->user_accountant == null) {
                $user->user_accountant = "false";
            } else {
                $user->user_accountant = $user->user_accountant;
            }
        } else {
            if ($request->user_accountant == true) {
                $user->user_accountant = "true";
            } else if ($request->user_accountant == false) {
                $user->user_accountant = "false";
            } else {

            }
        }

        if (!isset($request->user_salary)) {
            if ($user->user_salary == null) {
                $user->user_salary = "false";
            } else {
                $user->user_salary = $user->user_salary;
            }
        } else {
            if ($request->user_salary == true) {
                $user->user_salary = "true";
            } else if ($request->user_salary == false) {
                $user->user_salary = "false";
            } else {

            }
        }

        if (!isset($request->user_global_search)) {
            if ($user->user_global_search == null) {
                $user->user_global_search = "false";
            } else {
                $user->user_global_search = $user->user_global_search;
            }
        } else {
            if ($request->user_global_search == true) {
                $user->user_global_search = "true";
            } else if ($request->user_global_search == false) {
                $user->user_global_search = "false";
            } else {

            }
        }
        if ($request->hasFile('image')) {
            $name = time() . '.' . explode('/', explode(':', substr($request->image, 0, strpos($request->image, ';')))[1])[1];
            $file = $request->file('image');
            // $file->save(public_path('test'), $name);
            // $file->move(public_path('images'), $name);
            $user->user_signature_image = "images/signatures/" . $name;
            Image::make($request->image)->save(public_path('images/signatures/') . $name);
        }
        DB::table('users_roles')->where('user_id', $user->user_id)->delete();
        foreach ($request->hamburger_selected as $r) {
            $role = new UserRole();
            $role->user_id = $user->user_id;
            $role->role_id = $r;
            $role->save();
        }

        foreach ($request->hamburger_selectedd as $r) {
            $role = new UserRole();
            $role->user_id = $user->user_id;
            $role->role_id = $r;
            $role->save();
        }

        foreach ($request->report_selected as $r) {
            $role = new UserRole();
            $role->user_id = $user->user_id;
            $role->role_id = $r;
            $role->save();
        }

        foreach ($request->report_selectedd as $r) {
            $role = new UserRole();
            $role->user_id = $user->user_id;
            $role->role_id = $r;
            $role->save();
        }

        $user->save();

        // try{
        //     if($request->hasFile('img')){
        //         $file = $request->file('img');
        //         $file_name = time() . '.' . $file->getClientOriginalName();
        //         $file->move(public_path('test'), $file_name);
        //         return response()->json([
        //             'message' => 'File uploaded successful'
        //         ], 200);
        //     }

        // }catch(\Exception $e){
        //     return response()->json([
        //         'message' => $e->getMessage()
        //     ]);
        // }

        return $this->refresh();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('img')) {
                $file = $request->file('img');
                $file_name = time() . '.' . $file->getClientOriginalName();
                $file->move(public_path('test'), $file_name);
                return response()->json([
                    'message' => 'File uploaded successful',
                ], 200);
            }

        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('users')->where('user_id', $id)->delete();
        // return redirect()->route('users.index');
        return $this->refresh();
    }

    private function refresh()
    {
        $users = User::orderbydesc('created_at')->get();
        // $users = User::all();
        return response()->json($users);
    }
}
