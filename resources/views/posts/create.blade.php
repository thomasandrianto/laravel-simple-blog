<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @auth
                        <section>
                            <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data" class="space-y-6">
                                @csrf

                                <!-- Title -->
                                <div>
                                    <x-input-label for="title" :value="__('Title')" />
                                    <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" maxlength="60" required />
                                    <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                </div>

                                <!-- Content -->
                                <div>
                                    <x-input-label for="content" :value="__('Content')" />
                                    <textarea id="content" name="content" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" rows="6" required></textarea>
                                    <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                </div>

                                <!-- Image Upload -->
                                <div>
                                    <x-input-label for="image" :value="__('Upload Image')" />
                                    <input type="file" id="image" name="image" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                                </div>

                                <!-- Status -->
                                <div>
                                    <x-input-label for="status" :value="__('Status')" />
                                    <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                        <option value="draft" selected>Draft</option>
                                        <option value="scheduled">Scheduled</option>
                                        <option value="published">Published</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                <!-- Publish Date -->
                                <div>
                                    <x-input-label for="published_at" :value="__('Publish Date')" />
                                    <x-text-input id="published_at" name="published_at" type="datetime-local" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                                </div>

                                <!-- Scheduled Date -->
                                <div>
                                    <x-input-label for="scheduled_at" :value="__('Scheduled Date')" />
                                    <x-text-input id="scheduled_at" name="scheduled_at" type="datetime-local" class="mt-1 block w-full" />
                                    <x-input-error :messages="$errors->get('scheduled_at')" class="mt-2" />
                                </div>

                                <!-- Submit Button -->
                                <div class="flex items-center gap-4">
                                    <x-primary-button>{{ __('Post') }}</x-primary-button>
                                </div>
                            </form>
                        </section>
                    @else
                        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900">
                                <p>Please <a href="{{ route('login') }}" class="text-blue-500">login</a> or
                                <a href="{{ route('register') }}" class="text-blue-500">register</a>.</p>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
