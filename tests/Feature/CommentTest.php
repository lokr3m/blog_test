<?php

use App\Models\Post;
use App\Models\User;

test('authenticated users can create comments', function () {
    $postOwner = User::factory()->create();
    $commenter = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $postOwner->id]);

    $response = $this->actingAs($commenter)->post(route('comments.store', absolute: false), [
        'body' => 'Great post!',
        'post_id' => $post->id,
    ]);

    $response->assertRedirect(route('post', $post, absolute: false));
    $this->assertDatabaseHas('comments', [
        'body' => 'Great post!',
        'post_id' => $post->id,
        'user_id' => $commenter->id,
    ]);
});

test('post detail shows comment count and content', function () {
    $postOwner = User::factory()->create();
    $commenter = User::factory()->create();
    $post = Post::factory()->create(['user_id' => $postOwner->id]);
    $post->comments()->create([
        'body' => 'First comment!',
        'user_id' => $commenter->id,
    ]);

    $response = $this->get(route('post', $post, absolute: false));

    $response->assertOk();
    $response->assertSee('Comments: 1');
    $response->assertSee('First comment!');
});
