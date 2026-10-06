<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('New Post') }}
                </a>
            </div>

            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-100 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if ($posts->isEmpty())
                        <p>{{ __('No posts yet.') }}</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-2 text-left">{{ __('Title') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Body') }}</th>
                                    <th class="px-4 py-2 text-left">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($posts as $post)
                                    <tr>
                                        <td class="px-4 py-2">{{ $post->title }}</td>
                                        <td class="px-4 py-2">{{ $post->body }}</td>
                                        <td class="px-4 py-2">
                                            <div class="flex gap-2">
                                                <a href="{{ route('posts.edit', $post) }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Edit') }}</a>
                                                <form action="{{ route('posts.destroy', $post) }}" method="POST" onsubmit="return confirm('Delete this post?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">{{ __('Delete') }}</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
