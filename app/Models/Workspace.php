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
    public function getReservationbyReservationId($reservation_id)
    {
        $zoom = Zoom::getReservationbyReservationId($this->workspace_id, $reservation_id);
        return $zoom;
    }
    public function createReservation($data)
    {
        $zoom = Zoom::createReservation($data, $this->workspace_id, $data['reserve_for']);
        $data['reservation_id'] = $zoom['reservation_id'];
        $reservation = Reservation::create($data);
        return $reservation;
    }
    public function updateReservation($data, $id)
    {
        Zoom::updateReservation($data, $this->workspace_id, $id);
        $reservation = Reservation::where('reservation_id', $id)->first();
        $reservation->update($data);
        return $reservation;
    }
    public function deleteReservation($id)
    {
        Zoom::deleteReservation($this->workspace_id, $id);
        $reservation = Reservation::where('reservation_id', $id)->first();
        $reservation->delete();
        return $reservation;
    }
}
