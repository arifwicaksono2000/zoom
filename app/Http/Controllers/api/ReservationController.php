<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;
use Carbon\Carbon;

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

            $validationError = $this->validateReservationTime($request->start_time, $request->end_time);
            if ($validationError) {
                return response()->json($validationError, 422);
            }

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
            $response = json_decode($reservation, true);
            if (isset($response['code']) && $response['code'] >= 300) {
                return response()->json(['message' => 'Reservation failed', 'data' => $response], 400);
            }

            return response()->json([
                // 'response' => $response,
                'reservation_id' => $response['reservation_id'], // Note: User requested extra space in key
                'status' => $response['reservation_id']
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation failed', 'data' => $e->getMessage()], 500);
        }
    }
    public function show($workspace_id, $reservation_id)
    {
        try {
            $reservation = Workspace::getReservationbyReservationId($workspace_id, $reservation_id);
            $response = json_decode($reservation, true);
            if (isset($response['code']) && $response['code'] >= 300) {
                return response()->json(['message' => 'Reservation not found', 'data' => $response], 404);
            }
            return response()->json(['message' => 'Reservation found', 'data' => $response['result']]);
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

            $validationError = $this->validateReservationTime($request->start_time, $request->end_time);
            if ($validationError) {
                return response()->json($validationError, 422);
            }

            $data = [
                'topic' => $request->topic,
                'start_time' => $request->start_time,
                'end_time' => $request->end_time,
            ];
            $reservation = Workspace::updateReservation($data, $request->workspace_id, $request->reservation_id);
            $response = json_decode($reservation, true);
            if (isset($response['code']) && $response['code'] >= 300) {
                return response()->json(['message' => 'Reservation failed', 'data' => $response], 400);
            }
            return response()->json(['message' => 'Reservation updated', 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation failed', 'data' => $e->getMessage()], 500);
        }
    }

    public function destroy(Request $request)
    {
        try {
            $reservation = Workspace::deleteReservation($request->workspace_id, $request->reservation_id);
            $response = json_decode($reservation, true);
            if (isset($response['code']) && $response['code'] >= 300) {
                return response()->json(['message' => 'Reservation failed', 'data' => $response], 400);
            }
            return response()->json(['message' => 'Reservation deleted', 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation failed', 'data' => $e->getMessage()], 500);
        }
    }

    private function validateReservationTime($startTime, $endTime)
    {
        $start = Carbon::parse($startTime);
        $end = Carbon::parse($endTime);

        if ($start->minute % 15 !== 0) {
            return ['message' => 'Start time must align with 15-minute increments (e.g., :00, :15, :30, :45).'];
        }

        if ($end->minute % 15 !== 0) {
            return ['message' => 'End time must align with 15-minute increments (e.g., :00, :15, :30, :45).'];
        }

        if ($start->diffInMinutes($end) < 15) {
            return ['message' => 'Reservation must be at least 15 minutes long.'];
        }

        return null;
    }

    public function getWorkspaceReservations($workspace_id, Request $request)
    {
        try {
            $request->validate([
                'from' => 'required',
                'to' => 'required',
            ]);
            if (strtotime($request->from) > strtotime($request->to)) {
                return response()->json(['message' => 'Invalid date range'], 400);
            }
            $response = Workspace::getWorkspaceReservations($workspace_id, $request->from, $request->to);
            // $response = json_decode($reservation, true);
            if (isset($response['code']) && $response['code'] >= 300) {
                return response()->json(['message' => 'Reservation not found', 'data' => $response], 404);
            }
            return response()->json(['message' => 'Reservation found', 'data' => $response]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Reservation not found', 'data' => $e->getMessage()], 500);
        }
    }
}
