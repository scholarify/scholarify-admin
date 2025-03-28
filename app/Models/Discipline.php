<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'disciplines';

    protected $fillable = [
        'discipline_id',
        'comments',
        'student',
        'school_id',
        'createdAt',
        'updatedAt',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student', '_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }
}
