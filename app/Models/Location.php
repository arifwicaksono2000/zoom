<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'locations';
    protected $fillable = [
        'name',
        'location_id',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function workspaces()
    {
        return $this->hasMany(Workspace::class);
    }
}
