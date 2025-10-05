
 function fetch_data(id, department_id, order_type, parliament_id, order_date ,event_name, event_loc, event_for, event_type, event_date, event_name ,searchType, is_search) {
  //alert('jkdcnj')
   
    $('#search-folder').val('');
    if(searchType == undefined){
        searchType = $('#search_type').val();
    }

    $('#folder_cat_id').val(id)
    
    var search_type = $('#search_type').val();
    
    if(window.location.pathname != '/search/files'){
        if(search_type == 'vip_official' && id == '1'){
            $('#vipOfficial_upload').css('display', 'block') // user home page
        }else if(search_type == 'official' && id == '1'){
            $('#vipOfficial_upload').css('display', 'block') // user home page
        }else{
            $('#vipOfficial_upload').css('display', 'block')  // upload page
        }
    }else{
        $('#vipOfficial_upload').css('display', 'none') // search page
    }
 
    var userfile = $('#userfile').val();
    const loadingSpinner = '<span class="loading loading-bars loading-xs">';
    const loadingfolder = `<div class="shadow">
                            <div class="flex animate-pulse space-x-4">
                                <div class="flex h-14 w-56 items-center bg-slate-50">
                                    <div class="ms-2 h-4 w-5 bg-slate-200"></div>
                                        <div class="ms-2 flex h-full w-full flex-col gap-1 p-3">
                                            <div class="ms-2 h-2 w-full bg-slate-200"></div>
                                            <div class="ms-2 h-2 w-full bg-slate-200"></div>
                                            <div class="ms-2 h-2 w-full bg-slate-200"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
    const loadingfile = `<div class="rounded-md shadow">
                            <div class="flex animate-pulse space-x-4">
                            <div class="flex flex-col h-44 w-48 items-center bg-slate-50 p-3">
                                <div class="h-80 w-40  bg-slate-200"></div>
                                <div class="flex h-full w-full flex-col gap-1 py-2 pe-4">
                                <div class="ms-2 h-2 w-full bg-slate-200"></div>
                                <div class="ms-2 h-2 w-full bg-slate-200"></div>
                                <div class="ms-2 h-2 w-full bg-slate-200"></div>
                                </div>
                            </div>
                            </div>
                        </div>`;
                      
    $("#fetch_folder_data").html(loadingfolder);
    $("#fetch_file_data").html(loadingfile);
    $("#vip_fetch_folder_data").html(loadingfolder);
    $("#fetch_bar_camb").html(loadingSpinner);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    
     if(id != 1){
        $('#folder_type').hide().prop('required',false)
     }else{
        $('#folder_type').css('display', 'block')
    }
//   console.log(id, event_name, event_loc, parliament_id, event_for, event_type, event_date ,searchType, is_search);

    $.ajax({
        url: "/fetch_data/search-file-folder",
        method: "POST",
        data: {
            id: id, 
            userfile: userfile, 
            department_id: department_id, 
            order_type: order_type, 
            parliament_id: parliament_id, 
            order_date: order_date, 
            event_for: event_for,
            event_type: event_type,
            event_date: event_date,
            event_name: event_name,
            event_loc: event_loc,
            searchType: searchType,
            is_search: is_search,
        },
        success: function (data) {
            var user_id=data.user_id;
            var emp_type=data.emp_type;
            
            localStorage.setItem("preavcat", data.parantcat);

            //alert(data);
 
            if (data=='Unauthorized') {
                window.location.href = '/login';
            }
            if (typeof noData !== 'undefined') {
                $('#noData').addClass('hidden');
            }
            $("#fetch_folder_data").empty();
            $("#vip_fetch_folder_data").empty();
            $("#fetch_bar_camb").empty();
            $("#fetch_file_data").empty();
            $("#parent_category_id").val(data.Category);
            $("#category_id_file").val(data.Category);
            localStorage.setItem("myVariable", data.Category);
            var folder_data = data.folderData;
            var vip_folder_data = data.vipFolderData;
            var fileData = data.fileData;
                
            var html = '<option value="">Select Parliament</option>';
            data.parliaments.forEach(item => {
                if(item.id == id){
                    html += '<option selected value="'+item.id+'">'+item.name+'</option>'
                    $('#parliamentidElm').val(id)
                }else{
                    html += '<option value="'+item.id+'">'+item.name+'</option>'
                }
            });
            $('#all_parliaments').html(html)
            
            var breadcrumbs = data.breadcrumbs;
            if (Object.keys(folder_data).length > 0) {
                Object.keys(folder_data).forEach(function (key) {
                    const item = folder_data[key];
                    if(emp_type!='superadmin'){
                        if (user_id == item.user_id) {
                            is_own=1
                        }else{
                            is_own=0
                        }
                    }else{
                        is_own=1
                    }

                    var newItem = `<section draggable="true" data-id="${item.id}" data-own="${is_own}" data-name="${item.name}" data-type="folder"  ondblclick="fetch_data(${item.id})"  class="folderclick drag_box cursor-pointer rounded-md w-[95%]  lg:w-[30.9%]  xl:w-[23%]   bg-[#EBFBEC] py-3  placeholder:flex items-center justify-between gap-1" >
                                            <div class="flex items-center ps-3 gap-2 w-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M2.25 21H18.75L19.47 20.445L23.415 9.945L22.695 9H21V5.25L20.25 4.5H11.565L10.275 3.225L9.75 3H2.25L1.5 3.75V20.25L2.25 21ZM3 4.5H9.435L10.725 5.775L11.25 6H19.5V9H12.75L12.225 9.225L10.935 10.5H5.25L4.545 11.01L3.045 15.63L3 4.5ZM18.195 19.5H3.285L5.79 12H11.25L11.775 11.775L13.065 10.5H21.75L18.195 19.5Z" fill="black"/>
                                                </svg>
                                                <h3 style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;height: 20px;width: 70%;" class="text-10 select-none lg:text-13 lx:text-16 font-solaimans leading-4">${item.name}</h3>
                                                <svg data-id="${item.id}" data-name="${item.name}" data-type="folder" onclick="get_hiden_menu(event, this)" class="file_delete w-[1.125em] cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z" fill="black"/>
                                                </svg>
                                            </div>
                                    </section>`;
                    $("#fetch_folder_data").append(newItem);
                });
            } else {
                $("#fetch_folder_data").append(langTranslations.no_folders_found);
            }

            if (Object.keys(vip_folder_data).length > 0) {
                $("#vip_fetch_folder_data").html('');
                Object.keys(vip_folder_data).forEach(function (key) {
                    const item = vip_folder_data[key];
                    if(emp_type!='superadmin'){
                        if (user_id == item.user_id) {
                            is_own=1
                        }else{
                            is_own=0
                        }
                    }else{
                        is_own=1
                    }
                    var newItem = ` <section draggable="true" data-id="${item.id}" data-own="${is_own}" data-name="${item.name}" data-type="folder"  ondblclick="fetch_data(${item.id})"  class="folderclick drag_box cursor-pointer rounded-md w-[95%]  lg:w-[30.9%]  xl:w-[23%]   bg-[#EBFBEC] py-3  placeholder:flex items-center justify-between gap-1" >
                                            <div class="flex items-center ps-3 gap-2 w-full">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path d="M2.25 21H18.75L19.47 20.445L23.415 9.945L22.695 9H21V5.25L20.25 4.5H11.565L10.275 3.225L9.75 3H2.25L1.5 3.75V20.25L2.25 21ZM3 4.5H9.435L10.725 5.775L11.25 6H19.5V9H12.75L12.225 9.225L10.935 10.5H5.25L4.545 11.01L3.045 15.63L3 4.5ZM18.195 19.5H3.285L5.79 12H11.25L11.775 11.775L13.065 10.5H21.75L18.195 19.5Z" fill="black"/>
                                                </svg>
                                                <h3 style="overflow: hidden;white-space: nowrap;text-overflow: ellipsis;height: 20px;width: 70%;" class="text-10 select-none lg:text-13 lx:text-16 font-solaimans leading-4">${item.name}</h3>
                                                <svg data-id="${item.id}" data-name="${item.name}" data-type="folder" onclick="get_hiden_menu(event, this)" class="file_delete w-[1.125em] cursor-pointer" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z" fill="black"/>
                                                </svg>
                                            </div>
                                    </section>`;
                    $("#vip_fetch_folder_data").append(newItem);
                    
                });
               
                // if (window.location.pathname != '/all/files' && window.location.pathname != '/search/files' && window.location.pathname != '/personal-files') {
                //     window.location.href = '/all/files';
                // }
                
            } else {
                $("#vip_fetch_folder_data").append(langTranslations.no_folders_found);
            }
            
            
            // file data add
            if (Object.keys(fileData).length > 0) {
                Object.keys(fileData).forEach(function (key) {
                    const file_item = fileData[key];
                    var file_type = file_item.filetype;
                    if (file_type == "mp4") {
                        file_type = "video--v1";
                    }else if (file_type == "gz") {
                        file_type = "zip";
                    }else if (file_type == "jpeg") {
                        file_type = "image";
                    }else if (file_type == "java") {
                        file_type = "java-coffee-cup-logo";
                    }else if (file_type == "pub") {
                        file_type = "ms-publisher";
                    }else if (file_type == "docx") {
                        file_type = "ms-word";
                    }else if (file_type == "accdb") {
                        file_type = "ms-word";
                    }else if (file_type == "pptx") {
                        file_type = "powerpoint";
                    }else if (file_type == "xlsx") {
                        file_type = "ms-excel";
                    }

                    if(emp_type!='superadmin'){
                        if (user_id == file_item.user_id) {
                            is_own=1
                        }else{
                            is_own=0
                        }
                    }else{
                        is_own=1
                    }

                    var newItem = `<section draggable="true" data-own="${is_own}" data-id="${file_item.id}" data-name="${file_item.title}" data-type="file"  class="drag_box w-[43%] lg:w-[21.2%] xl:w-[17%] px-3 pt-3 bg-[#F4F4F4] rounded-md border border-[#cfcfcf] file_link" ondblclick="displayFileContents('${file_item.id}');">
                    <div class="w-full bg-white rounded-md flex items-center justify-center">
                    <div class="relative px-2 py-1 md:px-4 md:py-2 lg:px-11 lg:py-8 remove-doc w-full">
                        <img class="w-full" src="https://img.icons8.com/color/96/${file_type}.png" alt="${file_type}"/>
                            </div>
                        </div>
                        <div class="flex justify-between items-center pt-3 pb-4">
                            <h1 class="text-12 xl:text-14 font-solaimans leading-5 cursor-pointer w-[83%]" title='${file_item.title}' style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${file_item.title}</h1>
                        <svg data-id="${file_item.id}" data-name="${file_item.title}" data-type="file" onclick="get_hiden_menu(event, this)" class="file_delete cursor-pointer w-[15%] h-[1.125]" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 18 18" fill="none">
                                <path d="M9 13.5C9.29837 13.5 9.58452 13.6185 9.79549 13.8295C10.0065 14.0405 10.125 14.3266 10.125 14.625C10.125 14.9234 10.0065 15.2095 9.79549 15.4205C9.58452 15.6315 9.29837 15.75 9 15.75C8.70163 15.75 8.41548 15.6315 8.20451 15.4205C7.99353 15.2095 7.875 14.9234 7.875 14.625C7.875 14.3266 7.99353 14.0405 8.20451 13.8295C8.41548 13.6185 8.70163 13.5 9 13.5ZM9 7.875C9.29837 7.875 9.58452 7.99353 9.79549 8.2045C10.0065 8.41548 10.125 8.70163 10.125 9C10.125 9.29837 10.0065 9.58452 9.79549 9.7955C9.58452 10.0065 9.29837 10.125 9 10.125C8.70163 10.125 8.41548 10.0065 8.20451 9.7955C7.99353 9.58452 7.875 9.29837 7.875 9C7.875 8.70163 7.99353 8.41548 8.20451 8.2045C8.41548 7.99353 8.70163 7.875 9 7.875ZM9 2.25C9.29837 2.25 9.58452 2.36853 9.79549 2.5795C10.0065 2.79048 10.125 3.07663 10.125 3.375C10.125 3.67337 10.0065 3.95952 9.79549 4.1705C9.58452 4.38147 9.29837 4.5 9 4.5C8.70163 4.5 8.41548 4.38147 8.20451 4.1705C7.99353 3.95952 7.875 3.67337 7.875 3.375C7.875 3.07663 7.99353 2.79048 8.20451 2.5795C8.41548 2.36853 8.70163 2.25 9 2.25Z" fill="black"/>
                        </svg>
                    </div>
                </section>`;

                $("#fetch_file_data").append(newItem);
                });
            } else {
                $('#noData').removeClass('hidden')
            }
            breadcrumbs.forEach(function (item) {
                var Items = `<a onclick="fetch_data(${item.id})">${item.name}</a>/`;
                $("#fetch_bar_camb").append(Items);
            });
            startdrag();
        },
        error: function (xhr, status, error) {
            if (error=='Unauthorized') {
                window.location.href = '/login';
            }
            localStorage.setItem("myVariable", 1);
            // window.location.reload();
            console.log(error);
        },
    });
 
}
var rlocation = window.location.href;
 
const myVariable = localStorage.getItem("myVariable");
localStorage.setItem("preavcat", myVariable);

if (rlocation.endsWith("files")) {
    if (myVariable) {
        fetch_data(myVariable);
    } else {
        fetch_data(1);
    }
}else{    
    localStorage.setItem("myVariable", 1);
    localStorage.setItem("preavcat", 1);
}


var targetElement = $("#open-file-section");
var referenceElement = $(".file_delete");

function get_hiden_menu(event, el) {
    event.stopPropagation();
    const referenceElementPosition = $(el).offset();
    const elementId = $(el).data("id");
    const elementName = $(el).data("name");
    const elementType = $(el).data("type");
    const data_own = $(el).closest('section').data("own");
    
    targetElement.css({
        top: referenceElementPosition.top + 10 + 'px',
        left: referenceElementPosition.left + 20 + 'px'
    });
    // Animate the target element sliding down
    targetElement.slideDown("fast");
    const menuItems = [
        "set_reminder",
        // "folder_move",
        "Folder_Info",
        // "share",
        "comment",
        "Activity",
        "Rename",
        "Delete",
        "fileVersion",
        // "file_lock"
    ];
    menuItems.forEach((item) => {
        $(`#${item}`).attr("data-catid", elementId);
        $(`#${item}`).attr("data-name", elementName);
        $(`#${item}`).attr("data-type", elementType);
    });
 
    if (elementType=="folder") {
        $('#fileVersion').closest('div').addClass('hidden');
        $('#file_lock').closest('div').addClass('hidden');
        $('#Folder_Info').text(langTranslations.folder_info);
    }else{
        $('#fileVersion').closest('div').removeClass('hidden');
        $('#Folder_Info').text(langTranslations.file_info);
    }
    if (data_own == 0) {
        $('#set_reminder').closest('div').addClass('hidden');
        //$('#Folder_Info').closest('div').addClass('hidden');
        $('#comment').closest('div').addClass('hidden');
        $('#Activity').closest('div').addClass('hidden');
        $('#Rename').closest('div').addClass('hidden');
        $('#Delete').closest('div').addClass('hidden');
        $('#fileVersion').closest('div').addClass('hidden');
        $('#file_lock').closest('div').addClass('hidden');
    }else{
        $('#set_reminder').closest('div').removeClass('hidden');
        
        $('#comment').closest('div').removeClass('hidden');
        $('#Activity').closest('div').removeClass('hidden');
        $('#Rename').closest('div').removeClass('hidden');
        $('#Delete').closest('div').removeClass('hidden');
        $('#fileVersion').closest('div').removeClass('hidden');
        $('#file_lock').closest('div').removeClass('hidden');
    }
    $('#folder_move').closest('div').addClass('hidden');

}
// Close the target element when clicking anywhere on the document
$(document).on("click", function (event) {
    if (
        !targetElement.is(event.target) &&
        targetElement.has(event.target).length === 0
    ) {
        targetElement.slideUp("fast");
    }
});

