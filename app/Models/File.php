<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slugName',
        'sizeInBytes',
        'sizeFormatted',
        'extension',
        'type',
        'width',
        'height',
        'dimension',
        'userId',
        'starred',
    ];
    public function user()
    {
        return $this->belongsTo('App\Models\User::class');
    }
}
