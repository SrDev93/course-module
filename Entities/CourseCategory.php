<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function parent()
    {
        return $this->hasOne(CourseCategory::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(CourseCategory::class, 'parent_id')->with('children');
    }

    public function courses() {
        return $this->hasMany(Course::class, 'category_id', 'id');
    }

    protected static function newFactory()
    {
        return \Modules\Course\Database\factories\CourseCategoryFactory::new();
    }
}
