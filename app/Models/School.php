<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'schools';

    protected $fillable = [
        'school_id',
        'name',
        'address',
        'website',
        'phone_number',
        'established_year',
        'principal_name',
        'createdAt',
        'updatedAt',
    ];

    public function announcements()
    {
        return $this->hasMany(Announcement::class, 'school_id', '_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'school_id', '_id');
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class, 'school_id', '_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'school_id', '_id');
    }

    public function resources()
    {
        return $this->hasMany(Resource::class, 'school_id', '_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'school_id', '_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'school_id', '_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, null, 'school_ids', '_id');
    }
}
