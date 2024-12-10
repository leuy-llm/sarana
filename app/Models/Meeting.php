<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','availability'];

    public function images()
{
    return $this->hasMany(MeetingImage::class, 'meeting_id');
}


}
