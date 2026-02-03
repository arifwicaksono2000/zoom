<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Workspace;
use Illuminate\Http\Request;

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
        $location = Location::where('location_id', $location_id)->first();
        return response()->json(['message' => 'success', 'data' => $location->toArray()]);
    }

    public function show($workspace_id)
    {
        $workspace = Workspace::getWorkspaceByWorkspaceId($workspace_id);
        return response()->json(['message' => 'success', 'data' => $workspace]);
    }
    public function getWorkspaceByLocation($location_id)
    {
        $workspace = Workspace::getWorkspaceByLocation($location_id);
        return response()->json(['message' => 'success', 'data' => $workspace]);
    }
    public function getAllWorkspace()
    {
        $workspace = Workspace::get();
        return response()->json(['message' => 'success', 'data' => $workspace->toArray()]);
    }
}
