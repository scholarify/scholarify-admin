<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'subjects';

    protected $fillable = [
        'subject_id',
        'subject_code',
        'compulsory',
        'school_id',
        'teacher_id',
        'class_id',
        'name',
        'description',
        'coefficient',
        'department',
        'schedule',
        'createdAt',
        'updatedAt',
    ];

    protected $casts = [
        'schedule' => 'array',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'teacher_id', '_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', '_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'subject_id', '_id');
    }

    public function students()
    {
        return $this->belongsToMany(Student::class, null, 'non_compulsory_sbj', '_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'subject', '_id');
    }
}
