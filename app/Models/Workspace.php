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

        $response = json_decode($zoom, true);

        if (isset($response['reservation_id'])) {
            $dbData = [
                'workspace_id' => $workspace_id,
                'reservation_id' => $response['reservation_id'],
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'topic' => $data['topic'],
                'meeting' => isset($data['meeting']) ? json_encode($data['meeting']) : null,
                'reserve_for' => $data['reserve_for'] ?? null,
                'status' => 'checked_in', // Default status or strictly from response if available? Assuming 'checked_in' based on user request.
            ];
            Reservation::create($dbData);
        }
    }
    public static function updateReservation($data, $workspace_id, $reservation_id)
    {
        $zoom = Zoom::updateReservation($data, $workspace_id, $reservation_id);

        $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        if ($reservation) {
            $updateData = [
                'start_time' => $data['start_time'],
                'end_time' => $data['end_time'],
                'topic' => $data['topic'],
            ];

            // Only update optional fields if they are present in the request
            if (isset($data['reserve_for'])) {
                $updateData['reserve_for'] = $data['reserve_for'];
            }
            if (isset($data['meeting'])) {
                $updateData['meeting'] = json_encode($data['meeting']);
            }

            $reservation->update($updateData);
        }

        return $zoom;
    }
    public static function deleteReservation($workspace_id, $reservation_id)
    {
        $zoom = Zoom::deleteReservation($workspace_id, $reservation_id);

        $reservation = Reservation::where('reservation_id', $reservation_id)->first();
        if ($reservation) {
            $reservation->delete();
        }

        return $zoom;
    }
}
