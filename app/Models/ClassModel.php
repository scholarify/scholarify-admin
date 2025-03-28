<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'classes';

    protected $fillable = [
        'class_id',
        'school_id',
        'name',
        'level',
        'createdAt',
        'updatedAt',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id', '_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class, 'class_id', '_id');
    }
}
