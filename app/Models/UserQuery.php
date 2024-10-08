<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserQuery extends Model
{

    use HasFactory;

    static public function getUserQuery()
    {
        $return  = self::select('user_queries.*')
            ->where('seen', '=', 0);

        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }
}
