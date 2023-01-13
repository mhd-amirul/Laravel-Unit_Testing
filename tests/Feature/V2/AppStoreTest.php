<?php

namespace Tests\Feature\V2;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AppStoreTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_like_post()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $post->like();

        $this->assertDatabaseHas('likes', [
            "user_id" => $user->id,
            "likeable_id" => $post->id,
            "likeable_type" => get_class($post)
        ]);

        $this->assertTrue($post->isLiked());
    }

    /** @test */
    public function user_can_unlike_post()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $post->like();
        $post->unlike();

        $this->assertDatabaseMissing('likes', [
            "user_id" => $user->id,
            "likeable_id" => $post->id,
            "likeable_type" => get_class($post)
        ]);

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function user_toggle_like_or_unlike_on_post()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertTrue($post->isLiked());

        $post->toggle();

        $this->assertFalse($post->isLiked());
    }

    /** @test */
    public function count_how_many_like_on_post()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        $post->toggle();

        $this->assertEquals(1, $post->getLikesCountAttribute());
    }
}
