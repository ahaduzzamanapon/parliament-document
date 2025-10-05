@extends('Layouts.backend_master')

@section('main-content')

<div class="w-full px-5 lg:ps-8  bg-[#F2F8FF]">
    <p class="font-solaimans text-15 text-black leading-4 py-4">{{ __('messages.Home') }} / {{ __('messages.Users') }} {{ __('messages.list') }} </p>
</div>
<section class="px-10  py-6">
    <div class=" bg-white rounded-md px-4 py-6 shadow">
        
        <div class="lg:flex justify-between items-center bg-white pb-3">
            <h3 class="font-solaimans text-20 leading-5 w-full lg:w-[25%] xl:w-[20%]">{{ __('messages.vip-user-types') }} </h3>
            <div class="w-[80%] md:flex items-center  mt-2 gap-3 lg:mt-0">
                <div class="w-full md:w-[35%] lg:w-[75%] relative flex items-center justify-end">
                    <input id="search-folder"
                        class="w-[4.375em] ps-1 pe-8 py-1 transition-all duration-500 ease-in-out focus:translate-x-0  rounded-lg border focus:outline-none border-[#007A43]"
                        type="text">
                        <svg class="absolute md:right-[3%] lg:top-[18%] lg:right-1" xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 25 25" fill="none">
                        <path d="M15.75 0.666169C14.1605 0.665377 12.6045 1.12379 11.2694 1.98629C9.93418 2.84878 8.87658 4.07863 8.22377 5.52792C7.57095 6.97722 7.35071 8.58424 7.58954 10.1557C7.82837 11.7272 8.51609 13.1963 9.57 14.3862L1.5 23.5462L2.62 24.5462L10.67 15.4262C11.7055 16.2361 12.9195 16.7869 14.2109 17.0327C15.5023 17.2785 16.8338 17.2121 18.0944 16.8391C19.355 16.4662 20.5082 15.7974 21.458 14.8885C22.4078 13.9796 23.1267 12.8569 23.5548 11.614C23.9829 10.371 24.1078 9.04377 23.9191 7.74278C23.7303 6.44178 23.2335 5.20471 22.4699 4.1346C21.7063 3.06449 20.6981 2.19233 19.5292 1.59075C18.3603 0.989179 17.0646 0.675611 15.75 0.676169V0.666169ZM15.75 15.6662C13.9598 15.6662 12.2429 14.955 10.977 13.6891C9.71116 12.4233 9 10.7064 9 8.91617C9 7.12596 9.71116 5.40907 10.977 4.1432C12.2429 2.87733 13.9598 2.16617 15.75 2.16617C17.5402 2.16617 19.2571 2.87733 20.523 4.1432C21.7888 5.40907 22.5 7.12596 22.5 8.91617C22.5 10.7064 21.7888 12.4233 20.523 13.6891C19.2571 14.955 17.5402 15.6662 15.75 15.6662Z" fill="#007A43" />
                    </svg>
                </div>
                  <div class="w-full md:w-[35%] lg:w-[30%]">
                    <a onclick="chckprmitionh_folder3()" class="bg-[#F8B200] mt-2  md:mt-0 w-full  p-2  rounded-md font-solaimans text-white">
                        <i class="fa-solid fa-plus"></i>
                        <span>ভিআইপি ব্যবহারকারী ধরন পরিচালনা</span>
                    </a>
                  </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="table">
              <!-- head -->
              <thead class="bg-[#E9FFE4] w-full">
                <tr>
                    <th><h2 class="text-[#007A43] text-18 font-solaimans font-semibold">ক্রমিক নং </h2></th>
                    <th ><h2 class="text-[#007A43] text-18 font-solaimans font-semibold ">ব্যবহারকারী ধরন নাম </h2></th>
                    <th><h2 class="text-[#007A43] text-18 font-solaimans font-semibold">অবস্থা</h2></th>
                    <th><h2 class="text-[#007A43] text-18 font-solaimans font-semibold">অপশন</h2></th>
                </tr> 
              </thead>
              <tbody id="myTable">
                @php 
                    $i = 1;
                @endphp
              @foreach($vip_users as $dept)
                <tr>
                <td>
                      <span class="text-[#5C5F62] text-15 font-solaimans">
                      {{ $i++ }}
                      </span>
                    </td>
                    <th class="text-[#082303] font-solaimans text-16 flex items-center gap-2">
                    
                      <span class="text-[#082303] font-solaimans text-16 leading-4">
                          {{ $dept->name }}
                      </span>
                    </th>
                    <td>
                      <span class="text-[#5C5F62] text-15 font-solaimans">
                      {{ $dept->status==1? 'Active': 'Deactive' }}
                      </span>
                    </td>
                    <td>
                      <div class="flex items-center  gap-5">
                          <a onclick="updateTypeOrder('{{ $dept->id}}', '{{ $dept->name}}', '{{ $dept->status}}')" class="text-red-500 " href="#"><i class="fa fa-light fa-pencil" style="font-size: 18px;"></i></a>
                          <a onclick="return confirm('Are you sure to delete this item?')" class="text-red-500" href="{{ route('deleteVipUser', $dept->id) }}"><i class="fa fa-light fa-trash-can" style="font-size: 18px;"></i></a>
                      </div>
                             
                    </td>
                  </tr>
            @endforeach
                <!-- row 1 -->
              
                
              </tbody>
            </table>
          </div>

       
    </div>
    </div>
 

        <!-- Open the modal using ID.showModal() method -->
        <dialog id="offic_dept_addId" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box max-w-xs">
                <h3 class="font-bold text-lg font-solaimans">
                নতুন ডকুমেন্ট ধরন তৈরি করুন
                </h3>
                <div class="my-2">
                    <form action="{{ route('storeVipUser') }}" method="POST">
                        @csrf
                         
                        <input type="text" name="name"
                            class="border w-full border-gray-400 py-2 px-2 rounded-lg shadow-lg focus:outline-none"
                            placeholder="Enter department name" required>
                        <div class="text-end mt-3 space-x-2">
                            <button onclick="modalClose(event, 'offic_dept_addId')"
                                class="text-[#007A43] font-solaimans hover:bg-gray-300 rounded-lg px-1 py-1"
                                type="button">{{ __('messages.cancel') }}</button>
                            <button
                                class="text-[#007A43] font-solaimans hover:bg-gray-300 rounded-lg px-1 py-1 transition-shadow"
                                type="submit">{{ __('messages.create') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>

        <!-- Open the modal using ID.showModal() method -->
        <dialog id="ordertype_update_modal" class="modal modal-bottom sm:modal-middle">
            <div class="modal-box max-w-xs">
                <h3 class="font-bold text-lg font-solaimans">
                ডকুমেন্ট ধরন সংশোধন
                </h3>
                <div class="my-2">
                    <form action="{{ route('updateVipUser') }}" method="POST">
                        @csrf
                         <input type="hidden" id="ot_id" name="id">
                        <input type="text" id="ot_name" name="name"
                            class="border w-full border-gray-400 py-2 px-2 rounded-lg shadow-lg focus:outline-none" placeholder="Enter department name" required>

                        <select class="border w-full border-gray-400 py-2 px-2 rounded-lg shadow-lg focus:outline-none mt-3" name="status" id="ot_status">
                        </select>

                        <div class="text-end mt-3 space-x-2">
                            <button onclick="modalClose(event, 'ordertype_update_modal')"
                                class="text-[#007A43] font-solaimans hover:bg-gray-300 rounded-lg px-1 py-1"
                                type="button">{{ __('messages.cancel') }}</button>
                            <button
                                class="text-[#007A43] font-solaimans hover:bg-gray-300 rounded-lg px-1 py-1 transition-shadow"
                                type="submit">সংশোধন</button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>

 
</section>
 
 

@endsection
@section('scripts')
    <script>
        function updateTypeOrder(id, name, status) {
            var ability = {{ Setting::upload_file() }}
         
                if(status == 1){
                    var status = '<option selected value="1">Active</option>'+
                    '<option value="0">Dective</option>';
                }else{
                    var status = '<option value="1">Active</option>'+
                    '<option value="0" selected>Dective</option>';
                }

                ordertype_update_modal.showModal();
                $('#ot_name').val(name)
                $('#ot_status').html(status)
                $('#ot_id').val(id)
               

            
        }
    </script>
@endsection