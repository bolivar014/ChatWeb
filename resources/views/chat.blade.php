@extends('layouts.app')
    @section('content')
        <div class="container">
            <h2 class="text-center text-muted">
                {{ $post->title }}
            </h2>
            <pre>
                {{ $post->body }}
            </pre>
        </div>

        <comments-box
            get_comments_url="{{ route('comments.list', $post->id) }}"
            add_comments_url="{{ route('comments.create', $post->id) }}"
            post_id="{{ $post_id }}"
        >
        </comments-box>
    @endsection