<?php

namespace Tests\Unit;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_belongs_to_a_user() 
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(User::class, $project->user);
    }
}
