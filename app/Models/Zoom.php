<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zoom extends Model
{
    //
    private static function login()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_OAUTH_URL'),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'grant_type=account_credentials&account_id=' . env('ZOOM_ACCOUNT_ID'),
            CURLOPT_HTTPHEADER => array(
                'Host: zoom.us',
                'Authorization: Basic ' . base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET')),
                'Content-Type: application/x-www-form-urlencoded',
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        // logger()->info('Zoom login', [
        //     'url' => env('ZOOM_OAUTH_URL'),
        //     'client_id' => env('ZOOM_CLIENT_ID'),
        //     'client_secret' => env('ZOOM_CLIENT_SECRET'),
        //     'account_id' => env('ZOOM_ACCOUNT_ID'),
        //     'Authorization' => 'Basic ' . base64_encode(env('ZOOM_CLIENT_ID') . ':' . env('ZOOM_CLIENT_SECRET')),
        //     'response' => $response,
        // ]);
        return $response;
    }
    public static function createReservation($data, $workspace_id)
    {
        $response = self::apiCreateReservation($data, $workspace_id);
        return $response;
    }
    public static function updateReservation($data, $workspace_id, $reservation_id)
    {
        $response = self::apiUpdateReservation($data, $workspace_id, $reservation_id);
        return $response;
    }
    public static function deleteReservation($workspace_id, $reservation_id)
    {
        $response = self::apiDeleteReservation($workspace_id, $reservation_id);
        return $response;
    }
    public static function getWorkspaceReservations($workspace_id, $from, $to)
    {
        $response = self::apiGetWorkspaceReservations($workspace_id, $from, $to);
        return $response;
    }
    public static function getReservationbyReservationId($workspace_id, $reservation_id)
    {
        $response = self::apiGetReservationbyReservationId($workspace_id, $reservation_id);
        return $response;
    }
    public static function listWorkspacebyLocation($location_id)
    {
        $response = self::apiGetWorkspacebyLocation($location_id);
        $data = json_decode($response, true);
        return $data['workspaces'];
    }
    public static function getWorkspaceByWorkspaceId($workspace_id)
    {
        $response = self::apiGetWorkspaceByWorkspaceId($workspace_id);
        $data = json_decode($response, true);
        return $data;
    }

    private static function apiCreateReservation($data, $workspace_id)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces/' . $workspace_id . '/reservations?check_in=false',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            //zoom meet not set
            //             '{
            // //   "end_time": "2026-01-29T07:30:00Z",
            // //   "start_time": "2026-01-29T07:00:00Z",
            // //   "topic": "Testing API Zoom Reservation2",
            // //   "meeting": {
            // //   },
            // //   "reserve_for": ""
            // }',
            // zoom meet & reserve for uuid set
            //             {
            //   "end_time": "2021-03-18T05:41:36Z",
            //   "start_time": "2021-03-18T05:41:36Z",
            //   "topic": "My Personal Meeting Room",
            //   "meeting": {
            //     "end_to_end_encrypted": true,
            //     "password": "9832583261",
            //     "waiting_room": true,
            //     "meeting_uuid": "aDYlohsHRtCd4ii1uC2+hA=="
            //   },
            //   "reserve_for": "KDcuGIm1QgePTO8WbOqwIQ"
            // }
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    private static function apiGetWorkspaceReservations($workspace_id, $from, $to)
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces/' . $workspace_id . '/reservations?from=' . $from . '&to=' . $to,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private static function apiGetReservationbyReservationId($workspace_id, $reservation_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces/' . $workspace_id . '/reservations/' . $reservation_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private static function apiUpdateReservation($data, $workspace_id, $reservation_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces/' . $workspace_id . '/reservations/' . $reservation_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PATCH',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private static function apiDeleteReservation($workspace_id, $reservation_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces/' . $workspace_id . '/reservations/' . $reservation_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'DELETE',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private static function apiGetWorkspacebyLocation($location_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces?location_id=' . $location_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private static function apiGetWorkspaceByWorkspaceId($workspace_id)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => env('ZOOM_API_URL') . '/workspaces/' . $workspace_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Authorization: Bearer ' . self::checkToken(),
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    private static function checkToken()
    {
        $now = now();
        if (!session('zoom_token')) {
            $newtoken = json_decode(self::login());
            $ztoken = (object) array('access_token' => $newtoken->access_token, 'expires_at' => $now->addSeconds($newtoken->expires_in));
            session(['zoom_token' => $ztoken]);
        }
        $ztoken = session('zoom_token');
        if ($ztoken->expires_at < $now) {
            $newtoken = json_decode(self::login());
            $ztoken = (object) array('access_token' => $newtoken->access_token, 'expires_at' => $now->addSeconds($newtoken->expires_in));
            session(['zoom_token' => $ztoken]);
        }
        return $ztoken->access_token;
    }
}
