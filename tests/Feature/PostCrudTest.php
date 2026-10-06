<?php

use App\Models\Post;
use App\Models\User;

test('user can create and update a post', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/posts')
        ->assertOk();

    $this->actingAs($user)
        ->post('/posts', [
            'title' => 'First post',
            'body' => 'This is the body',
        ])
        ->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'title' => 'First post',
        'body' => 'This is the body',
    ]);

    $post = Post::first();

    $this->actingAs($user)
        ->patch('/posts/'.$post->id, [
            'title' => 'Updated post',
            'body' => 'Updated body',
        ])
        ->assertRedirect('/posts');

    $this->assertDatabaseHas('posts', [
        'id' => $post->id,
        'title' => 'Updated post',
        'body' => 'Updated body',
    ]);
});
