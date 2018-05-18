<?php

namespace App;

class Comment extends Model
{
    public $fillable = [
        'body',
        'status',
        'post_id',
        'user_id'
    ];


    public static $rules = [
        'body' => 'required|string|max:5000',
        'status' => 'string'

    ];


    protected $casts = [
        'body' => 'text',
        'status' => 'string',
        'created_at' => 'date',
        'updated_at' => 'date'
    ];

	public function post()
	{

		return $this->belongsTo(Post::class);
	
	}





	public function user()
	{

		return $this->belongsTo(User::class);
	
	}

    public static function allComments()
    {
        return Comment::all();
    }
    public static function allActiveComments()
    {
        return Comment::where('status', 'A-activated')
            ->orWhere('status', 'U-activated')->get();
    }
    public static function allDeactiveComments()
    {
        return Comment::where('status', 'A-deactivated')
            ->orWhere('status', 'U-deactivated')
            ->orWhere('status', 'A-D-deactivated')
            ->orWhere('status', 'U-D-deactivated')->get();
    }
    public static function allWaitingComments()
    {
        return Comment::all()->where('status','waiting');
    }
    public static function allUpdatedComments()
    {
        return Comment::all()->where('status','U-updated');
    }

}
