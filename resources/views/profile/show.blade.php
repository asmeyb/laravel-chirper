<x-layout>
    <x-slot:title>
        Profile
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">My Profile</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <!-- Profile Picture -->
                <div class="flex justify-center mb-6">
                    @if($user->profile_picture_path)
                        <div class="avatar">
                            <div class="w-32 rounded-full">
                                <img src="{{ asset('storage/' . $user->profile_picture_path) }}" alt="{{ $user->name }}">
                            </div>
                        </div>
                    @else
                        <div class="avatar placeholder">
                            <div class="bg-neutral text-neutral-content rounded-full w-32">
                                <span class="text-5xl">{{ substr($user->name, 0, 1) }}</span>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- User Info -->
                <div class="space-y-4">
                    <div>
                        <label class="label">
                            <span class="label-text font-semibold">Name</span>
                        </label>
                        <p class="text-lg">{{ $user->name }}</p>
                    </div>

                    <div>
                        <label class="label">
                            <span class="label-text font-semibold">Email</span>
                        </label>
                        <p class="text-lg">{{ $user->email }}</p>
                    </div>
                </div>

                <!-- Edit Button -->
                <div class="card-actions justify-end mt-6">
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">
                        Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
