<?php 

use App\Models\OfficialRole;
use App\Models\User;
use App\Models\Department;


function getOfficeUser($uid){
    $user = User::find($uid);
    // $user = Auth::user();
    // $emp_type = OfficialRole::where('id', $user->office_role)->first()->type ?? '';
 
    if($user->emp_type == 'superadmin'){
        return 'সুপার এডমিন';
    }else if($user->emp_type == 'general'){
        $user_office = 'সাধারণ';
    }else{
        $user_office = 'অফিসিয়াল';
    }

    if($user->dept_role == 'admin'){
        $dept_role = 'এডমিন';
    }else{
        $dept_role = 'সাধারণ ব্যবহারকারী';
    }
    $fullofficerole = '';
    if($user->department != ''){
        $fullofficerole = $user_office.', '.' সচিবালয় অফিসিয়াল, '.$user->department->name.', '.$dept_role;
    }else{ 
        if(isset($user->vipUserType->name) && $user->emp_type == 'vip_official'){
            $name = $user->vipUserType->name;
        }else{
            $name = '';
        }
       
        if($user->emp_type == 'general'){
            $fullofficerole = 'সাধারণ ব্যবহারকারী';
        }else if($user->emp_type == 'vip_official'){ 
            $fullofficerole = $user_office.', '.'ভিআইপি অফিসিয়াল, '.$name;
        }
    }
 
    return $fullofficerole;
}

function checkRole($uid){
    $user = User::where(['id' => $uid, 'emp_type' => 'sochebaloy_official'])->first();

    if($user != null){
        if($user->dept_role == 'admin'){
            $dept_role = 'admin';
        }else{
            $dept_role = 'gen_user';
        }
        return  $dept_role;
    }
    return '';
}
 
 
 


