<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'announcements';

    protected $fillable = [
        'announcement_id',
        'school_id',
        'announcement',
        'createdAt',
        'updatedAt',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }
}
