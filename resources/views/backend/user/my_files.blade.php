@extends('Layouts.backend_master')

@section('main-content')
<div class="w-full px-5 lg:ps-8 pb-4 bg-[#F2F8FF]">
    <h1 class="text-24 font-solaimans font-medium leading-[1.5em] pt-5">{{ __('messages.Welcome back') }}, <span
            class="text-[#004407] font-solaimans italic font-light leading-none">{{ __('messages.Admin') }}!</span> </h1>
    <p class="font-solaimans text-15 text-black leading-4">{{ __('messages.Dashboard') }}</h1></p>
</div>
     
<div class="w-full py-3  px-5 lg:ps-8 lg:pe-10">
    <div class="py-2 w-full border border-[#E3F0FF] bg-white shadow-md ps-[1.125em] mt-2">
        @if (!empty($vipRecentFolders))
        <div class="mt-3 pe-6" style="min-height: 200px;">
            <h3 class="font-solaimans text-20 leading-5"> {{__('messages.official-personal-files')}}</h3>
            <div class="lg:flex justify-between items-center">
                <div class="w-full my-4 flex flex-wrap items-center gap-4">
                    @if ($vipRecentFolders->count() == 1000)
                    <p> {{__('messages.No Data Found')}}</p>
                    @endif
                    @foreach ($vipRecentFolders as $item)
                    <div class="w-[100%] md:w-[50%] lg:w-[23%]  xl:w-[23.5%] flex flex-wrap items-center  gap-1  xl:gap-3">
                        <div ondblclick="go_folder('{{$item->id}}')"
                            class="folderclick cursor-pointer  w-[95%] bg-[#EBFBEC] py-3 rounded-sm flex items-center justify-between gap-1">
                            <div class="flex items-center ps-3 gap-2 w-full">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none">
                                    <path
                                        d="M2.25 21H18.75L19.47 20.445L23.415 9.945L22.695 9H21V5.25L20.25 4.5H11.565L10.275 3.225L9.75 3H2.25L1.5 3.75V20.25L2.25 21ZM3 4.5H9.435L10.725 5.775L11.25 6H19.5V9H12.75L12.225 9.225L10.935 10.5H5.25L4.545 11.01L3.045 15.63L3 4.5ZM18.195 19.5H3.285L5.79 12H11.25L11.775 11.775L13.065 10.5H21.75L18.195 19.5Z"
                                        fill="black" />
                                </svg>
                                <h3 style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;height: 20px;width: 70%;"
                                    class="text-10 select-none lg:text-13 lx:text-16 font-solaimans leading-4">
                                    {{$item->name}}</h3>
                                <svg data-id="{{$item->id}}" data-name="{{$item->name}}" data-type="folder"
                                    onclick="get_hiden_menu(event, this)" class="file_delete w-[1.125em] cursor-pointer"
                                    xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18"
                                    fill="none">
                                    <path
                                        d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z"
                                        fill="black" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>



    <div class="py-2 w-full border border-[#E3F0FF] bg-white shadow-md ps-[1.125em] mt-5">
        @if (!empty($sharedFiles))
        <div class="mt-3 pe-6" style="min-height: 200px;">
            <h3 class="font-solaimans text-20 leading-5">শেয়ারকৃত সকল ফাইলস</h3>
            <div class="lg:flex justify-between items-center">
                <div class="w-full my-4 flex flex-wrap items-center gap-4">
                    @if ($sharedFiles->count() == 1000)
                    <p> {{__('messages.No Data Found')}}</p>
                    @endif
                    @foreach ($sharedFiles as $file_item)
                 
                    <section draggable="true" data-id="{{ $file_item->id }}" data-name="{{ $file_item->title }}" data-type="file"  class="drag_box w-[43%] lg:w-[21.2%] xl:w-[17%] px-3 pt-3 bg-[#F4F4F4] rounded-md border border-[#cfcfcf] file_link" ondblclick="displayFileContents('{{ $file_item->id }}');">
                    <div class="w-full bg-white rounded-md flex items-center justify-center">
                    <div class="relative px-2 py-1 md:px-4 md:py-2 lg:px-11 lg:py-8 remove-doc w-full">
                        <img class="w-full" src="https://img.icons8.com/color/96/{{ $file_item->filetype}}" alt="{{ $file_item->filetype }}"/>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-3 pb-4">
                            <h1 class="text-12 xl:text-14 font-solaimans leading-5 cursor-pointer w-[83%]" title='{{ $file_item->title }}' style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $file_item->title }}</h1>
                        <svg data-id="{{ $file_item->id }}" data-name="{{ $file_item->title }}" data-type="file" onclick="get_hiden_menu(event, this)" class="file_delete cursor-pointer w-[15%] h-[1.125]" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 18 18" fill="none">
                                <path d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z" fill="black"/>
                        </svg>
                    </div>
                </section>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    </div>

</div>

 
@endsection


@section('scripts')


    <script>
        function go_folder(id) {
            localStorage.setItem("myVariable", id);
            window.location.href = '/files';
        }
    </script>

@endsection