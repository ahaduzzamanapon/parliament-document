@extends('Layouts.backend_master')

@section('main-content')
<div class="w-full px-5 lg:ps-8  bg-[#F2F8FF]">
    <p class="font-solaimans text-15 text-black leading-4 py-4">{{ __('messages.Home') }} / {{ __('messages.Profile Update') }}</p>
</div>
<section class="px-10  py-6">
    <div class=" bg-white rounded-md p-10 shadow">
        <div class="flex items-center gap-3">
            <h2 class="text-20 font-solaimans">আপলোড ফরম অফিসিয়াল ব্যবহারকারীর জন্য</h2>
            
        </div>
        <form action="{{ route('update_user_profile') }}" method="post">
            @csrf
            

            <div class="w-full flex">
                    <div class="w-[70%] mr-10">
                        <div class="flex mt-3">
                            <h2 class="w-[25%] text-20 font-solaimans">Order/Issue Number</h2>
                            <input type="text" class="w-[75%] border border-[#DFDFDF] py-2 px-3 focus:outline-none" placeholder="Order/Issue Number">
                        </div>
                    </div>
                    <div class="w-[25%]">
                        <div class="flex mt-3">
                            <h2 class="w-[20%] text-20 font-solaimans">Date</h2>
                            
                            <input placeholder="{{ date('m-d-Y')}}"
                                class="textbox-n w-[80%] border border-[#DFDFDF] py-2 px-3 focus:outline-none"
                                type="text"
                                value="{{ date('m-d-Y')}}"
                                onfocus="(this.type='date')"
                                onblur="(this.type='text')"
                                id="date" />
                        </div>
                    </div>
                </div>

            <div class="w-full flex mt-5">
                    <div class="w-[70%] mr-10">
                        <div class="flex mt-3">
                            <h2 class="w-[25%] text-20 font-solaimans">Source Number</h2>
                            <input type="text" class="w-[75%] border border-[#DFDFDF] py-2 px-3 focus:outline-none" placeholder="Source Number">
                        </div>
                    </div>
                    <div class="w-[25%]">
                        <div class="flex mt-3">
                            <h2 class="w-[20%] text-20 font-solaimans">Date</h2>
                            <input type="date" class="w-[80%] border border-[#DFDFDF] py-2 px-3 focus:outline-none" value="{{ date('m-d-Y')}}" >
                        </div>
                    </div>
                </div>

                <div class="flex mt-5">
                        <h2 class="w-[18%] text-20 font-solaimans">Subject</h2>
                        <input type="text" class="w-[81%] border border-[#DFDFDF] py-2 px-3 focus:outline-none" placeholder="Enter Subject">
                </div>

                    <div class="w-full flex mt-5">
                        <div class="w-[40%] mr-10">
                            <div class="flex mt-3">
                                <h2 class="w-[53%] text-20 font-solaimans">Type of Order</h2>
                                <select class="w-[63%] border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]" id="official_roleselect">
                                    <option>Select Order</option>
                                        <option value="">NOC</option>
                                        <option value="">GO</option>
                                        <option value="">Office Order</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-[55%]">
                            <div class="flex mt-3">
                                <h2 class="w-[35%] text-20 font-solaimans">Relavent Person</h2>
                                <input type="text" class="w-[65%] border border-[#DFDFDF] py-2 px-3 focus:outline-none" placeholder="User Name">
                            </div>
                        </div>
                    </div>

                    <div class="w-full flex mt-5">
                        <div class="w-[40%] mr-10">
                            <div class="flex mt-3">
                                <h2 class="w-[53%] text-20 font-solaimans">Sub-type of Order</h2>
                                <select class="w-[63%] border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]" id="official_roleselect">
                                    <option>Select Order</option>
                                        <option value="">Sub NOC</option>
                                        <option value="">Sub GO</option>
                                        <option value="">Sub Office Order</option>
                                </select>
                            </div>
                        </div>
                        <div class="w-[55%]">
                            <div class="flex mt-3">
                                <h2 class="w-[35%] text-20 font-solaimans">Number of Parliament</h2>
                                <select class="w-full border border-[#DFDFDF] !py-2 px-3 focus:outline-none"  name="roleselect[]" id="official_roleselect">
                                    <option>Select Parliament</option>
                                        <option value="">1st Parliament</option>
                                        <option value="">2nd Parliament</option>
                                        <option value="">3rd Parliament</option>
                                        <option value="">4th Parliament</option>
                                        <option value="">5th Parliament</option>
                                        <option value="">6th Parliament</option>
                                        <option value="">7th Parliament</option>
                                        <option value="">8th Parliament</option>
                                        <option value="">9th Parliament</option>
                                        <option value="">10th Parliament</option>
                                        <option value="">11th Parliament</option>
                                        <option value="">12th Parliament</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="w-full mt-5">
                            <div class="flex mt-3">
                            <h2 class="w-[18%] text-20 font-solaimans">ব্যবহারকারীর তথ্য</h2>
                            <input type="file" class="w-[81%] border border-[#DFDFDF] py-2 px-3 focus:outline-none" placeholder="User Name">
                            </div>
                    </div>
                   
                    <div class="mt-3 flex justify-end">
                        <button type="submit" class="bg-[#007A43] py-2 px-4  rounded !border-none text-white font-p-posts" placeholder="User Name">
                            আপলোড
                        </button>
                    </div>
                    
                </div>
            </div>
        </form>
    </div>
</section>

@endsection