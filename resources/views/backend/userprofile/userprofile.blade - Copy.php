@extends('Layouts.backend_master')

@section('main-content')
<div class="w-full px-5 lg:ps-8  bg-[#F2F8FF]">
    <p class="font-solaimans text-15 text-black leading-4 py-4">{{ __('messages.Home') }} / {{ __('messages.Profile Update') }}</p>
</div>
<section class="px-10  py-6">
    <div class=" bg-white rounded-md px-4 py-6 shadow">
        <div class="flex items-center gap-3">
            <h2 class="text-20 font-solaimans">ব্যবহারকারীর তথ্য</h2>
        </div>
        <form action="{{ route('update_user_profile') }}" method="post">
            @csrf
            <input type="hidden" name="user_id" value="{{$user['id']}}">
            <div class="w-full flex gap-4 py-2">

                <div class="w-[18%]">
                    <figure class="relative">
                        <img src="{{ asset('uploads/prp-users/' . $user['photo']) }}" alt="">
                    </figure>
                </div>
                <div class="w-[82%]">
                    <div>
                        <p class="plabel">Name (English)</p>
                        <input type="text" class="w-full border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ $user['nameEn'] }}" placeholder="User Name" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="plabel">Name (বাংলা)</p>
                        <input type="text" class="w-full border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ $user['nameBn'] }}" placeholder="User Name" readonly>
                    </div>
                 
                    <div class="mt-3">
                        <p class="plabel">Username</p>
                        <input type="text" class="w-full border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ $user['username'] }}" placeholder="User Name" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="plabel">Email</p>
                        <input type="text" class="w-full border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ $user['email'] }}" placeholder="User Name" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="plabel">Phone</p>
                        <input type="text" class="w-full border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ $user['phone'] }}" placeholder="User Name" readonly>
                    </div>
                    <div class="mt-3">
                        <p class="plabel">Designation</p>
                        <input type="text" class="w-full border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ getOfficeUser($user->id) }}" readonly>
                    </div>


                    @if(Auth::user()->emp_type == 'superadmin' || Auth::user()->emp_type == 'admin')
                    <!-- অফিসিয়াল রোল সংশোধন -->
                    <div class="flex items-center gap-3">
                        <h2 class="text-20 font-solaimans roleupdate">অফিসিয়াল রোল সংশোধন</h2>
                    </div>

                    <div class="mt-3">
                        <select class="w-full border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]" id="official_roleselect">
                            <option value="">Select Role</option>
                            @foreach($official_roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mt-3" id="official_select_html2" style="display: none;">
                        <select id="official_roleselect2" class="w-full border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]">
                         
                        </select>
                    </div>
                    
                    <div class="mt-3" id="official_select_html3" style="display: none;">
                        <select id="official_roleselect3" class="w-full border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]">
                         
                        </select>
                    </div>

                    <div class="mt-3" id="official_select_html32" style="display: none;">
                        <select id="official_roleselect32" class="w-full border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]">
                         
                        </select>
                    </div>
                    
                    <div class="mt-3" id="official_select_html4" style="display: none;">
                        <select id="official_roleselect4" class="w-full border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]">
                         
                        </select>
                    </div>
                    <!-- অফিসিয়াল রোল সংশোধন -->
                    @endif
                     
                    @if(Auth::user()->can('add_role'))
                        <div class="mt-3 flex justify-end">
                            <button type="submit" class="bg-[#007A43] py-2 px-4  rounded !border-none text-white font-p-posts" placeholder="User Name">
                                {{ __('messages.update') }}
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

@endsection


<!-- 
public function update_user_profile(Request $request){
        $role = '';
        $dept_id = '';
        $dept_name = '';
        $office_role = '';
 
         dd($request->roleselect);
        // dd(!in_array('0', $request->roleselect), !in_array('', $request->roleselect));
        if(!in_array('0', $request->roleselect) && !in_array('', $request->roleselect)){
            if(count($request->roleselect) == 4){
                $dept_id = $request->roleselect[2];
                $office_role = $request->roleselect[3];
                $dept_name = OfficialRole::where('id', $office_role)->first()->type;
                $emp_type = 'sochebaloy_official';
                $role = Role::where('slug', 'secretariat_official')->first();
            }else{
                $arrkey = array_key_last($request->roleselect);
                $dept_id = null;
            
                if(count($request->roleselect) == 2){
                    
                    $emp_type = 'vip_official';
                    $role = Role::where('slug', 'vip_official')->first();
                    $office_role = $request->roleselect[3];
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
        
    } -->