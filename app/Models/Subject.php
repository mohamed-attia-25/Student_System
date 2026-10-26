<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
                'name', 'code', 'description',
                'created_by_id', 'created_by_name', 'created_by_email', 'created_by_role',
                'updated_by_id', 'updated_by_name', 'updated_by_email', 'updated_by_role',
            ];
}
