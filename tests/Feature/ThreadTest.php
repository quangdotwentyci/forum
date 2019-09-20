<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_user_can_view_all_threads()
    {
        $thread = factory(Thread::class)->create();
        $response = $this->get('/thread')
            ->assertSee($thread->title);
    }

    /** @test */
    function a_user_can_read_a_single_thread()
    {
        $thread = factory('App\Thread')->create();

        $response = $this->get('/thread/' . $thread->id);
        $response->assertSee($thread->title);
    }

    /**
     * @test
     */
    public function a_user_can_browse_threads()
    {
        $user = factory(User::class)->create();
        $response = $this->actingAs($user)->get('/thread');

        $response->assertStatus(200);
    }
}
