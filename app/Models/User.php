<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;

class User extends Authenticatable
{

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;



    protected $connection = 'mongodb';
    protected $collection = 'users';

    protected $fillable = [
        'user_id',
        'name',
        'role',
        'email',
        'password',
        'firebaseUid',
        'phone',
        'address',
        'school_ids',
        'createdAt',
        'updatedAt',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        // 'school_ids' => 'array',
        'createdAt' => 'datetime',
        'updatedAt' => 'datetime',
    ];

    public function schools()
    {
        return $this->belongsToMany(School::class, null, '_id', 'school_ids');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'userId', '_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'teacher_id', '_id');
    }

    static public function generateId(): string
    {
        return Str::uuid()->toString();
    }

    public function canAccessFilament(): bool
    {
        // return $this->role === 'admin';
        return true;
    }
}
