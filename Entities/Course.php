<?php

namespace Modules\Course\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Account\Entities\User;
use Modules\Base\Entities\Comment;
use Modules\Base\Entities\Visit;

class Course extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comment()
    {
        return $this->morphMany(Comment::class, 'comments')->where('status', 1)->whereNull('parent_id');
    }

    public function visits() {
        return $this->morphMany(Visit::class, 'visits');
    }

    protected static function newFactory()
    {
        return \Modules\Course\Database\factories\CourseFactory::new();
    }
}
