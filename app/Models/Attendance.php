<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    //

    protected $connection = 'mongodb';
    protected $collection = 'attendances';

    protected $fillable = [
        'attendance_id',
        'status',
        'student',
        'school_id',
        'subject',
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

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject', '_id');
    }
}
