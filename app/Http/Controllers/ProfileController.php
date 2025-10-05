<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use App\Models\VipUserType;
use App\Models\OfficialRole;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
     
    }
    public function profile_details($id=null)
    {
        if ($id == null) {
            $data['user'] = Auth::user();
        }else{
            if (!Auth::user()->can('view_user_list')) {
                return redirect()->route('index');
            }else{
                $data['user'] = User::find($id);
            }
        }

        $data['roles'] = Role::latest()->get();

        $data['official_roles'] = OfficialRole::where('parent_id', 0)->get();
        return view('backend.userprofile.userprofile', $data);
    }
    public function update_user_profile(Request $request){
        $role = '';
        $dept_id = '';
        $dept_name = '';
        $office_role = '';
  
        // emp type: 5 shocibly, 4 vip
        if($request->sochebaloy_dept !== 0 && $request->emp_type !== 0 && $request->official_role !== 0 && $request->vip_user_type !== 0){
            if($request->emp_type == 5){
                $dept_id = $request->sochebaloy_dept;
                $office_role = $request->official_role;
               
                $dept_name = $request->sochebaloy_dept_role;
                $emp_type = 'sochebaloy_official';
                $role = Role::where('slug', 'secretariat_official')->first();
            }else{
                 
                $dept_id = null;
            
                if($request->emp_type == 4){
                    
                    $emp_type = 'vip_official';
                    $role = Role::where('slug', 'vip_official')->first();
                    $office_role = $request->vip_user_type;
                }else{
                    $emp_type = 'general';
                    $role = Role::where('slug', 'general')->first();
                }
            }
    
    
            User::where('id', $request->user_id)->update([
                'emp_type' => $emp_type,
                'office_role' => $office_role?? '',
                'department_id' => $dept_id,
                'dept_role' => $dept_name,
            ]);


            $user = User::find($request->user_id);
            $user->syncRoles([$role->id]);
            
            Session::flash('success', __('messages.Roles') . ' ' . __('messages.update') . ' ' . __('messages.successfully'));
            return redirect('/user-profile/'.$request->user_id);
        }else{
            Session::flash('danger', __('messages.flash-err-msg-must-select'));
            return redirect('/user-profile/'.$request->user_id);
        }
        
    }

    public function get_officals_roles(Request $request){  
        $official_roles = OfficialRole::where('parent_id', $request->id)->get();
    
        return $official_roles;
    }

    public function get_officals_depts(Request $request){
         
        if($request->id == 5){
            $official_roles = Department::where('status', 1)->get();
        }else{
            $official_roles = VipUserType::where('status', 1)->get();
        }
        
        return $official_roles;
    }

    public function get_officals_admin_user(Request $request){
         
        $official_roles = OfficialRole::whereIn('type', ['admin', 'gen_user'])->get();
        
        return $official_roles;
    }


    
}
