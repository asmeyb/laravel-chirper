<x-layout>
    <x-slot:title>
        Notifications
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <div class="flex items-center justify-between mt-8">
            <h1 class="text-3xl font-bold">Notifications</h1>
            
            @if($notifications->where('read_at', null)->count() > 0)
                <form method="POST" action="{{ route('notifications.readAll') }}">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-ghost">
                        Mark All as Read
                    </button>
                </form>
            @endif
        </div>

        <div class="space-y-2 mt-8">
            @forelse ($notifications as $notification)
                <div class="card bg-base-100 shadow {{ is_null($notification->read_at) ? 'bg-primary/5' : '' }}">
                    <div class="card-body p-4">
                        <div class="flex items-start gap-3">
                            <!-- Notification Icon -->
                            <div class="flex-shrink-0">
                                @if($notification->data['action'] === 'liked')
                                    <svg class="w-6 h-6 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                @elseif($notification->data['action'] === 'commented')
                                    <svg class="w-6 h-6 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                                    </svg>
                                @endif
                            </div>

                            <!-- Notification Content -->
                            <div class="flex-1 min-w-0">
                                @if($notification->data['action'] === 'liked')
                                    <p class="text-sm">
                                        <span class="font-semibold">{{ $notification->data['liker_name'] }}</span>
                                        liked your chirp
                                    </p>
                                    <p class="text-xs text-base-content/60 mt-1">
                                        "{{ Str::limit($notification->data['chirp_message'], 50) }}"
                                    </p>
                                @elseif($notification->data['action'] === 'commented')
                                    <p class="text-sm">
                                        <span class="font-semibold">{{ $notification->data['commenter_name'] }}</span>
                                        commented on your chirp
                                    </p>
                                    <p class="text-xs text-base-content/60 mt-1">
                                        "{{ Str::limit($notification->data['comment_content'], 50) }}"
                                    </p>
                                @endif
                                
                                <p class="text-xs text-base-content/60 mt-2">
                                    {{ $notification->created_at->diffForHumans() }}
                                </p>
                            </div>

                            <!-- Mark as Read Button -->
                            @if(is_null($notification->read_at))
                                <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-ghost">
                                        Mark as Read
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="hero py-12">
                    <div class="hero-content text-center">
                        <div>
                            <svg class="mx-auto h-12 w-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <p class="mt-4 text-base-content/60">No notifications yet.</p>
                        </div>
                    </div>
                </div>
            @endforelse
            
            {{ $notifications->links() }}
        </div>
    </div>
</x-layout>
