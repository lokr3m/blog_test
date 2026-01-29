@extends('partials.layout')
@section('content')
    @include('partials.post-card', ['full' => true])
    
    <h1 class="text-3xl mt-8">Comments: </h1>
    
    @auth
        <div class="card bg-base-200 mt-4 shadow-sm">
            <div class="card-body">
                <h2 class="card-title">Add a Comment</h2>
                <form method="POST" action="{{ route('comments.store') }}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="form-control">
                        <textarea 
                            name="body" 
                            class="textarea textarea-bordered h-24 @error('body') textarea-error @enderror" 
                            placeholder="Write your comment here..."
                            required
                        >{{ old('body') }}</textarea>
                        @error('body')
                            <label class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>
                    <div class="card-actions justify-end mt-4">
                        <button type="submit" class="btn btn-primary">Post Comment</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-info mt-4">
            <span>Please <a href="{{ route('login') }}" class="link">login</a> to leave a comment.</span>
        </div>
    @endauth
    
    @foreach ($post->comments as $comment)
        <div class="card bg-base-200 mt-2 shadow-sm">
            <div class="card-body">
                {{ $comment->body }}
                <p class="text-base-content/70">{{ $comment->user->name }}</p>
            </div>
        </div>
    @endforeach
@endsection