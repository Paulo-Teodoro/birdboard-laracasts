<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    protected function setUp() :void 
    {
        parent::setUp();

        $this->actingAs(User::factory()->create());
    }

    public function test_create_a_project()
    {
        $attributes = Project::factory()->raw([
            'user_id' => auth()->user()->id
        ]);

        $response = $this->postJson('/api/projects', $attributes);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description',
                'user'
            ]
        ]);
        $this->assertDatabaseHas('projects', $attributes);
    }

    public function test_project_require_title()
    {
        $attributes = Project::factory()->raw(['title' => '']);

        $response = $this->postJson('/api/projects', $attributes);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'title'
            ]
        ]);
    }

    public function test_project_require_description()
    {
        $attributes = Project::factory()->raw(['description' => '']);

        $response = $this->postJson('/api/projects', $attributes);

        $response->assertStatus(422);
        $response->assertJsonStructure([
            'errors' => [
                'description'
            ]
        ]);
    }
    
    public function test_show_a_project()
    {
        $project = Project::factory()->create();

        $response = $this->getJson("/api/projects/{$project->id}");

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'title',
                'description'
            ]
        ]);
    }
}
