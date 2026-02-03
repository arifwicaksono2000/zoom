<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reservation extends Model
{
    use SoftDeletes;
    
    //
    protected $table = 'reservations';
    protected $fillable = [
        'reservation_id',
        'workspace_id',
        'reserve_for',
        'start_time',
        'end_time',
        'topic',
        'meeting',
    ];
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
    public static function create(array $data)
    {
        return self::create($data);
    }
}
