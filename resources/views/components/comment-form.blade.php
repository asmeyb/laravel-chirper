@props(['chirp'])

<form method="POST" action="{{ route('comments.store', $chirp) }}" class="mt-4">
    @csrf
    <div class="form-control">
        <textarea
            name="content"
            placeholder="Write a comment..."
            class="textarea textarea-bordered w-full resize-none @error('content') textarea-error @enderror"
            rows="2"
            maxlength="1000"
            required
        >{{ old('content') }}</textarea>
        
        @error('content')
            <div class="label">
                <span class="label-text-alt text-error">{{ $message }}</span>
            </div>
        @enderror
    </div>
    
    <div class="flex justify-end mt-2">
        <button type="submit" class="btn btn-primary btn-sm">
            Comment
        </button>
    </div>
</form>
