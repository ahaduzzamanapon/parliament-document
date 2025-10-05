<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'description',
        'file_path',
        'file_size',
        'filetype',
        'order_number',
        'order_date',
        'ref_number',
        'ref_date',
        'subject',
        'department_id',
        'relevant_person',
        'order_type',
        'parliament_id',
        'is_lock',
        'lock_code',
        'event_for',
        'event_date',
        'event_name',
        'event_type',
        'event_location',
        'status',
        'created_at',
        'updated_at'
    ];


    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

}
