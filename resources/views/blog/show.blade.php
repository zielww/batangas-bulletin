@extends('layouts.blog')

@section('title', $article->title)
@section('description', $article->excerpt)

@section('content')
    <article class="py-16">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Article Header -->
            <header class="mb-8">
                <div class="flex items-center mb-4">
                    <a href="{{ route('blog.category', $article->category->slug) }}"
                       class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium"
                       style="background-color: {{ $article->category->color }}20; color: {{ $article->category->color }}">
                        {{ $article->category->name }}
                    </a>
                </div>

                <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6">{{ $article->title }}</h1>

                <div class="flex items-center text-gray-600 mb-6">
                    <span>By {{ $article->user->name }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $article->published_at->format('F j, Y') }}</span>
                    <span class="mx-2">•</span>
                    <span>{{ $article->comments->count() }} {{ Str::plural('comment', $article->comments->count()) }}</span>
                </div>

                @if($article->featured_image)
                    <img src="{{ Storage::url($article->featured_image) }}"
                         alt="{{ $article->title }}"
                         class="w-full h-64 md:h-96 object-cover rounded-lg mb-8">
                @endif

                @if($article->excerpt)
                    <p class="text-xl text-gray-600 leading-relaxed mb-8">{{ $article->excerpt }}</p>
                @endif
            </header>

            <!-- Article Content -->
            <div class="prose prose-lg max-w-none mb-12">
                {!! $article->content !!}
            </div>

            <!-- Article Footer -->
            <footer class="border-t pt-8 mb-12">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <span class="text-gray-600">Share this article:</span>
                        <div class="ml-4 flex space-x-4">
                            <a href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="text-blue-500 hover:text-blue-700">
                                Twitter
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800">
                                Facebook
                            </a>
                        </div>
                    </div>
                    <div class="text-sm text-gray-500">
                        Published {{ $article->published_at->diffForHumans() }}
                    </div>
                </div>
            </footer>
        </div>
    </article>

    <!-- Comments Section -->
    @if(\App\Models\Setting::get('allow_comments', 'true') === 'true')
        <section class="py-16 bg-gray-50">
            <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">
                    Comments ({{ $article->comments->count() }})
                </h2>

                <!-- Comment Form -->
                <div class="bg-white rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Leave a Comment</h3>

                    @if(session('success'))
                        <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('blog.comment.store', $article) }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Name</label>
                                <input type="text"
                                       id="author_name"
                                       name="author_name"
                                       value="{{ old('author_name') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('author_name') border-red-500 @enderror">
                                @error('author_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="author_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email"
                                       id="author_email"
                                       name="author_email"
                                       value="{{ old('author_email') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('author_email') border-red-500 @enderror">
                                @error('author_email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Comment</label>
                            <textarea id="content"
                                      name="content"
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
                            @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <button type="submit"
                                class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Post Comment
                        </button>
                    </form>
                </div>

                <!-- Comments List -->
                <div class="space-y-6">
                    @forelse($article->comments as $comment)
                        <div class="bg-white rounded-lg p-6">
                            <div class="flex items-center justify-between mb-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                <span class="text-gray-600 font-medium">
                                    {{ substr($comment->author_name, 0, 1) }}
                                </span>
                                    </div>
                                    <div class="ml-3">
                                        <h4 class="font-medium text-gray-900">{{ $comment->author_name }}</h4>
                                        <p class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="text-gray-700">{{ $comment->content }}</p>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <p class="text-gray-500">No comments yet. Be the first to comment!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    @endif

    <!-- Related Articles -->
    @if($relatedArticles->count() > 0)
        <section class="py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-8">Related Articles</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $related)
                        <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                            @if($related->featured_image)
                                <img src="{{ Storage::url($related->featured_image) }}"
                                     alt="{{ $related->title }}"
                                     class="w-full h-48 object-cover">
                            @endif
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-900 mb-2">
                                    <a href="{{ route('blog.show', $related->slug) }}" class="hover:text-blue-600">
                                        {{ $related->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">{{ Str::limit($related->excerpt, 100) }}</p>
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span>{{ $related->user->name }}</span>
                                    <span>{{ $related->published_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection
