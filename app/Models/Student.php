<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'students';

    protected $fillable = [
        'student_id',
        'guardian_id',
        'school_id',
        'name',
        'date_of_birth',
        'fees',
        'class_id',
        'age',
        'gender',
        'enrollement_date',
        'status',
        'non_compulsory_sbj',
        'createdAt',
        'updatedAt',
    ];

    protected $casts = [
        'guardian_id' => 'array',
        'non_compulsory_sbj' => 'array',
    ];

    public function guardians()
    {
        return $this->belongsToMany(Guardian::class, null, '_id', 'guardian_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }

    public function class()
    {
        return $this->belongsTo(ClassModel::class, 'class_id', '_id');
    }

    public function nonCompulsorySubjects()
    {
        return $this->belongsToMany(Subject::class, null, '_id', 'non_compulsory_sbj');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'student', '_id');
    }

    public function disciplines()
    {
        return $this->hasMany(Discipline::class, 'student', '_id');
    }

    public function grades()
    {
        return $this->hasMany(Grade::class, 'student_id', '_id');
    }
}
