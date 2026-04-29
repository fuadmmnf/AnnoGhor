<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Headline extends Model
{
    // Shudhu ei field-ti mass assignment er jonno allow kora holo
    protected $fillable = ['title']; 
}