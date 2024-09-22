<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class product extends Model
{
    use HasFactory;
    use Sluggable;
    public function Sluggable():array
    {
        return
        [
            'slug'=>
            [
                'source'=>'title'
            ]
            ];
    }
}
