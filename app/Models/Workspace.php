<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Workspace extends Model
{
    protected $table = 'workspaces';
    protected $fillable = [
        'workspace_name',
        'workspace_id',
        'workspace_display_name',
        'location_id',
    ];
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function getWorkspaceReservations($from, $to)
    {
        $zoom = Zoom::getWorkspaceReservations($this->workspace_id, $from, $to);
        return $zoom;
    }
    public static function getReservationbyReservationId($workspace_id, $reservation_id)
    {
        $zoom = Zoom::getReservationbyReservationId($workspace_id, $reservation_id);
        return $zoom;
    }
    public static function createReservation($data, $workspace_id)
    {
        $zoom = Zoom::createReservation($data, $workspace_id);
        return $zoom;
        $data['reservation_id'] = $zoom['reservation_id'];
        $reservation = Reservation::create($data);
        return $reservation;
    }
    public static function updateReservation($data, $workspace_id, $reservation_id)
    {
        $zoom = Zoom::updateReservation($data, $workspace_id, $reservation_id);
        // $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        // $reservation->update($data);
        return $zoom;
    }
    public static function deleteReservation($workspace_id, $reservation_id)
    {
        $zoom = Zoom::deleteReservation($workspace_id, $reservation_id);
        // $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        // $reservation->delete();
        return $zoom;
    }
}
