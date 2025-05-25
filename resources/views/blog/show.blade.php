@extends('layouts.blog')

@section('title', $article->title)
@section('description', $article->excerpt)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-white border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2">
                    <li>
                        <a href="/" class="text-gray-500 hover:text-primary">Home</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <a href="{{ url('/category', [$article->slug]) }}" class="text-gray-500 hover:text-primary">{{ $article->category->name }}</a>
                    </li>
                    <li>
                        <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </li>
                    <li>
                        <span class="text-gray-900">Article</span>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Article Content -->
            <div class="lg:col-span-2">
                <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Article Header -->
                    <div class="p-6 border-b">
                        <div class="flex items-center mb-4">
                            <span class="bg-[{{ $article->category->color }}] text-white px-3 py-1 rounded-full text-sm font-semibold">{{ $article->category->name }}</span>
                            <span class="text-gray-500 text-sm ml-3">Published on {{ $article->published_at->format('H:i A F d, Y') }}</span>
                        </div>
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                           {{ $article->title }}
                        </h1>
                        <p class="text-xl text-gray-600 mb-6">
                            {{ $article->excerpt }}
                        </p>

                        <!-- Author Info -->
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="http://picsum.photos/seed/{{rand(1000,10000)}}/48" alt="{{ $article->user->name }}" class="w-12 h-12 rounded-full mr-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900">
                                        <a href="{{ url('/author', [$article->name]) }}" class="hover:text-primary">{{ $article->user->name }}</a>
                                    </h3>
                                    <p class="text-sm text-gray-500">{{ $article->user->email }}</p>
                                </div>
                            </div>

                            <!-- Social Share -->
                            <div class="flex items-center space-x-3">
                                <span class="text-sm text-gray-500">Share:</span>
                                <a target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode($article->title) }}&url={{ urlencode(request()->url()) }}" class="text-blue-600 hover:text-blue-700">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
                                    </svg>
                                </a>
                                <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" class="text-blue-600 hover:text-blue-700">
                                    <svg width="24px" height="24px" viewBox="0 0 48 48" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title>Facebook-color</title> <desc>Created with Sketch.</desc> <defs> </defs> <g id="Icons" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"> <g id="Color-" transform="translate(-200.000000, -160.000000)" fill="#4460A0"> <path d="M225.638355,208 L202.649232,208 C201.185673,208 200,206.813592 200,205.350603 L200,162.649211 C200,161.18585 201.185859,160 202.649232,160 L245.350955,160 C246.813955,160 248,161.18585 248,162.649211 L248,205.350603 C248,206.813778 246.813769,208 245.350955,208 L233.119305,208 L233.119305,189.411755 L239.358521,189.411755 L240.292755,182.167586 L233.119305,182.167586 L233.119305,177.542641 C233.119305,175.445287 233.701712,174.01601 236.70929,174.01601 L240.545311,174.014333 L240.545311,167.535091 C239.881886,167.446808 237.604784,167.24957 234.955552,167.24957 C229.424834,167.24957 225.638355,170.625526 225.638355,176.825209 L225.638355,182.167586 L219.383122,182.167586 L219.383122,189.411755 L225.638355,189.411755 L225.638355,208 L225.638355,208 Z" id="Facebook"> </path> </g> </g> </g></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="relative">
                        <img src="https://picsum.photos/seed/{{rand(1000,10000)}}/800/500" alt="featured photo" class="w-full h-96 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-6">
                            <p class="text-white text-sm">{{ $article->excerpt }}</p>
                        </div>
                    </div>

                    <!-- Article Body -->
                    <div class="p-6">
                        <div class="prose prose-lg max-w-none">
                            {!! $article->content !!}
                        </div>

                        <!-- Tags -->
                        <div class="mt-8 pt-6 border-t">
                            <div class="flex flex-wrap gap-2 items-center">
                                <span class="text-sm text-gray-500 mr-2">Category</span>
                                <a href="{{ url('/category', [$article->category->name]) }}" class="bg-[{{ $article->category->color }}] text-white px-3 py-1 font-bold rounded-full text-sm hover:bg-gray-200">{{ $article->category->name }}</a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Comments Section -->
                <div class="bg-white rounded-lg shadow-lg mt-8 p-6">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Comments ({{ count($comments) }})</h3>

                    <!-- Comment Form -->
                    <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                        <h4 class="text-lg font-semibold mb-4">Leave a Comment</h4>
                        <form action="/article/{{ $article->id }}/comment" method="POST" class="space-y-4">
                            @csrf
                            @method('POST')
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="author_name" placeholder="Your Name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                                <input type="email" name="author_email" placeholder="Your Email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary">
                            </div>
                            <textarea rows="4" name="content" placeholder="Your comment..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary"></textarea>
                            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                Post Comment
                            </button>
                        </form>
                    </div>

                    <!-- Comments List -->
                    <div class="space-y-6">
                        <!-- Comment 1 -->
                        @foreach($comments as $comment)
                            <div class="border-b border-gray-200 pb-6">
                                <div class="flex items-start space-x-4">
                                    <img src="https://picsum.photos/seed/{{rand(1000,10000)}}/40" alt="" class="w-10 h-10 rounded-full">
                                    <div class="flex-1">
                                        <div class="flex items-center space-x-2">
                                            <h5 class="font-semibold text-gray-900">{{ $comment->author_name }}</h5>
                                            <span class="text-sm text-gray-500">{{ $comment->created_at->format('F d,Y  H:i A') }}</span>
                                        </div>
                                        <button class="text-sm mb-2 text-primary hover:text-blue-700">{{ $comment->author_email }}</button>
                                        <p class="text-gray-700 mb-3">{{ $comment->content }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>

                    <!-- Load More Comments -->
                    <div class="text-center mt-6">
                        {{ $comments->links() }}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Related Articles -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Related Articles</h3>
                    <div class="space-y-4">
                        @foreach($relatedArticles as $article)
                            <article class="flex space-x-3">
                                <img src="https://picsum.photos/seed/{{rand(1000,10000)}}/80" alt="Related" class="w-20 h-20 object-cover rounded-lg">
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 hover:text-primary cursor-pointer mb-1">
                                        <a href="{{ url('/article', [$article->slug]) }}">{{ $article->title }}</a>
                                    </h4>
                                    <p class="text-xs text-gray-500">{{ $article->published_at->format('F d H:i A') }}</p>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <!-- Newsletter Signup -->
                <div class="bg-primary text-white rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-2">Stay Updated</h3>
                    <p class="text-blue-100 mb-4">Get the latest news delivered to your inbox</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Your email address" class="w-full px-4 py-2 border border-neutral-200 rounded-lg text-white focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <button type="submit" class="w-full bg-white text-primary px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>

                <!-- Trending News -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Trending Now</h3>
                    <div class="space-y-4">
                        @foreach($trendingNow as $index => $article)
                            <div class="flex items-start space-x-3">
                                <span class="bg-secondary text-white rounded-full w-6 h-6 flex items-center justify-center text-xs font-bold">{{ $index + 1 }}</span>
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-900 hover:text-primary cursor-pointer">
                                        <a href="{{ url('/article', [$article->slug]) }}">{{ $article->title }}</a>
                                    </h4>
                                    <p class="text-xs text-gray-500 mt-1">{{ 100000 - rand($index, 10000) }}  views</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
