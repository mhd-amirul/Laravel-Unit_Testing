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

    public function setting()
    {
        $post = Post::factory()->create();
        $user = User::factory()->create();

        $this->actingAs($user);

        return [
            "post" => $post,
            "user" => $user,
            "response" => $this
        ];
    }

    /** @test */
    public function user_can_like_post()
    {
        $data = $this->setting();

        $data["post"]->like();

        $data["response"]->assertDatabaseHas('likes', [
            "user_id" => $data["user"]->id,
            "likeable_id" => $data["post"]->id,
            "likeable_type" => get_class($data["post"])
        ]);

        $data["response"]->assertTrue($data["post"]->isLiked());
    }

    /** @test */
    public function user_can_unlike_post()
    {
        $data = $this->setting();

        $data["post"]->like();
        $data["post"]->unlike();

        $data["response"]->assertDatabaseMissing('likes', [
            "user_id" => $data["user"]->id,
            "likeable_id" => $data["post"]->id,
            "likeable_type" => get_class($data["post"])
        ]);

        $data["response"]->assertFalse($data["post"]->isLiked());
    }

    /** @test */
    public function user_toggle_like_or_unlike_on_post()
    {
        $data = $this->setting();

        $data["post"]->toggle();

        $data["response"]->assertTrue($data["post"]->isLiked());

        $data["post"]->toggle();

        $data["response"]->assertFalse($data["post"]->isLiked());
    }

    /** @test */
    public function count_how_many_like_on_post()
    {
        $data = $this->setting();

        $data["post"]->toggle();

        $data["response"]->assertEquals(1, $data["post"]->getLikesCountAttribute());
    }
}
