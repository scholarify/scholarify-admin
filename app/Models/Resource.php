<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'resources';

    protected $fillable = [
        'resource_id',
        'school_id',
        'name',
        'resource_type',
        'link',
        'createdAt',
        'updatedAt',
    ];

    public function school()
    {
        return $this->belongsTo(School::class, 'school_id', '_id');
    }
}
