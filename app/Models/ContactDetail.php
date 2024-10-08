<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDetail extends Model
{

    use HasFactory;
    protected $fillable = [
        'address',
        'gmap',
        'pn1',
        'pn2',
        'pn3',
        'email',
        'fb',
        'insta',
        'tele',
        'tripa',
        'iframe',
    ];
}
