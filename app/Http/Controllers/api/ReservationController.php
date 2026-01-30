<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index()
    {
        return response()->json(['message' => 'Reservation index']);
    }
    public function store(Request $request)
    {
        try {
            $request->validate([
                'workspace_id' => 'required',
                'topic' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
            $data = [
                'topic' => $request->topic,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];
            if ($request->meeting) {
                $request->validate([
                    'meeting.end_to_end_encrypted' => 'boolean',
                    'meeting.password' => 'string',
                    'meeting.waiting_room' => 'boolean',
                    'meeting.meeting_uuid' => 'string',
                ]);
                $data['meeting'] = $request->meeting;
            }
            if ($request->reserve_for) {
                $request->validate([
                    'reserve_for' => 'string',
                ]);
                $data['reserve_for'] = $request->reserve_for;
            }
            $reservation = Workspace::createReservation($data, $request->workspace_id);
            return response()->json(['message' => 'Reservation created', 'data' => $reservation]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation failed', 'data' => $e->getMessage()], 500);
        }
    }
    public function show($workspace_id, $reservation_id)
    {
        try {
            $reservation = Workspace::getReservationbyReservationId($workspace_id, $reservation_id);
            return response()->json(['message' => 'Reservation found', 'data' => $reservation]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation not found', 'data' => $e->getMessage()], 500);
        }
    }
    public function update(Request $request)
    {
        try {
            $request->validate([
                'workspace_id' => 'required',
                'reservation_id' => 'required',
                'topic' => 'required',
                'start_time' => 'required',
                'end_time' => 'required',
            ]);
            $data = [
                'topic' => $request->topic,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];
            // if ($request->meeting) {
            //     $request->validate([
            //         'meeting.end_to_end_encrypted' => 'boolean',
            //         'meeting.password' => 'string',
            //         'meeting.waiting_room' => 'boolean',
            //         'meeting.meeting_uuid' => 'string',
            //     ]);
            //     $data['meeting'] = $request->meeting;
            // }
            // if ($request->reserve_for) {
            //     $request->validate([
            //         'reserve_for' => 'string',
            //     ]);
            //     $data['reserve_for'] = $request->reserve_for;
            // }
            $reservation = Workspace::updateReservation($data, $request->workspace_id, $request->reservation_id);
            return response()->json(['message' => 'Reservation updated', 'data' => $reservation]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation failed', 'data' => $e->getMessage()], 500);
        }
    }
    public function destroy(Request $request)
    {
        // dd($request->all());
        try {
            $reservation = Workspace::deleteReservation($request->workspace_id, $request->reservation_id);
            return response()->json(['message' => 'Reservation deleted', 'data' => $reservation]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation failed', 'data' => $e->getMessage()], 500);
        }
    }
}
