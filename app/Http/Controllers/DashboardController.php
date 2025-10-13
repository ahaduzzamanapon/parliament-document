<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Document;
use App\Models\Settings;
use App\Models\OrderType;
use App\Models\Department;
use App\Models\ShareDoc;
use App\Models\VipUserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;


class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

    }
    public function index($id = null)
    {
        //dd(Auth::user());
    
        $user_id = Auth::user()->id;
        $fileData = Document::get();
        return view('app', compact('fileData'));
    }
    
    public function user_dashboard($id = null)
    {
     
        $user = Auth::user();
        $user_dept_id = Auth::user()->department_id;
        $setting=Settings::first();
        // if ($user->hasRole('admin') || $user->hasRole('Admin')) {
        if ($user->emp_type == 'superadmin') {
             
            $user_id = Auth::user()->id;
            $user_name = Auth::user()->nameEn;
            $totalFiles = Document::count();
            $totalFolders = Category::count();
            $totalUser=User::count();
            // $officalRecentFolders = Category::where('id', '!=', 1)->where(['folder_type' => 'official', 'parent_category_id' => 1])->latest()->get();

            // $vipRecentFolders = Category::where('id', '!=', 1)->where(['folder_type' => 'vip_official', 'parent_category_id' => 1])->latest()->take(8)->get();

            $officalRecentFolders = Department::with('categories')->where('status', 1)->get();
             
            $vipRecentFolders = Category::where('id', '!=', 1)->where(['folder_type' => 'vip_official', 'parent_category_id' => 1])->latest()->get();
       
            $fileData = Document::latest()
                ->take(12)
                ->get();
 
 

            $documents = Document::get();
            $filetypeTotals = [];
            $formatFileSize = function ($fileSizeInBytes) {
                $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                $unitIndex = 0;
                while ($fileSizeInBytes >= 1024 && $unitIndex < count($units) - 1) {
                    $fileSizeInBytes /= 1024;
                    $unitIndex++;
                }
                return round($fileSizeInBytes, 2) . ' ' . $units[$unitIndex];
            };
            // Calculate total used space and file type totals
            $totalUsedSpaceBytes = 0;
            foreach ($documents as $document) {
                // Get the filetype and file size for each document
                $filetype = $document->filetype;
                $fileSize = $document->file_size;
                // Add the file size to the total size for this filetype
                if (!isset($filetypeTotals[$filetype])) {
                    $filetypeTotals[$filetype] = ['size' => 0, 'percentage' => 0];
                }
                $filetypeTotals[$filetype]['size'] += $fileSize;
                $totalUsedSpaceBytes += $fileSize;
            }
            // Calculate the percentage of total space consumed for each filetype
            foreach ($filetypeTotals as &$data) {
                if ($totalUsedSpaceBytes != 0) {
                    $data['percentage'] = ($data['size'] / $totalUsedSpaceBytes) * 100;
                } else {
                    $data['percentage'] = 0; // Handle the case when totalUsedSpaceBytes is zero.
                }
                $data['size'] = $formatFileSize($data['size']);
                $data['percentage'] = round($data['percentage'], 2);
                $data['color'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
            }
            // Format the total used storage space
            $totalUsedSpace = $formatFileSize($totalUsedSpaceBytes);

       
            return view('app', compact('fileData', 'user','totalUser', 'officalRecentFolders', 'vipRecentFolders', 'totalFiles', 'totalFolders', 'user_name', 'totalUsedSpace', 'filetypeTotals'));

        }elseif ($user->emp_type == 'sochebaloy_official') {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->nameEn;
                $totalFiles = Document::count();
                $totalFolders = Category::count();
                $totalUser=User::count();
                $officalRecentFolders = Category::where('id', '!=', 1)
                ->where(['parent_category_id' => 1, 'folder_type' => 'official', 'department_id' => $user_dept_id])->latest()->take(8)->get();
                
                $vipRecentFolders = [];
                $fileData = Document::where('department_id', $user_dept_id)->where('status', 'official')->latest()
                    ->take(12)
                    ->get();
                $documents = Document::get();
                $filetypeTotals = [];
                $formatFileSize = function ($fileSizeInBytes) {
                    $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    $unitIndex = 0;
                    while ($fileSizeInBytes >= 1024 && $unitIndex < count($units) - 1) {
                        $fileSizeInBytes /= 1024;
                        $unitIndex++;
                    }
                    return round($fileSizeInBytes, 2) . ' ' . $units[$unitIndex];
                };
                // Calculate total used space and file type totals
                $totalUsedSpaceBytes = 0;
                foreach ($documents as $document) {
                    // Get the filetype and file size for each document
                    $filetype = $document->filetype;
                    $fileSize = $document->file_size;
                    // Add the file size to the total size for this filetype
                    if (!isset($filetypeTotals[$filetype])) {
                        $filetypeTotals[$filetype] = ['size' => 0, 'percentage' => 0];
                    }
                    $filetypeTotals[$filetype]['size'] += $fileSize;
                    $totalUsedSpaceBytes += $fileSize;
                }
                // Calculate the percentage of total space consumed for each filetype
                foreach ($filetypeTotals as &$data) {
                    if ($totalUsedSpaceBytes != 0) {
                        $data['percentage'] = ($data['size'] / $totalUsedSpaceBytes) * 100;
                    } else {
                        $data['percentage'] = 0; // Handle the case when totalUsedSpaceBytes is zero.
                    }
                    $data['size'] = $formatFileSize($data['size']);
                    $data['percentage'] = round($data['percentage'], 2);
                    $data['color'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                }
                // Format the total used storage space
                $totalUsedSpace = $formatFileSize($totalUsedSpaceBytes);
                //dd($fileData);

                return view('app', compact('fileData', 'user','totalUser', 'officalRecentFolders', 'vipRecentFolders', 'totalFiles', 'totalFolders', 'user_name', 'totalUsedSpace', 'filetypeTotals'));

        }elseif ($user->emp_type == 'vip_official') {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->nameEn;
                $totalFiles = Document::count();
                $totalFolders = Category::count();
                $totalUser=User::count();
                $officalRecentFolders = [];
                $vipRecentFolders = Category::where('id', '!=', 1)->where(['folder_type' => 'vip_official', 'parent_category_id' => 1])->latest()->take(8)->get();
                $fileData = Document::where('department_id', $user_dept_id)->where('status', 'vip_official')->latest()
                    ->take(12)
                    ->get();
                $documents = Document::get();
                $filetypeTotals = [];
                $formatFileSize = function ($fileSizeInBytes) {
                    $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    $unitIndex = 0;
                    while ($fileSizeInBytes >= 1024 && $unitIndex < count($units) - 1) {
                        $fileSizeInBytes /= 1024;
                        $unitIndex++;
                    }
                    return round($fileSizeInBytes, 2) . ' ' . $units[$unitIndex];
                };
                // Calculate total used space and file type totals
                $totalUsedSpaceBytes = 0;
                foreach ($documents as $document) {
                    // Get the filetype and file size for each document
                    $filetype = $document->filetype;
                    $fileSize = $document->file_size;
                    // Add the file size to the total size for this filetype
                    if (!isset($filetypeTotals[$filetype])) {
                        $filetypeTotals[$filetype] = ['size' => 0, 'percentage' => 0];
                    }
                    $filetypeTotals[$filetype]['size'] += $fileSize;
                    $totalUsedSpaceBytes += $fileSize;
                }
                // Calculate the percentage of total space consumed for each filetype
                foreach ($filetypeTotals as &$data) {
                    if ($totalUsedSpaceBytes != 0) {
                        $data['percentage'] = ($data['size'] / $totalUsedSpaceBytes) * 100;
                    } else {
                        $data['percentage'] = 0; // Handle the case when totalUsedSpaceBytes is zero.
                    }
                    $data['size'] = $formatFileSize($data['size']);
                    $data['percentage'] = round($data['percentage'], 2);
                    $data['color'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                }
                // Format the total used storage space
                $totalUsedSpace = $formatFileSize($totalUsedSpaceBytes);

                $recent_events = Document::where('status', 'vip_official')->whereNotNull('event_name')->latest()
                ->take(5)->get();

                return view('app', compact('fileData', 'recent_events', 'user','totalUser', 'officalRecentFolders', 'vipRecentFolders', 'totalFiles', 'totalFolders', 'user_name', 'totalUsedSpace', 'filetypeTotals'));
            } else {
                $user_id = Auth::user()->id;
                $user_name = Auth::user()->nameEn;
                $totalFiles = Document::where('user_id', $user_id)->count();
                $totalFolders = Category::where('user_id', $user_id)->count();
                $recentFolders = Category::where('user_id', $user_id)->latest()->take(8)->get();

                $officalRecentFolders = [];
                $vipRecentFolders = [];
                $genRecentFolders = [];
                $fileData = Document::where('user_id', $user_id)->latest()
                    ->take(10)
                    ->get();
                $documents = Document::where('user_id', $user_id)->get();
                $filetypeTotals = [];
                $formatFileSize = function ($fileSizeInBytes) {
                    $units = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
                    $unitIndex = 0;
                    while ($fileSizeInBytes >= 1024 && $unitIndex < count($units) - 1) {
                        $fileSizeInBytes /= 1024;
                        $unitIndex++;
                    }
                    return round($fileSizeInBytes, 2) . ' ' . $units[$unitIndex];
                };
                // Calculate total used space and file type totals
                $totalUsedSpaceBytes = 0;
                foreach ($documents as $document) {
                    // Get the filetype and file size for each document
                    $filetype = $document->filetype;
                    $fileSize = $document->file_size;
                    // Add the file size to the total size for this filetype
                    if (!isset($filetypeTotals[$filetype])) {
                        $filetypeTotals[$filetype] = ['size' => 0, 'percentage' => 0];
                    }
                    $filetypeTotals[$filetype]['size'] += $fileSize;
                    $totalUsedSpaceBytes += $fileSize;
                }
                // Calculate the percentage of total space consumed for each filetype
                foreach ($filetypeTotals as &$data) {
                    if ($totalUsedSpaceBytes != 0) {
                        $data['percentage'] = ($data['size'] / $totalUsedSpaceBytes) * 100;
                    } else {
                        $data['percentage'] = 0; // Handle the case when totalUsedSpaceBytes is zero.
                    }
                    $data['size'] = $formatFileSize($data['size']);
                    $data['percentage'] = round($data['percentage'], 2);
                    $data['color'] = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);
                }
                // Format the total used storage space
                $totalUsedSpace = $formatFileSize($totalUsedSpaceBytes);
                return view('user_dashboard', compact('fileData', 'user', 'genRecentFolders', 'officalRecentFolders', 'vipRecentFolders', 'totalFiles', 'totalFolders', 'user_name', 'totalUsedSpace', 'filetypeTotals'));
        }

    }
 
    public function officialUpload(Request $request){
         
        $data['depts'] = Department::where('status', 1)->get();
        
        return view('backend.files.vip_file_upload');
    }
 
    public function storeOfficialDocUpload(Request $request){
          
        $category_id = $request->category_id;
        $user_id = Auth::user()->id;
       // dd($request->all());

        foreach($request->doc_file as $file){
            $fileSizeInBytes = $file->getSize();
            $file_name = $file->getClientOriginalName();
            $only_name = pathinfo($file_name, PATHINFO_FILENAME);
            $file_type = $file->getClientOriginalExtension();

            //file copy for relavent person
            $personal = public_path('uploads/share-docs/') . $user_id;
            if (!file_exists($personal)) {
                mkdir($personal, 0755, true);  
            }
 
            $timestamp = now()->timestamp;
            $folderName = public_path('uploads/') . $user_id;
            if (!file_exists($folderName)) {
                mkdir($folderName, 0755, true); // Ensure that parent directories are created
            }
            $filename_path = $user_id . '/' . $only_name .'_'. $timestamp . '.' . $file_type;
            
            $file->move($folderName, $filename_path);

   
            Document::create([
                'category_id' => $category_id,
                'user_id' => $user_id,
                'title' => $filename_path,
                'file_path' => $filename_path,
                'file_size' => $fileSizeInBytes,
                'filetype' => $file_type,
                'order_number' => $request->order_number,
                'order_date' => $request->order_date,
                'ref_number' => $request->ref_number,
                'ref_date' => $request->ref_date,
                'subject' => $request->subject,
                'department_id' => $request->department_id,
                'relevant_person' => isset($request->relevant_person) ? $request->relevant_person : null,
                'order_type' => $request->order_type,
                'parliament_id' => $request->parliament_id,
                'status' => 'official',
            ]);
   
            if (isset($request->relevant_person) && $request->relevant_person != null && $request->relevant_person != '') {
                ShareDoc::create([
                    'category_id' => $category_id,
                    'user_id' => $request->relevant_person,
                    'title' => $file_name,
                    'file_path' => $filename_path,
                    'file_size' => $fileSizeInBytes,
                    'filetype' => $file_type,
                    'status' => 'active',
                ]);
            }
    
         }
        
        return redirect()->back()->with('success', 'File succsessfully uploaded');
         
    }
 
    public function storeVipOffUpload(Request $request){
        $category_id = $request->category_id;
        $event_name = $request->event_name;
        $user_id = Auth::user()->id;
         
        if($event_name != null){
            $category = new Category();
            $category->user_id = $user_id;
            $category->department_id = 'voff';
            $category->name = $event_name;
            $category->parent_category_id = $category_id? (int) $category_id:1;
            $category->folder_type = 'vip_official';
            $category->save(); 
        }

  
        foreach($request->doc_file as $file){
            $fileSizeInBytes = $file->getSize();
            $file_name = $file->getClientOriginalName();
            $file_type = $file->getClientOriginalExtension();

            if(in_array($file_type, ['jpg', 'jpeg', 'png', 'webp', 'weba', 'svg'])){
                $xtnsion = 'Image';
            }else if(in_array($file_type, ['video', 'audio'])){
                $xtnsion = 'Video';
            }else {
                $xtnsion = 'Document';
            }

            $only_name = pathinfo($file_name, PATHINFO_FILENAME);
            $timestamp = now()->timestamp;
            $random_string = bin2hex(random_bytes(10));
            $folderName = public_path('uploads/') . $user_id. '/' .$xtnsion;

            $filename_path = $only_name .'_'. $timestamp . '.' . $file_type;

            if ($file != null) {
                // mkdir($folderName, 0755, true); // Ensure that parent directories are created
                
			    $file->move($folderName, $filename_path);
            }
 
            $categoryid = $category->id ?? $category_id;

            Document::create([
                'category_id' => $category->id ?? $category_id,
                'parliament_id' => $request->parliament_id,
                'user_id' => $user_id,
                'title' => $filename_path,
                'file_path' => $user_id. '/' .$xtnsion.'/'.$filename_path,
                'file_size' => $fileSizeInBytes,
                'filetype' => $file_type,
                'event_for' => $request->event_for,
                'event_date' => $request->event_date,
                'event_name' => $event_name,
                'event_type' => $request->event_type,
                'event_location' => $request->event_location,
                'status' => 'vip_official',
            ]);

        }
        
        return redirect()->back()->with('success', 'File succsessfully uploaded');
         
    }
 
    public function getOfficialDepts(Request $request){
        $data['depts'] = Department::get();
       
        return view('backend.settings.official_depatrments', $data);
    }
 
    public function manageTypeofOrder(Request $request){
        $data['orderTypes'] = OrderType::get();
       
        return view('backend.settings.order_types', $data);
    }
    
    public function storeOffDeptName(Request $request){
        Department::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '_', strtolower($request->name)),
            'status' => 1,
        ]);
        
        return redirect()->back()->with('success', 'Departments added succsessfully');
    }
    
    public function storeTypeOrder(Request $request){
        OrderType::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '_', strtolower($request->name)),
            'status' => 1,
        ]);
        
        return redirect()->back()->with('success', 'Document type added succsessfully');
    }
    
    public function updateTypeOrder(Request $request){
        OrderType::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => str_replace(' ', '_', strtolower($request->name)),
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('success', 'Document type updated succsessfully');
    }
    
    public function deleteTypeOrder(Request $request, $id){
        OrderType::where('id', $id)->delete();
        
        return redirect()->back()->with('success', 'Document type deleted succsessfully');
    }


    // ==============================
    public function manageVipUserType(Request $request){
        $data['vip_users'] = VipUserType::get();
       
        return view('backend.settings.vip_users', $data);
    } 

    public function storeVipUser(Request $request){
        VipUserType::create([
            'name' => $request->name,
            'slug' => str_replace(' ', '_', strtolower($request->name)),
            'status' => 1,
        ]);
        
        return redirect()->back()->with('success', 'Vip User Type added succsessfully');
    }
    
    public function updateVipUser(Request $request){
        VipUserType::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => str_replace(' ', '_', strtolower($request->name)),
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('success', 'Vip User Type updated succsessfully');
    }
    
    public function deleteVipUser(Request $request, $id){
        VipUserType::where('id', $id)->delete();
        
        return redirect()->back()->with('success', 'Vip User Type deleted succsessfully');
    }

    // ==============================
    
    public function updateDepartment(Request $request){
        Department::where('id', $request->id)->update([
            'name' => $request->name,
            'slug' => str_replace(' ', '_', strtolower($request->name)),
            'status' => $request->status,
        ]);
        
        return redirect()->back()->with('success', 'Department updated succsessfully');
    }
    
    public function deleteDepartment(Request $request, $id){
        Department::where('id', $id)->delete();
        
        return redirect()->back()->with('success', 'Department deleted succsessfully');
    }

    public function searchOffialDoc(Request $request){
        $department_id = $request->department_id;
        $order_type = $request->order_type;
        $parliament_id = $request->parliament_id;
        $order_date = $request->order_date;
        $custom_text = $request->custom_text;

        $selectedCategoryId = $id ?? 1;
        $document = new Document;
        $category = new Category;

        if(isset($department_id)){
            $document = $document->where('department_id', $department_id);
        }
        if(isset($order_type)){
            $document = $document->where('order_type', $order_type);
        }
        if(isset($parliament_id)){
            $document = $document->where('parliament_id', $parliament_id);
        }
        if(isset($order_date)){
            $document = $document->where('order_date', $order_date);
        }

        if(isset($custom_text)){
            $category = $category->where('name', 'like', '%' . $custom_text . '%');
            $document = $document->where('title', 'like', '%' . $custom_text . '%');
        }
         
        $data['folderData'] = $category = $category->get();
        $data['fileData'] = $document = $document->get();
    
        return response()->json($data);

    }
 
    public function officePersonalFiles(Request $request){
        //dd(Auth::user());
        $data['user'] = Auth::user();
         $user_id = Auth::user()->id;
        $data['vipRecentFolders'] = Category::where(['user_id' => $user_id, 'folder_type' => 'personal'])->get();

        $data['sharedFiles'] = ShareDoc::where('user_id', $user_id)->get();
        
        return view('backend.user.my_files', $data);
    }
 
    public function getSearchResults(Request $request){
        $data['user'] = Auth::user();
        
        return view('backend.search.index', $data);
    }
 
    public function getEventById(Request $request){
        $data['user'] = Auth::user();
        
        return view('backend.search.index', $data);
    }
 
 
    public function get_recent_events_ajax(Request $request){
        $sval = $request->val;
        $document = Document::where('status', 'vip_official')->whereNotNull('event_name');
        if($sval == ''){
            $data['documents'] = $document->latest()->get();
        }else{
            $data['documents'] = $document->where('event_name', 'LIKE', '%'.$sval.'%')->get();
        }
         
        return view('backend.accesspage.recent_item', $data);
    }
 
 
    public function get_filesFolderNew_ajax(Request $request){
          
        // offficial vip search
        $event_name = $request->event_name;
        $event_loc = $request->event_loc;
        $event_for = $request->event_for;
        $event_type = $request->event_type;
        $event_date = $request->event_date;
        $searchType = $request->searchType;

        // offficial search
        $order_type = $request->order_type;
        $parliament_id = $request->parliament_id;
        $order_date = $request->order_date;
        $custom_text = $request->custom_text;
        
        $searchData = $request->searchData;
  
        $doc_name =  $custom_text?$custom_text: $event_name;

        $user_dept_id = Auth::user()->department_id;
        $category = '';
        $document = '';

        if($searchData == ''){  //js click event search for vip and official
           
            $document = new Document;
            if(isset($order_type)){
                $document = $document->where('order_type', $order_type);
            }
            if(isset($parliament_id)){
                $document = $document->where('parliament_id', $parliament_id);
            }
            if(isset($order_date)){
                $document = $document->where('order_date', $order_date);
            }
        
            if(isset($doc_name)){
                $category = new Category;
                if($searchType == 'official'){
                    $document = $document->where('title', 'like', '%' . $doc_name . '%')
                    ->orWhere('order_number', 'like', '%' . $doc_name . '%');
                }else{
                    $document = $document->where('title', 'like', '%' . $doc_name . '%');
                }
                $category = $category->where('name', 'like', '%' . $doc_name . '%');
            }
        
            if(isset($event_loc)){
                $document = $document->where('event_location', 'like', '%' . $event_loc . '%');
            }
        
            // if(isset($searchData)){
            //     $category = $category->where('name', 'like', '%' . $searchData . '%');
            //     $document = $document->where('title', 'like', '%' . $searchData . '%');
            // }
            // for vip doc search
            if(isset($event_for)){
                $document = $document->where('event_for', $event_for);
            }
            if(isset($event_type)){
                $document = $document->where('event_type', $event_type);
            }
            if(isset($event_date)){
                $document = $document->whereDate('event_date', '=', $event_date);
            }
         
        }else{
            $category = new Category;
            $document = new Document;
            $category = $category->where('name', 'like', '%' . $searchData . '%');
            $document = $document->where('title', 'like', '%' . $searchData . '%');
        }
         
        if($document->get() != null){
            $document = $document->where('department_id', $user_dept_id); // for own dept data vip and official
            $document->where('status', $searchType);
            $data['fileData'] = $document->get();
        }else{
            $data['fileData'] = [];
        }
 
        if($category != null){
            $category->where('folder_type', $searchType);
            $data['folderData'] = $category->get();
        }else{
            $data['folderData'] = [];
        }
   
        return view('backend.accesspage.file_folder_item', $data);
    }
 
   

}
