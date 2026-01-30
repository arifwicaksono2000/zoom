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
    public function getAll()
    {
        $location = Location::with('workspaces')->get();
        return response()->json(['message' => 'success', 'data' => $location->toArray()]);
    }
    public function getByLocation($location_id)
    {
        $location = Location::with('workspaces')->find($location_id);
        return response()->json(['message' => 'success', 'data' => $location->toArray()]);
    }

    public function store(Request $request)
    {
        $workspace = new Workspace();
        $workspace->workspace_name = $request->workspace_name;
        $workspace->workspace_id = $request->workspace_id;
        $workspace->workspace_display_name = $request->workspace_display_name;
        $workspace->location_id = $request->location_id;
        $workspace->save();
        return response()->json(['message' => 'success', 'data' => $workspace->toArray()]);
    }

    public function show($id)
    {
        $workspace = Workspace::with('location')->where('workspace_id', $id)->first();
        return response()->json(['message' => 'success', 'data' => $workspace->toArray()]);
    }

    public function update(Request $request, $id)
    {
        $workspace = Workspace::where('workspace_id', $id)->first();
        $workspace->workspace_name = $request->workspace_name;
        $workspace->workspace_id = $request->workspace_id;
        $workspace->workspace_display_name = $request->workspace_display_name;
        $workspace->location_id = $request->location_id;
        $workspace->save();
        return response()->json(['message' => 'success', 'data' => $workspace->toArray()]);
    }

    public function destroy($id)
    {
        $workspace = Workspace::where('workspace_id', $id)->first();
        $workspace->delete();
        return response()->json(['message' => 'success', 'data' => $workspace->toArray()]);
    }
}
