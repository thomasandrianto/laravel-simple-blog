<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @auth
                        <section>
                            <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                @method('PUT')

                                <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" maxlength="60" required value="{{ old('title', $post->title) }}" />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <!-- Content -->
                                <div>
                                    <x-input-label for="content" :value="__('Content')" />
                                    <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="6" required>{{ old('content', $post->content) }}</textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>

                                <!-- Image Upload -->
                                <div>
                                    <x-input-label for="image" :value="__('Upload Image')" />
                                    <input type="file" id="image" name="image" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                    @if ($post->image_url)
                                        <div class="mt-2">
                                            <p>Current Image:</p>
                                            <img src="{{ Storage::url($post->image_url) }}" class="w-40 h-auto rounded-md">
                                        </div>
                                    @endif
                                </div>
                                                               
                                <!-- Status -->
                                <div x-data="{ status: '{{ old('status', $post->status->value) }}' }">
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" x-model="status"
                                        class="mt-1 mb-4 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="draft" @selected(old('status', $post->status->value) === 'draft')>Draft</option>
                                        <option value="scheduled" @selected(old('status', $post->status->value) === 'scheduled')>Scheduled</option>
                                        <option value="published" @selected(old('status', $post->status->value) === 'published')>Published</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />

                                    <!-- Publish Date -->
                                    <div x-show="status === 'published'" x-cloak>
                                        <x-input-label for="published_at" :value="__('Publish Date')" />
                                        <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full"
                                            value="{{ old('published_at', $post->published_at ? \Illuminate\Support\Carbon::parse($post->published_at)->format('Y-m-d\TH:i') : '') }}" />
                                        <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                                    </div>

                                    <!-- Scheduled Date -->
                                    <div x-show="status === 'scheduled'" x-cloak>
                                        <x-input-label for="scheduled_at" :value="__('Scheduled Date')" />
                                        <x-text-input id="scheduled_at" name="scheduled_at" type="datetime-local" class="mt-1 block w-full"
                                            value="{{ old('scheduled_at', $post->scheduled_at ? \Illuminate\Support\Carbon::parse($post->scheduled_at)->format('Y-m-d\TH:i') : '') }}" />
                                        <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                                    </div>
                                </div>

                                <!-- Submit Button -->
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Update Post') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    @else
                        <p class="text-center text-gray-600">You must be logged in to edit a post. <a href="{{ route('login') }}" class="text-blue-600 underline">Login here</a></p>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
