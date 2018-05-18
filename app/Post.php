<?php

namespace App;

use Carbon\Carbon;

class Post extends Model
{

    public $fillable = [
        'title',
        'body',
        'status',
        'user_id'
    ];


    public static $rules = [
        'title' => 'required|string|max:250',
        'body' => 'required|string|max:5000',
        'status' => 'string'

    ];


    protected $casts = [
        'title' => 'string',
        'body' => 'text',
        'status' => 'string',
        'created_at' => 'date',
        'updated_at' => 'date'
    ];


    public function comments()
    {

        return $this->hasMany(Comment::class);

    }


    public function user()
    {

        return $this->belongsTo(User::class);

    }


    public function addComment($body)
    {

        $this->comments()->create(compact('body'));

    }


    public static function allPosts()
    {
        return Post::all();
    }

    public static function allActivePosts()
    {
        return Post::where('status', 'A-activated')
            ->orWhere('status', 'U-activated')->get();
    }

    public static function allDeactivePosts()
    {

        return Post::where('status', 'A-deactivated')
            ->orWhere('status', 'U-deactivated')
            ->orWhere('status', 'A-D-deactivated')
            ->orWhere('status', 'U-D-deactivated')->get();
    }

    public static function allWaitingPosts()
    {
        return Post::all()->where('status', 'waiting');
    }

    public static function allUpdatedPosts()
    {
        return Post::all()->where('status', 'U-updated');
    }


    public function scopeFilter($query, $filters)
    {

        if (isset($filters['month'])) {
            if ($month = $filters['month']) {
                $query->whereMonth('created_at', Carbon::parse($month)->month);
            }
        }
        if (isset($filters['year'])) {
            if ($year = $filters['year']) {
                $query->whereYear('created_at', $year);
            }
        }

    }

}
