<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'phone', 'user_id'
    ];

	/**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
