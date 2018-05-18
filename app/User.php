<?php

namespace App;

use Illuminate\Support\Facades\Cache;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{


    public $user = 'user';


    public $fillable = [
        'name',
        'email',
        'role',
        'created_at',
        'updated_at',
        'password',
        'status'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'email' => 'string',
        'role' => 'string',
        'created_at' => 'date',
        'updated_at' => 'date',
        'status' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required|string',
        'email' => 'required|email',
//        'role' => 'required',
//        'created_at' => 'required',
//        'updated_at' => 'required'
    ];


    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function posts()

    {

        return $this->hasMany(Post::class);

    }


    public function publish(Post $post)

    {

        $this->posts()->save($post);

    }


    public function publishComment(Comment $comment)
    {

        $this->comment()->save($comment);

    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }


}
