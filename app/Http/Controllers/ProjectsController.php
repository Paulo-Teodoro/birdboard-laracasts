<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Resources\ProjectResource;
use App\Models\Project;

class ProjectsController extends Controller
{
    public function store(StoreProjectRequest $request) 
    {
        return new ProjectResource(Project::create($request->all()));
    }
}
