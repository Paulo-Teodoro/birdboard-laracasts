<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function index()
    {
        return ProjectResource::collection(Project::paginate());
    }

    public function store(StoreProjectRequest $request) 
    {
        $project = auth()->user()->projects()->create($request->all());

        return new ProjectResource($project);
    }

    public function show(int $id) 
    {
        $project = Project::findOrFail($id);
        
        return new ProjectResource($project);
    }
}
