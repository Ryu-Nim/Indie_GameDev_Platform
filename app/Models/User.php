<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /** 
     * Role constants
     */
    const ROLE_USER = 1;
    const ROLE_DEVELOPER = 2;

    /** 
     * Mass assignable attributes
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'role',
        'photo',
    ];

    /** 
     * Determine if the user is a developer
     */
    public function isDeveloper()
    {
        return $this->role === self::ROLE_DEVELOPER;
    }

    /** 
     * Hidden attributes
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /** 
     * Attribute casting
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}