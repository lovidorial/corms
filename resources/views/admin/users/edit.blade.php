<x-app-layout>
    <div class="max-w-3xl mx-auto p-8">
        <h2 class="text-2xl font-bold mb-4">Edit User</h2>

        <form action="{{ route('admin.users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block text-gray-700">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="mt-1 block w-full border-gray-300 rounded" required>
                @error('name')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="mt-1 block w-full border-gray-300 rounded" required>
                @error('email')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="photo" class="block text-gray-700">Profile Photo</label>
                <input type="file" name="photo" id="photo" class="mt-1 block w-full">
                @error('photo')<span class="text-red-600 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex items-center gap-4">
                <button type="submit" class="px-4 py-2 bg-sky-600 text-white rounded">Save</button>
                <a href="{{ route('admin.users.index') }}" class="text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
