<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Workspace;
use App\Models\Zoom;
use Illuminate\Support\Facades\Auth;

class WorkspaceController extends Controller
{
    //
    public function index()
    {
        return response()->json(['message' => 'Workspace index']);
    }
    public function getAllLocation()
    {
        $location = Location::get();
        return response()->json(['message' => 'success', 'data' => $location]);
    }
    public function getLocation($location_id)
    {
        try {
            $location = Location::where('location_id', $location_id)->first();
            return response()->json(['message' => 'success', 'data' => $location->toArray()]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Location not found', 'data' => $e->getMessage()], 404);
        }
    }

    public function show($workspace_id)
    {
        try {
            $workspace = Workspace::getWorkspaceByWorkspaceId($workspace_id);
            return response()->json(['message' => 'success', 'data' => $workspace]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Workspace not found', 'data' => $e->getMessage()], 404);
        }
    }
    public function getWorkspaceByLocation($location_id)
    {
        try {
            $workspace = Workspace::getWorkspaceByLocation($location_id);
            return response()->json(['message' => 'success', 'data' => $workspace]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Workspace not found', 'data' => $e->getMessage()], 404);
        }
    }
    public function getAllWorkspace()
    {
        $workspace = Workspace::get();
        return response()->json(['message' => 'success', 'data' => $workspace->toArray()]);
    }
}
