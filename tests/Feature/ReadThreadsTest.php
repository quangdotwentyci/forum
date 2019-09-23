<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * @property mixed thread
 */
class ReadThreadsTest extends TestCase
{
    use DatabaseMigrations;

    /**
     *
     */
    public function setUp() :void
    {
        parent::setUp();
        $this->thread = factory(Thread::class)->create();
    }
    /**
     * @test
     */
    public function a_user_can_view_all_threads()
    {

        $response = $this->get('/thread')
            ->assertSee($this->thread->title);
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

    /** @test */
    function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get('/thread/' . $this->thread->id)
            ->assertSee($reply->body);
    }

}
