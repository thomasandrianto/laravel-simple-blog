<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Post Detail') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow rounded-lg">
                @if ($post->image_url)
                    <img src="{{ asset($post->image_url) }}" class="w-full h-64 object-cover rounded-md mb-3">
                @endif

                <h3 class="text-2xl font-bold">{{ $post->title }}</h3>
                <p class="text-gray-600">By: {{ $post->user->name }} | Published: {{ $post->published_at ?? '-' }}</p>
                
                <div class="mt-4 text-gray-800">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <div class="mt-6">
                    <a href="{{ route('posts.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Back</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
