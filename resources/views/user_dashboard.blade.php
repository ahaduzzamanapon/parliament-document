@extends('Layouts.backend_master')
@section('main-content')
<style>
.drop-zone {
    max-width: 100%;
    height: 200px;
    padding: 25px;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-family: "Quicksand", sans-serif;
    font-weight: 500;
    font-size: 20px;
    cursor: pointer;
    color: #cccccc;
    border: 3px dashed #009578;
    border-radius: 10px;
    flex-direction: column;
}

.drop-zone--over {
    border-style: solid;
}

.drop-zone__input {
    display: none;
}

.drop-zone__thumb {
    width: 25%;
    height: 80%;
    border-radius: 10px;
    overflow: hidden;
    background-color: #cccccc;
    background-size: cover;
    position: relative;
}

.drop-zone__thumb::after {
    content: attr(data-label);
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 5px 0;
    color: #ffffff;
    background: rgba(0, 0, 0, 0.75);
    font-size: 14px;
    text-align: center;
}
</style>
<div class="w-full px-5 lg:ps-8 pb-4 bg-[#F2F8FF]">
    <h1 class="text-24 font-solaimans font-medium leading-[1.5em] pt-5">{{ __('messages.Welcome back') }}, <span
            class="text-[#004407] font-solaimans italic font-light leading-none">{{ __('messages.Current_Language')=='bn'? Auth::user()->nameBn : Auth::user()->nameEn }}!</span> </h1>
    <p class="font-solaimans text-15 text-black leading-4">{{ __('messages.Dashboard') }}</p>
</div>
<div class="w-full px-5 lg:ps-8 lg:pe-10 flex flex-col lg:flex-row items-center gap-4">
    <div class="w-full h-auto lg:w-[33%] xl:h-[9.375em]  border border-[#E3F0FF] bg-white shadow-md rounded-md">
        <div
            class="flex w-full h-full justify-between items-center lg:place-items-start lg:gap-[1.875em] xl:gap-[3.75em] p-5">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-3">
                    <h2 class="font-solaimans text-16 lg:text-18 xl:text-20 font-normal leading-5">{{ __('messages.Total Folder') }}
                    </h2>
                    <h1 class="font-solaimans text-20 lg:text-24 xl:text-28 font-semibold text-[#007A43] leading-8">
                        {{$totalFolders}}
                    </h1>
                </div>
            </div>
            <div class="w-[21%] p-2  border border-[#DDECFF] bg-[#E5F1FF] rounded-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="39" viewBox="0 0 38 39" fill="none">
                    <path
                        d="M37.7819 21.9438L33.0039 30.3501C32.6321 31.0043 32.0997 31.5471 31.4598 31.9243C30.8199 32.3015 30.0949 32.5 29.3569 32.5H2.9704C1.7484 32.5 0.98701 31.1395 1.60273 30.0562L6.3807 21.6499C6.75254 20.9957 7.28494 20.4529 7.92485 20.0757C8.56476 19.6985 9.28983 19.5 10.0278 19.5H36.4143C37.6363 19.5 38.3977 20.8605 37.7819 21.9438ZM10.0278 17.3333H31.6667V14.0833C31.6667 12.2884 30.2489 10.8333 28.5 10.8333H17.9444L13.7222 6.5H3.16667C1.41774 6.5 0 7.95505 0 9.75V28.576L4.55716 20.5581C5.68773 18.569 7.784 17.3333 10.0278 17.3333Z"
                        fill="#007A43" />
                </svg>
            </div>
        </div>
    </div>
    <div class="w-full h-auto lg:w-[33%] xl:h-[9.375em]  border border-[#E3F0FF] bg-white shadow-md rounded-md">
        <div
            class="flex w-full h-full justify-between items-center lg:place-items-start lg:gap-[1.875em] xl:gap-[3.75em] p-5">
            <div class="flex flex-col gap-2">
                <div class="flex flex-col gap-3">
                    <h2 class="font-solaimans text-16 lg:text-18 xl:text-20 font-normal leading-5">{{ __('messages.Total Upload Files') }}</h2>
                    <h1 class="font-solaimans text-20 lg:text-24 xl:text-28 font-semibold text-[#007A43] leading-8">
                        {{$totalFiles}}
                    </h1>
                </div>
            </div>
            <div class="w-[21%] p-2 border border-[#DDECFF] bg-[#E5F1FF] rounded-md flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="38" height="39" viewBox="0 0 38 39" fill="none">
                    <path
                        d="M21.375 10.3594V0H6.53125C5.54414 0 4.75 0.815039 4.75 1.82812V37.1719C4.75 38.185 5.54414 39 6.53125 39H31.4688C32.4559 39 33.25 38.185 33.25 37.1719V12.1875H23.1562C22.1766 12.1875 21.375 11.3648 21.375 10.3594ZM26.125 28.3359C26.125 28.8387 25.7242 29.25 25.2344 29.25H12.7656C12.2758 29.25 11.875 28.8387 11.875 28.3359V27.7266C11.875 27.2238 12.2758 26.8125 12.7656 26.8125H25.2344C25.7242 26.8125 26.125 27.2238 26.125 27.7266V28.3359ZM26.125 23.4609C26.125 23.9637 25.7242 24.375 25.2344 24.375H12.7656C12.2758 24.375 11.875 23.9637 11.875 23.4609V22.8516C11.875 22.3488 12.2758 21.9375 12.7656 21.9375H25.2344C25.7242 21.9375 26.125 22.3488 26.125 22.8516V23.4609ZM26.125 17.9766V18.5859C26.125 19.0887 25.7242 19.5 25.2344 19.5H12.7656C12.2758 19.5 11.875 19.0887 11.875 18.5859V17.9766C11.875 17.4738 12.2758 17.0625 12.7656 17.0625H25.2344C25.7242 17.0625 26.125 17.4738 26.125 17.9766ZM33.25 9.28535V9.75H23.75V0H24.2027C24.6777 0 25.1305 0.19043 25.4645 0.533203L32.7305 7.99805C33.0645 8.34082 33.25 8.80547 33.25 9.28535Z"
                        fill="#007A43" />
                </svg>
            </div>
        </div>
    </div>

