<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_has_projects() 
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->assertInstanceOf(Collection::class, $user->projects);
    }
}
