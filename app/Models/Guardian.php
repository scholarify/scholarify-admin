<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'guardians';

    protected $fillable = [
        'guardian_id',
        'name',
        'email',
        'phone',
        'address',
        'createdAt',
        'updatedAt',
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class, null, 'guardian_id', '_id');
    }
}
