<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'grades';

    protected $fillable = [
        'school_id',
        'subject_id',
        'student_id',
        'exam_type',
        'term',
        'academic_year',
        'grade',
        'score',
        'comments',
        'createdAt',
        'updatedAt',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', '_id');
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', '_id');
    }
}
