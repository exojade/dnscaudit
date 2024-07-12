<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Directory extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function files()
    {
        return $this->hasMany(File::class);
    }

    public function parent()
    {
        return $this->belongsTo(Directory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Directory::class, 'parent_id');
    }

    public function parents()
    {
        $parents = [$this];
        if(!empty($this->parent)) {
            $parents = array_merge($parents, $this->getParentDirectory($this->parent));
        }
        return $parents;
    }

    private function getParentDirectory($directory)
    {
        $parents = [$directory];
        if($directory->parent) {
            $parents = array_merge($parents, $this->getParentDirectory($directory->parent));
        }

        return $parents;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function fullPath()
    {
        $root = collect($this->getParentDirectory($this))->pluck('name')->toArray();
        krsort($root);
        return implode(' > ', $root);
    }
}
