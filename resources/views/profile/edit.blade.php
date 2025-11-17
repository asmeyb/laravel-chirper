<x-layout>
    <x-slot:title>
        Edit Profile
    </x-slot:title>

    <div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Edit Profile</h1>

        <div class="card bg-base-100 shadow mt-8">
            <div class="card-body">
                <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Current Profile Picture -->
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

                    <!-- Name Field -->
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text">Name</span>
                        </label>
                        <input
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="input input-bordered w-full @error('name') input-error @enderror"
                            required
                        >
                        @error('name')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Email Field -->
                    <div class="form-control w-full mt-4">
                        <label class="label">
                            <span class="label-text">Email</span>
                        </label>
                        <input
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="input input-bordered w-full @error('email') input-error @enderror"
                            required
                        >
                        @error('email')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Profile Picture Upload -->
                    <div class="form-control w-full mt-4">
                        <label class="label">
                            <span class="label-text">Profile Picture</span>
                        </label>
                        <input
                            type="file"
                            name="profile_picture"
                            accept="image/jpeg,image/png,image/jpg,image/gif"
                            class="file-input file-input-bordered w-full @error('profile_picture') file-input-error @enderror"
                        >
                        <div class="label">
                            <span class="label-text-alt">Max size: 2MB. Formats: JPEG, PNG, JPG, GIF</span>
                        </div>
                        @error('profile_picture')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <!-- Action Buttons -->
                    <div class="card-actions justify-end mt-6 gap-2">
                        <a href="{{ route('profile.show') }}" class="btn btn-ghost">
                            Cancel
                        </a>
                        <button type="submit" class="btn btn-primary">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