</div>

<!-- {{-- Your Remainder File & Folder section --}}

<div class="w-full py-3 px-5 lg:ps-8 lg:pe-10">
    <div class="py-2 w-full border border-[#E3F0FF] bg-white shadow-md ps-[1.125em]">


        <div class="mt-3 pe-6">
            <h3 class="font-solaimans text-20 leading-5">Your Remainder File & Folder </h3>
            <div class="lg:flex justify-between items-center">
                <div class="w-full my-4 flex flex-wrap items-center gap-4">


                    <div class="w-[100%] md:w-[50%] lg:w-[23%]  xl:w-[23.5%] flex flex-wrap items-center  gap-1  xl:gap-3"
                        id="fetch_folder_data">
                        <div
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
                                    Folder name</h3>
                                <svg  data-type="folder"
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
                    <div class="w-[100%] md:w-[50%] lg:w-[23%]  xl:w-[23.5%] flex flex-wrap items-center  gap-1  xl:gap-3"
                        id="fetch_folder_data">
                        <div
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
                                    Folder name</h3>
                                <svg  data-type="folder"
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
                    <div class="w-[100%] md:w-[50%] lg:w-[23%]  xl:w-[23.5%] flex flex-wrap items-center  gap-1  xl:gap-3"
                        id="fetch_folder_data">
                        <div
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
                                    Folder name </h3>
                                <svg data-type="folder"
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
                    <div class="w-[100%] md:w-[50%] lg:w-[23%]  xl:w-[23.5%] flex flex-wrap items-center  gap-1  xl:gap-3"
                        id="fetch_folder_data">
                        <div
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
                                    Folder name</h3>
                                <svg  data-type="folder"
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

                </div>

            </div>
            <div class="w-full  mt-3  pe-3 flex flex-wrap justify-center lg:justify-start items-center gap-5 lg:gap-9">
                @if ($totalFiles==0)
                <div class="w-full" id="noData">
                    <div class="drop-zone">
                        <div>
                            <form id="file_upload" enctype="multipart/form-data">
                                @csrf
                                <span class="drop-zone__prompt">Drop your files here or browse for files</span>
                                <input type="file" id="fileInput" name="myFile" class="drop-zone__input" />
                                <input type="hidden" name="category_id" id="category_id_file" value="">
                            </form>
                        </div>
                    </div>
                </div>
                @else
                <div class="w-full hidden" id="">
                    <div class="drop-zone">
                        <div>
                            <form id="file_upload" enctype="multipart/form-data">
                                @csrf
                                <span class="drop-zone__prompt">Drop your files here or browse for files</span>
                                <input type="file" id="fileInput" name="myFile" class="drop-zone__input" />
                                <input type="hidden" name="category_id" id="category_id_file" value="">
                            </form>
                        </div>
                    </div>
                </div>
                @endif
                @foreach ($fileData as $file_item)
                <?php
                    $type = $file_item->filetype;
                    if ($type == 'mp4') {
                        $type = 'video';
                    } elseif ($type == 'gz') {
                        $type = 'zip';
                    } elseif ($type == 'jpeg') {
                        $type = 'image';
                    } elseif ($type == "java") {
                        $type = "java-coffee-cup-logo";
                    } elseif ($type == "pub") {
                        $type = "ms-publisher";
                    } elseif ($type == "docx") {
                        $type = "ms-word";
                    } elseif ($type == "accdb") {
                        $type = "ms-word";
                    } elseif ($type == "pptx") {
                        $type = "powerpoint";
                    }elseif ($type == "xlsx") {
                        $type = "ms-excel";
                    }
                ?>
                <div class="w-[43%] lg:w-[21.2%] xl:w-[17%] px-3 pt-3 bg-[#F4F4F4] rounded-md border border-[#cfcfcf] file_link"
                    ondblclick="preview_modal.showModal(); displayFileContents('{{$file_item->file_path}}');">
                    <div class="w-full bg-white rounded-md flex items-center justify-center">
                        <div class="px-2 py-1 md:px-4 md:py-2 lg:px-11 lg:py-8 remove-doc w-full">
                            <img class="w-full" src="https://img.icons8.com/color/96/{{$type}}.png" alt="{{$type}}" />
                        </div>
                    </div>
                    <div class="flex justify-between items-center pt-3 pb-4">
                        <h1 class="text-12 xl:text-14 font-solaimans leading-5 cursor-pointer w-[83%]"
                            title='{{$file_item->title}}'
                            style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$file_item->title}}
                        </h1>
                        <svg data-id="{{$file_item->id}}" data-name='{{$file_item->title}}' data-type="file"
                            onclick='get_hiden_menu(event, this)' class="file_delete cursor-pointer w-[15%] h-[1.125]"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                            <path
                                d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z"
                                fill="black" />
                        </svg>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
{{-- Your Remainder File & Folder section end--}} -->

