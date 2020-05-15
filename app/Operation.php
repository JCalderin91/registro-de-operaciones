<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operation extends Model
{
    protected $fillable = ['description', 'mount', 'type', 'date', 'status'];
}
