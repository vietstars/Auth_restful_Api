<?php

namespace App;

use App\Contact;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','activated'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * casts
     * 
     */
    protected $casts = [
        'activated' => 'boolean'
    ];

    /**
     * contact
     * @return [type] [description]
     */
    public function contact()
    {
        return $this->hasMany(Contact::class);
    }
}
