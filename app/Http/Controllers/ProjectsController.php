<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function store(StoreProjectRequest $request) 
    {
        $project = auth()->user()->projects()->create($request->all());

        return new ProjectResource($project);
    }

    public function show(Project $project) 
    {
        return new ProjectResource($project);
    }
}