$(document).on("submit", "#setRemaider_form", function (e) {
    e.preventDefault();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var formData = $("#setRemaider_form").serialize()
     
    $.ajax({
        url: "/set_reminder",
        type: "POST",
        data: formData,
        success: function (response) {
            $("#reminder_description").val('');
            setRemaider_Modal.close();
            showMessage('success', response)
            reloadPageIfURLContainsUser()
            targetElement.slideUp("fast");
        },
        error: function (xhr, status, error) {
            showMessage('error', xhr)
        }
    })
});
function deleteReminder(id) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/delete_reminder",
        type: "POST",
        data: {
            id: id
        },
        success: function (response) {
            showMessage('success', response)
            window.location.reload();
        },
        error: function (xhr, status, error) {
            showMessage('error', xhr.responseJSON.message)
        }
    })
}
function deleteReminder_modal(id,event) {
    var $this = $(event.target); // Store the reference to $(this)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: "/delete_reminder",
        type: "POST",
        data: {
            id: id
        },
        success: function (response) {
            $this.closest('li').animate({ marginLeft: '100%' }, 400, function() {
                $(this).remove();
                var liCount = $("#reminder_alert_list li").length;
                if(liCount == 0){
                    reminder_show_modal.close();
                }
            }); 
        },
        error: function (xhr, status, error) {
            showMessage('error', xhr.responseJSON.message); // Assuming showMessage is properly defined
        }
    });
}

