<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('All Posts') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-8 sm:px-6 lg:px-8">
        
            @if (session('success'))
                <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                    {{ session('success') }}
                </div>
            @endif            

            <!-- Menampilkan Daftar Post dari Database (Hanya yang sudah dipublish) -->
            @foreach ($posts as $post)
                     
                <div class="overflow-hidden bg-white rounded-md border p-5 shadow">                        
                      

                    <h3>
                        <a href="{{ route('posts.show', $post->id) }}" class="text-blue-500">{{ $post->title }}</a>
                    </h3>                        

                    <div class="mt-4 flex justify-between">
                        <div class="flex gap-2 items-center">
                            <!-- Icon User -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="size-4 fill-gray-500">
                                <path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/>
                            </svg>
                            <span class="text-gray-500">{{ $post->user->name ?? 'Unknown' }}</span>
                        </div>

                        <div class="flex gap-2 items-center">
                            <!-- Icon Calendar -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-4 fill-gray-500">
                                <path d="M256 8C119 8 8 119 8 256S119 504 256 504 504 393 504 256 393 8 256 8zm92.5 313h0l-20 25a16 16 0 0 1 -22.5 2.5h0l-67-49.7a40 40 0 0 1 -15-31.2V112a16 16 0 0 1 16-16h32a16 16 0 0 1 16 16V256l58 42.5A16 16 0 0 1 348.5 321z"/>
                            </svg>
                            <span class="text-gray-500">{{ \Carbon\Carbon::parse($post->published_at)->diffForHumans() }}</span>
                        </div>
                    </div>

                        
                    <div class="mt-4 flex gap-4">
                        <!-- Tombol Detail -->
                        <a href="{{ route('posts.show', $post->id) }}" class="inline-flex gap-2 items-center text-green-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-4 fill-green-500">
                                <path d="M288 32C138.8 32 16 154.8 16 304s122.8 272 272 272 272-122.8 272-272S437.2 32 288 32zm0 496c-123.7 0-224-100.3-224-224S164.3 80 288 80s224 100.3 224 224-100.3 224-224 224zm0-416c-53 0-96 43-96 96 0 21.4 7.5 41.1 20 56.7l-42.1 105.3a32 32 0 0 0 5.3 31.3l32 40a32 32 0 0 0 26.7 13.7h48a32 32 0 0 0 26.7-13.7l32-40a32 32 0 0 0 5.3-31.3L364 239.7c12.5-15.6 20-35.3 20-56.7 0-53-43-96-96-96zm0 160c-35.3 0-64-28.7-64-64s28.7-64 64-64 64 28.7 64 64-28.7 64-64 64z"/>
                            </svg>
                            {{ __('Detail') }}
                        </a>

                        @auth
                            @if (auth()->id() == $post->user_id)
                                <!-- Tombol Edit -->
                                <a href="{{ route('posts.edit', $post->id) }}" class="inline-flex gap-2 items-center text-yellow-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="size-4 fill-yellow-500">
                                        <path d="M497.9 142.1l-46.1-46.1c-12.5-12.5-32.8-12.5-45.3 0L334.6 167l91.3 91.3 71.9-71.9c12.5-12.5 12.5-32.8 0-45.3zM315.3 186.6L77.1 424.8l-46.6 139.8c-2.4 7.1-.5 14.7 5.2 19.4 5.8 4.7 13.3 5.6 19.9 2.5l139.8-46.6L433.4 290.7l-118-118.1zM119 464.3l-64.2 21.4 21.4-64.2 198.1-198.2 42.8 42.8L119 464.3z"/>
                                    </svg>
                                    {{ __('Edit') }}
                                </a>

                                <!-- Tombol Delete -->
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure want yo delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex gap-2 items-center text-red-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="size-4 fill-red-500">
                                            <path d="M135.2 17.7c4.1-10.2 14-17.7 25.3-17.7h128c11.4 0 21.3 7.5 25.3 17.7L328 32H448c17.7 0 32 14.3 32 32s-14.3 32-32 32h-18.7l-26.5 370.7C401.8 482.3 386.2 512 363.2 512H84.8c-23 0-38.6-29.7-39.6-47.3L18.7 96H0c-17.7 0-32-14.3-32-32s14.3-32 32-32h120l7.2-14.3zM240 432V192c0-17.7-14.3-32-32-32s-32 14.3-32 32v240c0 17.7 14.3 32 32 32s32-14.3 32-32zm128 0V192c0-17.7-14.3-32-32-32s-32 14.3-32 32v240c0 17.7 14.3 32 32 32s32-14.3 32-32z"/>
                                        </svg>
                                        {{ __('Delete') }}
                                    </button>
                                </form>
                            @endif
                        @endauth
                    </div>

                </div>                
            @endforeach
            
            <!-- Pagination -->
            <div>{{ $posts->links() }}</div>

        </div>
    </div>
</x-app-layout>
