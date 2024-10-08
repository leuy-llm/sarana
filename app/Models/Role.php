<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    public static function getRole()
    {
        $return  = self::select('roles.*')
            ->where('is_deleted', '=', 0);

        $return = $return->orderBy('id', 'desc')->get();
        return $return;
    }
}
