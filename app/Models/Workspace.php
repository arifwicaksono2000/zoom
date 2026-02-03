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
    public static function getWorkspaceReservations($workspace_id, $from, $to)
    {
        $zoom = Zoom::getWorkspaceReservations($workspace_id, $from, $to);
        $response = json_decode($zoom, true);
        return $response;
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
    public static function getWorkspaceByLocation($location_id)
    {
        $workspaces = Zoom::listWorkspacebyLocation($location_id);
        $data = [];
        foreach ($workspaces as $value) {
            $data[] = [
                'workspace_id' => $value['id'],
                'workspace_name' => $value['workspace_name'],
                'location_id' => $value['location_id'],
            ];
        }
        return $data;
    }
    public static function getWorkspaceByWorkspaceId($workspace_id)
    {
        $workspace = Zoom::getWorkspaceByWorkspaceId($workspace_id);
        $data = [];
        $data['workspace_id'] = $workspace['id'];
        $data['workspace_name'] = $workspace['workspace_name'];
        $data['workspace_display_name'] = $workspace['workspace_display_name'];
        $data['location_id'] = $workspace['location_id'];
        return $data;
    }
    public static function getAllWorkspace()
    {
        $workspace = Workspace::get();
        return $workspace;
    }
}
