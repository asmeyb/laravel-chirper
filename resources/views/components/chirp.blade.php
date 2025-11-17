@props(['chirp'])




<div class="card bg-base-100">
    <div class="card-body">
        <div class="flex space-x-3">
            <div class="avatar">
                <div class="size-10 rounded-full">
                    <img src="https://avatars.laravel.cloud/{{ urlencode($chirp->user->email ?? 'anon@example.com') }}?vibe=ocean"
     alt="{{ ($chirp->user->name ?? 'Anonymous') . '\'s avatar' }}"
     class="rounded-full">
                </div>
            </div>

            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-1">
                        <p class="text-sm font-semibold">
                            {{ $chirp->user?->name ?? 'Anonymous' }}

                        </p>
                        <span class="text-base-content/60">·</span>
                        <p class="text-sm text-base-content/60">
                            {{ $chirp->created_at->diffForHumans() }}
                        </p>
                        @if ($chirp->updated_at->gt($chirp->created_at->addSeconds(5)))
                            <span class="text-base-content/60">·</span>
                            <span class="text-sm text-base-content/60 italic">edited</span>
                        @endif
                    </div>

                    @if (auth()->check() && auth()->id() === $chirp->user_id)
                        <!-- Edit/Delete Buttons -->
                        <div class="flex gap-1">
                            <a href="/chirps/{{ $chirp->id }}/edit" class="btn btn-ghost btn-xs">
                                Edit
                            </a>
                            <form method="POST" action="/chirps/{{ $chirp->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    onclick="return confirm('Are you sure you want to delete this chirp?')"
                                    class="btn btn-ghost btn-xs text-error">
                                    Delete
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <p class="mt-1">
                    {{ $chirp->message }}
                </p>

                @if($chirp->isRepost && $chirp->originalChirp)
                    <div class="mt-2 p-3 border border-base-300 rounded-lg">
                        <p class="text-xs text-base-content/60 mb-1">Reposted from {{ $chirp->originalChirp->user->name }}</p>
                        <p class="text-sm">{{ $chirp->originalChirp->message }}</p>
                    </div>
                @endif

                <!-- Social Interaction Buttons -->
                @auth
                    <div class="flex items-center gap-2 mt-3 border-t border-base-300 pt-3">
                        <x-like-button :chirp="$chirp" />
                        <x-favorite-button :chirp="$chirp" />
                        <x-repost-button :chirp="$chirp" />
                        
                        <button onclick="toggleComments{{ $chirp->id }}()" class="btn btn-ghost btn-sm gap-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <span>{{ $chirp->comments()->count() }}</span>
                        </button>
                    </div>

                    <!-- Comments Section (Initially Hidden) -->
                    <div id="comments{{ $chirp->id }}" class="hidden">
                        <x-comments-list :chirp="$chirp" />
                    </div>

                    <script>
                        function toggleComments{{ $chirp->id }}() {
                            const commentsDiv = document.getElementById('comments{{ $chirp->id }}');
                            commentsDiv.classList.toggle('hidden');
                        }
                    </script>
                @endauth
            </div>
        </div>
    </div>
</div>
