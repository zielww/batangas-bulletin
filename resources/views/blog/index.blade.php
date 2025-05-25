@extends('layouts.blog')

@section('content')
    <!-- Breaking News Banner -->
    <div class="bg-secondary text-white py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center">
                <span class="bg-white text-secondary px-2 py-1 rounded text-xs font-bold mr-3">BREAKING</span>
                <div class="flex-1 overflow-hidden">
                    <div class="animate-pulse">
                        <span class="text-sm">Latest: {{ $featuredArticles[0]->excerpt }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2">
                <!-- Featured Article -->
                @foreach($featuredArticles as $article)
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                        <img src="http://picsum.photos/seed/{{rand(1000,10000)}}/800/400" alt="Featured Article" class="w-full h-64 object-cover">
                        <div class="p-6">
                            <div class="flex items-center mb-2">
                                <span style="background-color: {{ $article->category->color }}" class="text-white px-2 py-1 rounded text-xs font-semibold">{{ $article->category->name }}</span>
                                <span class="text-gray-500 text-sm ml-2">{{ $article->published_at->format('F d, Y H:i A') }}</span>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-900 mb-3 hover:text-primary cursor-pointer">
                                <a href="{{ url('/article', [$article->slug]) }}">{{ $article->title }}</a>
                            </h1>
                            <p class="text-gray-600 mb-4">{{ $article->excerpt }}</p>
                            <div class="flex items-center">
                                <img src="http://picsum.photos/seed/{{rand(1000,10000)}}/32" alt="Author" class="w-8 h-8 rounded-full mr-3">
                                <div>
                                    <p class="text-sm font-medium text-gray-900">{{ $article->user->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $article->user->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


                <!-- Latest News Grid -->
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Latest News</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($articles as $article)
                            <article class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
                                <img src="http://picsum.photos/seed/{{rand(1000,10000)}}/400/200" alt="News" class="w-full h-48 object-cover">
                                <div class="p-4">
                                    <div class="flex items-center mb-2">
                                        <span style="background-color: {{ $article->category->color }}" class=" text-white px-2 py-1 rounded text-xs font-semibold">{{ $article->category->name }}</span>
                                        <span class="text-gray-500 text-sm ml-2">{{ $article->published_at->format('H:i A F d, Y') }}</span>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                        <a href="{{ url('/article', [$article->slug]) }}">{{ $article->title }}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm mb-3">{{ $article->excerpt }}</p>
                                    <div class="flex items-center">
                                        <img src="http://picsum.photos/seed/{{rand(1000,10000)}}/24" alt="Author" class="w-6 h-6 rounded-full mr-2">
                                        <span class="text-xs text-gray-500">By {{ $article->user->name }}</span>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center">
                   {{ $articles->links() }}
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
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

                <!-- Newsletter Signup -->
                <div class="bg-primary text-white rounded-lg p-6 mb-6">
                    <h3 class="text-xl font-bold mb-2">Stay Updated</h3>
                    <p class="text-blue-100 mb-4">Get the latest news delivered to your inbox</p>
                    <form class="space-y-3">
                        <input type="email" placeholder="Your email address" class="w-full px-4 py-2 rounded-lg text-white border border-neutral-200 focus:outline-none focus:ring-2 focus:ring-blue-300">
                        <button type="submit" class="w-full bg-white text-primary px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Subscribe
                        </button>
                    </form>
                </div>


                <!-- Categories -->
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Categories</h3>
                    <div class="space-y-2">
                        @foreach($categories as $category)
                            <a href="{{ url('/category/', [$category->slug]) }}" class="flex items-center justify-between text-gray-600 hover:text-primary py-2 border-b border-gray-100">
                                <span>{{ $category->name }}</span>
                                <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ count($category->articles) }}</span>
                            </a>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