function mark_as_read_Reminder(id) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/mark_as_read_Reminder",
        type: "POST",
        data: {
            id: id
        },
        success: function (response) {
        
           // $this.closest('li').animate({ marginLeft: '100%' }, 500, function() {
            //     $(this).remove();
            //     var liCount = $("#reminder_alert_list li").length;
            //     if(liCount == 0){
            //         reminder_show_modal.close();
            //     }
            // });         
        },
        error: function (xhr, status, error) {
            showMessage('error', xhr.responseJSON.message)
        }
    })
}
function deleteAll() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/delete_all_reminder",
        type: "POST",
        success: function (response) {
            showMessage('success', response)
            window.location.reload();
        },
        error: function (xhr, status, error) {
            showMessage('error', xhr.responseJSON.message)
        }
    })
}
document.querySelectorAll(".drop-zone__input").forEach((inputElement) => {
    const dropZoneElement = inputElement.closest(".drop-zone");

    dropZoneElement.addEventListener("click", (e) => {
        inputElement.click();
    });

    inputElement.addEventListener("change", (e) => {
        if (inputElement.files.length) {
            // updateThumbnail(dropZoneElement, inputElement.files[0]);
        }
    });

    dropZoneElement.addEventListener("dragover", (e) => {
        e.preventDefault();
        dropZoneElement.classList.add("drop-zone--over");
    });

    ["dragleave", "dragend"].forEach((type) => {
        dropZoneElement.addEventListener(type, (e) => {
            dropZoneElement.classList.remove("drop-zone--over");
        });
    });

    dropZoneElement.addEventListener("drop", (e) => {
        e.preventDefault();
        if (e.dataTransfer.files.length) {
            inputElement.files = e.dataTransfer.files;
            upload_file()
        }
        dropZoneElement.classList.remove("drop-zone--over");
    });
});


