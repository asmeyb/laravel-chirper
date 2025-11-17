@props(['chirp'])

<div class="mt-4 space-y-3">
    @forelse($chirp->comments as $comment)
        <div class="flex gap-3 p-3 bg-base-200 rounded-lg">
            <div class="avatar">
                <div class="w-8 h-8 rounded-full">
                    <img src="https://avatars.laravel.cloud/{{ urlencode($comment->user->email) }}?vibe=ocean" 
                         alt="{{ $comment->user->name }}'s avatar">
                </div>
            </div>
            
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <span class="text-sm font-semibold">{{ $comment->user->name }}</span>
                        <span class="text-xs text-base-content/60">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    
                    @if(auth()->check() && auth()->id() === $comment->user_id)
                        <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" 
                                    onclick="return confirm('Are you sure you want to delete this comment?')"
                                    class="btn btn-ghost btn-xs text-error">
                                Delete
                            </button>
                        </form>
                    @endif
                </div>
                
                <p class="text-sm mt-1">{{ $comment->content }}</p>
            </div>
        </div>
    @empty
        <p class="text-sm text-base-content/60 text-center py-4">No comments yet. Be the first to comment!</p>
    @endforelse
    
    @auth
        <x-comment-form :chirp="$chirp" />
    @endauth
</div>
