<h1>{{ $user->name }}</h1>
@foreach ($chirps as $chirp)
    <x-chirp-card :chirp="$chirp" />
@endforeach

{{ $chirps->links() }}
