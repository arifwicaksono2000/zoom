<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkspaceController extends Controller
{
    //
    public function index()
    {
        return response()->json(['message' => 'Workspace index']);
    }

    public function store(Request $request)
    {
        return response()->json(['message' => 'Workspace store', 'data' => $request->all()]);
    }

    public function show($id)
    {
        return response()->json(['message' => 'Workspace show', 'data' => $id]);
    }

    public function update(Request $request, $id)
    {
        return response()->json(['message' => 'Workspace update', 'data' => [$request->all(), $id]]);
    }

    public function destroy($id)
    {
        return response()->json(['message' => 'Workspace destroy', 'data' => $id]);
    }
}