<div class="w-full py-3  px-5 lg:ps-8 lg:pe-10">
    <div class="py-2 w-full border border-[#E3F0FF] bg-white shadow-md ps-[1.125em]">


        <div class="mt-3 pe-6">
            <h3 class="font-solaimans text-20 leading-5"> {{__('messages.general Folders')}} </h3>
            <div class="lg:flex justify-between items-center">
                <div class="w-full my-4 flex flex-wrap items-center gap-4">
                    @if (empty($genRecentFolders))
                    <p>{{__('messages.No Folder Found')}}</p>
                    @endif
                    @foreach ($genRecentFolders as $item)
                    <div class="w-[100%] md:w-[50%] lg:w-[23%]  xl:w-[23.5%] flex flex-wrap items-center  gap-1  xl:gap-3"
                        >
                        <div ondblclick="go_folder('{{ $item->id }}')"
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
    </div>

</div>


{{-- document section --}}
  <!-- <div class=" w-full py-3 px-5 lg:ps-8 lg:pe-10">
    <div class="py-2 w-full border border-[#E3F0FF] bg-white shadow-md ps-[1.125em]">

 

       <div class="pt-6">
            <h1 class="font-solaimans text-20 font-normal leading-5">{{__('messages.Uploaded Files')}}</h1>
        </div>
        <div class="w-full  mt-3  pe-3 flex flex-wrap justify-center lg:justify-start items-center gap-5 lg:gap-9">
            @if ($totalFiles==0)
            @if($user->can('file_upload'))
            <div class="w-full" id="noData">
                <div class="drop-zone">
                    <div>
                        <form id="file_upload" enctype="multipart/form-data">
                            @csrf
                            <span class="drop-zone__prompt">Drop your files here or browse for files</span>
                            <input type="file" id="fileInput" name="myFile" class="drop-zone__input" multiple/>
                            <input type="hidden" name="category_id" id="category_id_file" value="0">
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @else
            <div class="w-full hidden" id="">
                <div class="drop-zone">
                    <div>
                        <form id="file_upload" enctype="multipart/form-data">
                            @csrf
                            <span class="drop-zone__prompt">Drop your files here or browse for files</span>
                            <input type="file" id="fileInput" name="myFile" class="drop-zone__input" multiple />
                            <input type="hidden" name="category_id" id="category_id_file" value="">
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @foreach ($fileData as $file_item)
            <?php
                $type = $file_item->filetype;
                if ($type == 'mp4') {
                    $type = 'video';
                } elseif ($type == 'gz') {
                    $type = 'zip';
                } elseif ($type == 'jpeg') {
                    $type = 'image';
                } elseif ($type == "java") {
                    $type = "java-coffee-cup-logo";
                } elseif ($type == "pub") {
                    $type = "ms-publisher";
                } elseif ($type == "docx") {
                    $type = "ms-word";
                } elseif ($type == "accdb") {
                    $type = "ms-word";
                } elseif ($type == "pptx") {
                    $type = "powerpoint";
                }
                ?>
            <div class="w-[43%] lg:w-[21.2%] xl:w-[17%] px-3 pt-3 bg-[#F4F4F4] rounded-md border border-[#cfcfcf] file_link"
                ondblclick="preview_modal.showModal(); displayFileContents('{{$file_item->id}}');">
                <div class="w-full bg-white rounded-md flex items-center justify-center">
                    <div class="px-2 py-1 md:px-4 md:py-2 lg:px-11 lg:py-8 remove-doc w-full">
                        <img class="w-full" src="https://img.icons8.com/color/96/{{$type}}.png" alt="{{$type}}" />
                    </div>
                </div>
                <div class="flex justify-between items-center pt-3 pb-4">
                    <h1 class="text-12 xl:text-14 font-solaimans leading-5 cursor-pointer w-[83%]"
                        title='{{$file_item->title}}'
                        style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{$file_item->title}}
                    </h1>
                    <svg data-id="{{$file_item->id}}" data-name='{{$file_item->title}}' data-type="file"
                        onclick='get_hiden_menu(event, this)' class="file_delete cursor-pointer w-[15%] h-[1.125]"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 18" fill="none">
                        <path
                            d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z"
                            fill="black" />
                    </svg>
                </div>
            </div>
            @endforeach
        </div> 
    </div>-->
    {{-- chart section --}}
    {{-- <section class="container lg:flex w-full lg:gap-3  py-3">
        <div class="w-full lg:w-[55%] xl:w-[60%] ">
            <div class="w-full h-full">
                <div class="border border-[#E3F0FF] w-full bg-white shadow-md">
                    <h1 class="font-solaimans text-15 lg:text-20 leading-3 lg:leading-5 mt-3 mx-4">This Month Upload Files
                        <span class="text-[#007A43] text-20 leading-5 font-semibold">456 GB</span>
                    </h1>
                    <div class="w-full h-auto lg:h-[16.875em]">
                        <canvas id="myChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-full mt-5 lg:mt-0 lg:w-[45%] xl:w-[40%] py-2 border border-[#E3F0FF] bg-white shadow-md rounded-md">
            <div class="ps-4 flex items-center gap-[0.625em]">
                <h1 class="text-15 lg:text-20 font-solaimans leading-5">This Month New User</h1>
                <span class="font-solaimans text-15 lg:text-20 font-semibold text-[#007A43] leading-5">45</span>
            </div>
            <div class="py-2 w-full">
                <table class="w-full">
                    <thead class="bg-[#EDEEF6]  font-solaimans  text-10 lg:text-12 leading-3">
                        <tr>
                            <td class="ps-5 py-3">
                                name
                            </td>
                            <td class=" py-3">
                                Position
                            </td>
                            <td class=" py-3">
                                Join Date
                            </td>
                            <td class="lg:pe-4 lg:py-3">
                                Profile
                            </td>
                        </tr>

                    </thead>
                    <tbody class="py-2">
                        <tr class="shadow-md">
                            <td class="font-solaimans text-10 lg:text-13 leading-4 px-2 lg:px-3 py-5">David John</td>
                            <td><span
                                    class="font-solaimans text-10 lg:text-12 xl:text-14  leading-3 text-white bg-[#007A43] rounded-2xl px-2">General
                                    User</span></td>
                            <td class="font-solaimans text-10 lg:text-12 xl:text-14  font-semibold text-[#333333] leading-3">
                                30 March 2023
                                <p class="font-solaimans  text-10 lg:text-12 xl:text-14   text-[#333333] leading-3">8:15 AM</p>
                            </td>
                            <td class="pe-3"><a href=""
                                    class="font-solaimans text-10 lg:text-12 xl:text-14  font-semibold text-[#007A43] leading-3 text-center">View</a>
                            </td>
                        <tr>
                        <tr class="shadow-md">
                            <td class="font-solaimans text-10 lg:text-13 leading-4 px-2 lg:px-3 py-5">David John</td>
                            <td><span
                                    class="font-solaimans  text-10 lg:text-12 xl:text-14  leading-3 text-white bg-[#007A43] rounded-2xl px-2">General
                                    User</span></td>
                            <td class="font-solaimans  text-10 lg:text-11 font-semibold text-[#333333] leading-3">
                                30 March 2023
                                <p class="font-solaimans  text-10 lg:text-12 xl:text-14   text-[#333333] leading-3">8:15 AM</p>
                            </td>
                            <td class="pe-3"><a href=""
                                    class="font-solaimans  text-10 lg:text-12 xl:text-14 font-semibold text-[#007A43] leading-3 text-center">View</a>
                            </td>
                        <tr>
                        <tr class="shadow-md">
                            <td class="font-solaimans text-10 lg:text-13 leading-4 px-2 lg:px-3 py-5">David John</td>
                            <td><span
                                    class="font-solaimans  text-10 lg:text-12 xl:text-14   leading-3 text-white bg-[#007A43] rounded-2xl px-2">General
                                    User</span></td>
                            <td class="font-solaimans  text-10 lg:text-14 font-semibold text-[#333333] leading-3">
                                30 March 2023
                                <p class="font-solaimans  text-10 lg:text-12 xl:text-14   text-[#333333] leading-3">8:15 AM</p>
                            </td>
                            <td class="pe-3"><a href=""
                                    class="font-solaimans  text-10 lg:text-12 xl:text-14  font-semibold text-[#007A43] leading-3 text-center">View</a>
                            </td>
                        <tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section> --}}

    {{-- end part section --}}

    {{-- <section class="w-full h-auto pb-6">
        <div class="border border-[#E3F0FF] bg-white shadow rounded-md lg:flex">
            <div class="w-full lg:w-[27%] py-5 ps-5 pe-5">
                <div class="flex flex-col gap-1 lg:gap-4">
                    <h1 class="text-20 lg:text-24 xl:text-32 font-solaimans text-[#000000] leading-10">Storage Space
                        Managment
                    </h1>
                    <p class="text-28  lg:text-30 xl:text-40 font-solaimans font-semibold leading-10 text-[#007A43]">
                        {{$totalUsedSpace}}
    </p>
</div>
<div class="w-full h-[2.188em] mt-8 mb-12 bg-[#EFEFEF] rounded-md">
    <div class="w-full  h-full flex">
        @foreach ($filetypeTotals as $key=>$extension)
        <div class="w-[{{$extension['percentage']}}%] h-full bg-[{{ $extension['color'] }}]"
            title="{{$key}}-{{$extension['size']}}">
        </div>
        @endforeach
    </div>
</div>
</div>
<div class="w-full lg:w-[73%] py-5">
    <div class="px-4 flex flex-wrap justify-center lg:justify-start items-center gap-[2em]">
        @foreach ($filetypeTotals as $key=>$data)
        <?php
            if ($key == 'mp4') {
                $key = 'video';
            }
            ?>
        <div class="w-[40%] lg:w-[20.3%] xl:w-[16.8%] border border-[#F3F9FF] bg-[#F3F9FF] rounded-md">
            <div>
                <div class="flex justify-center p-4 items-center">
                    <img src="https://img.icons8.com/color/96/{{$key}}.png" alt="{{$key}}" />
                </div>
                <div class="p-2 text-center">
                    <h1 class="font-solaimans text-[{{$data['color']}}] font-semibold text-14 leading-3">
                        {{$key}}</h1>
                    <p class="text-16 font-solaimans leading-4 mt-2">{{$data['size']}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
</div>
</section>
  
    <div id="open-file-section" class="absolute w-[12.5em] h-auto bg-white rounded-sm shadow-md hidden">
        <div class="w-full space-y-2 py-2 ">
            @if (Auth::user()->can('reminder_with_user'))

            <div  class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M15.1954 13.8645C16.2714 12.4937 16.8623 10.8047 16.8755 9.06203C16.8887 7.31938 16.3236 5.62157 15.2685 4.23454C14.4901 3.21051 13.4728 2.39274 12.3054 1.8527C11.1379 1.31266 9.85601 1.0668 8.57163 1.13661C7.28725 1.20642 6.03952 1.58978 4.93752 2.25318C3.83552 2.91657 2.91279 3.8398 2.25 4.94217V2.25004H1.125V6.18754L1.6875 6.75004H5.625V5.62504H3.16238C3.91391 4.3258 5.07654 3.31367 6.46692 2.74825C7.8573 2.18283 9.39634 2.0963 10.8413 2.5023C12.2863 2.90829 13.5551 3.78372 14.4475 4.99053C15.34 6.19735 15.8053 7.66689 15.7702 9.16743C15.7351 10.668 15.2015 12.1141 14.2536 13.2779C13.3057 14.4417 11.9974 15.2568 10.535 15.5948C9.07261 15.9327 7.5393 15.7743 6.17689 15.1445C4.81447 14.5147 3.70045 13.4493 3.0105 12.1163L2.01263 12.636C2.62027 13.8048 3.51139 14.8025 4.60442 15.5377C5.69744 16.273 6.95744 16.7223 8.26906 16.8445C9.58067 16.9667 10.902 16.758 12.1121 16.2374C13.3221 15.7168 14.3822 14.9009 15.1954 13.8645ZM11.4142 12.7733L12.2108 11.9779L9 8.76604V4.50004H7.875V9.00004L8.03925 9.39829L11.4142 12.7733Z"
                        fill="#333333" />
                </svg>
                <a id="set_reminder" onclick="checkFileRemainder(this)" class="text-14 font-solaimans font-semibold leading-3">{{ __('messages.set remainder') }}</a>
            </div>
            @endif
            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M14.8875 6.5625L18 7.185V10.815L14.8875 11.4375L16.65 14.0775L14.0775 16.65L11.4375 14.8875L10.815 18H7.185L6.5625 14.8875L3.9225 16.65L1.35 14.0775L3.1125 11.4375L0 10.815V7.185L3.1125 6.5625L1.35 3.9225L3.9225 1.35L6.5625 3.1125L7.185 0H10.815L11.4375 3.1125L14.0775 1.35L16.65 3.9225L14.8875 6.5625ZM13.71 10.365L16.71 9.7575V8.2575L13.71 7.65L13.305 6.675L15.0225 4.1025L13.95 3.03L11.3775 4.7475L10.4025 4.3425L9.795 1.3425H8.295L7.6875 4.3425L6.7125 4.7475L4.14 3.03L3.0675 4.1025L4.785 6.675L4.38 7.65L1.38 8.2575V9.7575L4.38 10.365L4.785 11.34L3.0675 13.9125L4.14 14.985L6.7125 13.2675L7.6875 13.6725L8.295 16.6725H9.795L10.4025 13.6725L11.3775 13.2675L13.95 14.985L15.0225 13.9125L13.305 11.34L13.71 10.365ZM7.5705 6.861C7.99363 6.57829 8.49111 6.42743 9 6.4275C9.68166 6.42948 10.3348 6.70114 10.8168 7.18315C11.2989 7.66516 11.5705 8.31834 11.5725 9C11.5725 9.44441 11.4573 9.88123 11.2382 10.2679C11.0191 10.6545 10.7036 10.9779 10.3224 11.2063C9.94126 11.4348 9.50739 11.5606 9.06311 11.5715C8.61884 11.5824 8.17932 11.478 7.78738 11.2685C7.39544 11.059 7.06446 10.7516 6.82668 10.3762C6.58891 10.0007 6.45245 9.57006 6.43061 9.12619C6.40877 8.68232 6.50229 8.24036 6.70205 7.84338C6.90182 7.44641 7.20102 7.10795 7.5705 6.861ZM8.2875 10.0665C8.49825 10.2075 8.7465 10.2825 9 10.2825C9.1687 10.2835 9.33592 10.251 9.49197 10.1869C9.64802 10.1228 9.78979 10.0284 9.90908 9.90908C10.0284 9.78979 10.1228 9.64802 10.1869 9.49197C10.251 9.33592 10.2835 9.1687 10.2825 9C10.2825 8.77844 10.2251 8.56066 10.1158 8.36789C10.0066 8.17512 9.8493 8.01393 9.65925 7.90004C9.4692 7.78615 9.25288 7.72343 9.03139 7.71801C8.80989 7.71259 8.59076 7.76464 8.39537 7.8691C8.19997 7.97356 8.03497 8.12685 7.91644 8.31404C7.79791 8.50124 7.72991 8.71595 7.71904 8.93725C7.70818 9.15854 7.75483 9.37888 7.85446 9.57679C7.95408 9.77469 8.10327 9.94341 8.2875 10.0665Z"
                        fill="#333333" />
                </svg>
                <a id="folder_move" class="text-14 font-solaimans font-semibold leading-3"
                    onclick="folder_path(); File_path.showModal();set_cat_id(this); dropdownFileHide()" data-type=1>{{ __('messages.move') }}</a>
            </div>
            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M9.63919 1.15984C11.4294 1.33886 13.0992 2.14309 14.3552 3.43121C15.7235 4.82126 16.5325 6.66622 16.628 8.61442C16.7234 10.5626 16.0986 12.4778 14.8727 13.995C13.7452 15.3965 12.1629 16.3594 10.4 16.7169C8.63707 17.0745 6.80464 16.804 5.22019 15.9525C3.63234 15.0825 2.39276 13.6919 1.71019 12.015C1.02457 10.3294 0.93331 8.46058 1.45144 6.71621C1.96846 4.97864 3.06914 3.47266 4.56769 2.45246C6.05364 1.43874 7.84929 0.981061 9.63919 1.15984ZM10.1702 15.615C11.6809 15.3086 13.0375 14.485 14.0064 13.2862C15.0556 11.9823 15.5894 10.3384 15.5065 8.66685C15.4235 6.99527 14.7296 5.41236 13.5564 4.21871C12.4819 3.12185 11.0561 2.43752 9.52817 2.28535C8.00025 2.13317 6.46744 2.52283 5.19769 3.38621C4.24193 4.04478 3.47014 4.93646 2.95542 5.97678C2.44071 7.0171 2.20012 8.1716 2.25646 9.33092C2.31279 10.4902 2.66418 11.616 3.27732 12.6015C3.89047 13.587 4.74508 14.3997 5.76019 14.9625C7.10831 15.69 8.66915 15.921 10.1702 15.615ZM8.29707 6.74996H9.70332V5.62496H8.29707V6.74996ZM9.70332 7.87496V12.375H8.29707V7.87496H9.70332Z"
                        fill="#333333" />
                </svg>
                <a onclick="dropdownFileHide()" id="Folder_Info" class="text-14 font-solaimans font-semibold leading-3">{{ __('messages.folder info') }}</a>
            </div>
            @if (Auth::user()->can('file_sharing'))

            <div id="share" onclick="shareModal.showModal(); dropdownFileHide();set_cat_id_for_share(this);" class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path
                        d="M17.5606 5.93938L13.0606 1.44038C12.1227 0.502444 10.5 1.15929 10.5 2.50101V4.28844C9.17344 4.34719 7.87406 4.49313 6.72625 4.85063C5.62719 5.19282 4.75531 5.71251 4.13531 6.39501C3.38188 7.22501 3 8.26876 3 9.49813C3 11.4262 4.03681 13.0124 5.65219 14.0219C6.8255 14.7565 8.31619 13.6265 7.87156 12.28C7.38672 10.8075 7.33544 10.0637 10.5 9.81876V11.5C10.5 12.8435 12.124 13.4973 13.0606 12.5606L17.5606 8.06063C18.1465 7.47501 18.1465 6.52501 17.5606 5.93938ZM12 11.5V8.25501C7.97841 8.31507 5.20288 8.97969 6.44719 12.75C5.52469 12.1734 4.5 11.1275 4.5 9.49813C4.5 6.08144 8.53563 5.78104 12 5.75282V2.50001L16.5 7.00001L12 11.5ZM12.7731 14.1404C13.0041 14.0744 13.2247 13.9766 13.4286 13.8497C13.6778 13.6949 14 13.8755 14 14.1689V15.5C14 16.3284 13.3284 17 12.5 17H1.5C0.671562 17 0 16.3284 0 15.5V4.50001C0 3.67157 0.671562 3.00001 1.5 3.00001H5.625C5.83209 3.00001 6 3.16791 6 3.37501V3.51519C6 3.66885 5.90666 3.80798 5.76347 3.86369C5.33528 4.03029 4.93859 4.22423 4.57441 4.44448C4.51529 4.48056 4.44742 4.49976 4.37816 4.50001H1.6875C1.63777 4.50001 1.59008 4.51976 1.55492 4.55492C1.51975 4.59009 1.5 4.63778 1.5 4.68751V15.3125C1.5 15.3622 1.51975 15.4099 1.55492 15.4451C1.59008 15.4803 1.63777 15.5 1.6875 15.5H12.3125C12.3622 15.5 12.4099 15.4803 12.4451 15.4451C12.4802 15.4099 12.5 15.3622 12.5 15.3125V14.5011C12.5 14.3333 12.6118 14.1867 12.7731 14.1404Z"
                        fill="#333333" />
                </svg>
                <a  class="text-14 font-solaimans font-semibold leading-3">{{ __('messages.share') }}</a>
            </div>
            @endif
            @if (Auth::user()->can('rename'))

            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M16.6197 3.92064L15.7422 3.71364L13.3707 6.07164L12.0275 4.70364L14.3405 2.27701L14.138 1.38601C13.6492 1.22249 13.138 1.13596 12.6226 1.12951C12.0604 1.12087 11.5024 1.22809 10.9835 1.44451C10.4824 1.67132 10.0295 1.99212 9.64922 2.38951C9.22593 2.79048 8.89071 3.27512 8.66484 3.81264C8.22998 4.88238 8.22998 6.07964 8.66484 7.14939C6.31948 9.45676 4.00441 11.7947 1.72022 14.1626C1.48397 14.472 1.37147 14.8579 1.40072 15.246C1.42377 15.6635 1.6115 16.0547 1.92272 16.3339C2.06222 16.4858 2.22872 16.6118 2.41434 16.7029C2.60559 16.7873 2.81147 16.8356 3.01959 16.8458C3.37509 16.839 3.71597 16.704 3.98034 16.4666C5.72184 14.8275 9.05859 11.4604 10.9542 9.48714C11.4683 9.70539 12.0207 9.81789 12.5787 9.81676C13.1404 9.81632 13.6963 9.7033 14.2136 9.48437C14.7309 9.26544 15.199 8.94506 15.5903 8.54214C16.3942 7.7223 16.8432 6.61907 16.8402 5.47089C16.8532 4.94548 16.7787 4.42158 16.6197 3.92064ZM3.29972 15.669C3.25642 15.7075 3.20422 15.7345 3.14784 15.7478C3.09238 15.7574 3.03568 15.7574 2.98022 15.7478C2.92207 15.7389 2.86668 15.717 2.81822 15.6836C2.76621 15.6532 2.72224 15.6108 2.68997 15.5599C2.53247 15.399 2.38509 15.093 2.53247 14.9209C4.07372 13.2818 7.24734 10.0778 9.23184 8.11914C9.34434 8.26764 9.46809 8.40939 9.60084 8.54214C9.73359 8.68051 9.87647 8.80876 10.0283 8.92576C8.10909 10.8945 4.97822 14.0603 3.29972 15.669ZM15.8075 5.47089C15.8097 6.33151 15.4745 7.15839 14.8715 7.77489C14.2697 8.36517 13.4605 8.69584 12.6175 8.69584C11.7746 8.69584 10.9653 8.36517 10.3636 7.77489C9.92257 7.31465 9.62131 6.73864 9.49484 6.11388C9.36838 5.48912 9.42191 4.84129 9.64922 4.24576C9.80052 3.84046 10.0352 3.47143 10.3381 3.16253C10.641 2.85363 11.0053 2.61175 11.4076 2.45251C11.7895 2.29266 12.1996 2.2108 12.6136 2.21176H12.8993L10.8552 4.31889V5.10189L12.9871 7.22364H13.7296L15.8075 5.18064V5.47089ZM3.64509 7.52401H5.36747L6.16059 8.33064L6.92334 7.57239L6.17522 6.80964V6.76126L6.23934 4.90614L5.99184 4.41451L2.77434 2.29726L2.10947 2.37151L1.17459 3.32664L1.10034 4.00051L3.16809 7.28326L3.64509 7.52401ZM2.58197 3.43801L5.18522 5.15251L5.14134 6.41589H3.93084L2.25234 3.75864L2.58197 3.43801ZM10.5751 11.268L11.3333 10.5109L14.8276 14.094C15.1219 14.4033 15.2861 14.814 15.2861 15.2409C15.2861 15.6679 15.1219 16.0786 14.8276 16.3879C14.6063 16.6151 14.3217 16.7704 14.0109 16.8336C13.7001 16.8968 13.3774 16.865 13.085 16.7423C12.8983 16.6595 12.7309 16.5388 12.5933 16.3879L9.05859 12.7845L9.82247 12.0218L13.346 15.615C13.3933 15.6673 13.4523 15.7077 13.5181 15.7331C13.6476 15.7857 13.7925 15.7857 13.922 15.7331C13.9878 15.7077 14.0467 15.6672 14.0941 15.615C14.1433 15.5662 14.1817 15.5076 14.2066 15.4429C14.2324 15.3769 14.2461 15.3068 14.2471 15.2359C14.246 15.1651 14.2326 15.0951 14.2077 15.0289C14.1828 14.9642 14.1445 14.9055 14.0952 14.8568L10.5751 11.268Z"
                        fill="#333333" />
                </svg>
                <a id="Rename" class="text-14 font-solaimans font-semibold leading-3"
                    onclick="rename_folder(event);edit_modal.showModal();dropdownFileHide()">{{ __('messages.rename') }}</a>
            </div>
            @endif
            @if (Auth::user()->can('comment'))

            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <span><i class="fa fa-regular fa-message"></i></span>
                <a id="comment" class="text-14 font-solaimans font-semibold leading-3"
                    onclick="openComment(event); dropdownFileHide();get_comment(this)">{{ __('messages.comments') }}</a>
            </div>
            @endif
            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <span><i class="fa-solid fa-lock"></i></span>
                <a id="file_lock" class="text-14 font-solaimans font-semibold leading-3" onclick="file_lock(event,this);"
                >{{ __('messages.file_lock') }}</a>
            </div>
            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <span><i class="fa-solid fa-code-fork"></i></span>
                <a id="fileVersion" class="text-14 font-solaimans font-semibold leading-3"
                onclick="checkFileVersion(event,this);">{{ __('messages.file version') }}</a>
            </div>
            

            <div class="flex items-center justify-start gap-1 px-2 hover:bg-gray-300 py-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M11.25 3.375H14.625V4.5H13.5V14.625L12.375 15.75H4.5L3.375 14.625V4.5H2.25V3.375H5.625V2.25C5.625 1.95163 5.74353 1.66548 5.9545 1.4545C6.16548 1.24353 6.45163 1.125 6.75 1.125H10.125C10.4234 1.125 10.7095 1.24353 10.9205 1.4545C11.1315 1.66548 11.25 1.95163 11.25 2.25V3.375ZM10.125 2.25H6.75V3.375H10.125V2.25ZM4.5 14.625H12.375V4.5H4.5V14.625ZM6.75 5.625H5.625V13.5H6.75V5.625ZM7.875 5.625H9V13.5H7.875V5.625ZM10.125 5.625H11.25V13.5H10.125V5.625Z"
                        fill="#333333" />
                </svg>
                <a id="Delete" class="text-14 font-solaimans font-semibold leading-3" onclick='confirmDelete(event); dropdownFileHide()'
                    data-type=1>{{ __('messages.delete') }}</a> {{--data_type 1 for folder 2 for files--}}
            </div>
        </div>
    </div>
   
        @if(Auth::user()->office_role == '')
            <!-- Open the modal using ID.showModal() method -->
            <dialog id="userMessage_modal" class="modal modal-bottom sm:modal-middle">
                <div class="modal-box max-w-xs">
                    <h3 class="font-bold text-lg font-solaimans">
                        {{ __('messages.message') }}
                    </h3>
                    <div class="my-2">
                    
                        <div class="modal-body">
                            <p>এই সিস্টেমে আপনার সঠিক ব্যবহারকারী পদবীর জন্য সুপারএডমিন অথবা আইটি কর্মকর্তার সাথে যোগাযোগ করুন। ধন্যবাদ </p>
                        </div>
                            
                        <div class="text-end mt-3 space-x-2">
                            <button onclick="close_modal('userMessage_modal')"
                                class="text-[#007A43] font-solaimans hover:bg-gray-300 rounded-lg px-1 py-1"
                                type="button">{{ __('messages.ok') }}</button>
                                
                        </div>
                    </div>
                </div>
            </dialog>
        @endif        


    @endsection
@section('scripts')
<script>
function go_folder(id) {
    localStorage.setItem("myVariable", id);
    window.location.href = '/files';
}
</script>

<script>
   $(document).ready(function(){
        userMessage_modal.showModal();
   })
</script>


@endsection