@extends('layouts.blog')

@section('title', 'Latest Articles')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-blue-600 to-purple-700 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-6">
                    Welcome to {{ \App\Models\Setting::get('site_name', 'My Blog') }}
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-3xl mx-auto">
                    {{ \App\Models\Setting::get('site_description', 'Discover amazing content and stories') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Featured Articles -->
    @if($featuredArticles->count() > 0)
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-12 text-center">Featured Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($featuredArticles as $article)
                        <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($article->featured_image)
                                <img src="{{ Storage::url($article->featured_image) }}"
                                     alt="{{ $article->title }}"
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <div class="flex items-center mb-4">
                            <span class="inline-block w-3 h-3 rounded-full mr-2"
                                  style="background-color: {{ $article->category->color }}"></span>
                                    <span class="text-sm font-medium" style="color: {{ $article->category->color }}">
                                {{ $article->category->name }}
                            </span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3">
                                    <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-600">
                                        {{ $article->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4">{{ $article->excerpt }}</p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <span>By {{ $article->user->name }}</span>
                                    <span>{{ $article->published_at->format('M j, Y') }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Latest Articles -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900">Latest Articles</h2>

                <!-- Categories Filter -->
                <div class="flex space-x-4">
                    @foreach($categories as $category)
                        <a href="{{ route('blog.category', $category->slug) }}"
                           class="px-4 py-2 rounded-full text-sm font-medium border hover:shadow-md transition-all duration-200"
                           style="border-color: {{ $category->color }}; color: {{ $category->color }}">
                            {{ $category->name }} ({{ $category->articles_count }})
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                        @if($article->featured_image)
                            <img src="{{ Storage::url($article->featured_image) }}"
                                 alt="{{ $article->title }}"
                                 class="w-full h-48 object-cover">
                        @endif
                        <div class="p-6">
                            <div class="flex items-center mb-3">
                                <a href="{{ route('blog.category', $article->category->slug) }}"
                                   class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium"
                                   style="background-color: {{ $article->category->color }}20; color: {{ $article->category->color }}">
                                    {{ $article->category->name }}
                                </a>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">
                                <a href="{{ route('blog.show', $article->slug) }}" class="hover:text-blue-600">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($article->excerpt, 100) }}</p>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $article->user->name }}</span>
                                <span>{{ $article->published_at->diffForHumans() }}</span>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-16">
                        <p class="text-gray-500 text-lg">No articles found.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($articles->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $articles->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
