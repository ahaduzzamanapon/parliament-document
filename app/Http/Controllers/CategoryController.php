<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Category;
use App\Models\Document;
use Illuminate\Support\Facades\Auth;


class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
      
    }
    // Store a newly created category in the database
    public function store(Request $request)
    {

        $pcid = $request->input('parent_category_id');
        
        if($pcid != null){
            $ft1 = Category::where('id', $pcid)->first();
            $folder_type = $ft1->folder_type ?? '';
            if($folder_type == null){
                $ft2 = Category::where('id', $ft1->parent_category_id?? '')->first();
                $folder_type = $ft2->folder_type ?? '';
            }

            if($folder_type == null){
                $ft3 = Category::where('id', $ft2->parent_category_id?? '')->first();
                $folder_type = $ft3->folder_type ?? '';
            }

            if($folder_type == null){
                $ft4 = Category::where('id', $ft3->parent_category_id?? '')->first();
                $folder_type = $ft4->folder_type ?? '';
            }
        }
   
        $category = new Category();
        $category->user_id = Auth::user()->id;
        $category->name = $request->input('name');
        $category->department_id = $request->input('dept_id')?? $request->input('office_type');
        $category->parent_category_id = $pcid ?? 1;
        $category->folder_type = $request->input('folder_type') ?? $folder_type;
        $category->save(); 

        $message = __('messages.folder') . $request->input('name').' '. __('messages.create').' '.__('messages.successfully');
        
        return response()->json(['success' => $message], 200);
    }
    public function rename(Request $request)
    {
        if ($request->datatype=='file') {
            $Document = Document::find($request->cat_id);
            $Document->title = $request->name.'.'.$Document->filetype;
            $Document->update();
            $message = __('messages.file') .  ' ' . __('messages.Rename') . ' ' . __('messages.successfully');
        }else{
        $category = Category::find($request->cat_id);
        $category->name = $request->name;
        $category->update();
        $message = __('messages.folder').' ' . __('messages.Rename') . ' ' . __('messages.successfully');
        }
        return response()->json(['success' => $message], 200);
    }
    public function download_file(Request $request){
        $Document = Document::find($request->id);
        return response()->json($Document, 200);
    }
}
