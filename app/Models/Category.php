<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = [
        'id', 'name', 'parent_id','status'
    ];

    public function parent()
    {
        return $this->belongsTo('App\Models\Category','parent_id')->where('parent_id',0);
    }

    public function children()
    {
        return $this->hasMany('App\Models\Category','parent_id');
    }
    public function childrenRecursive() {
        return $this->childs()->with('childrenRecursive');
    }

}
