<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'status'
    ];


    public function categories(){
        return $this->hasMany(Category::class, 'department_id', 'id');
    }


    public function department(){
        return $this->belongsTo(Department::class, 'department_id');
    } 


}
