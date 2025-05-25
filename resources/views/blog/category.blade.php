@extends('layouts.blog')

@section('content')
    <!-- Technology Category Hero Section -->
    <section class="bg-gradient-to-br from-white via-[{{ $category->color }}] to-[{{ $category->color }}] text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="flex flex-col lg:flex-row items-center justify-between">
                <div class="lg:w-2/3 mb-8 lg:mb-0">
                    <div class="flex items-center mb-4">
                        <span class="text-purple-200 text-sm font-medium uppercase tracking-wider">Category</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">{{ $category->name }}</h1>
                    <p class="text-xl text-purple-100 mb-6 max-w-2xl">{{ $category->description }}</p>
                    <div class="flex flex-wrap items-center gap-4">
                        <div class="flex items-center text-purple-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>{{ count($articles) }} Articles</span>
                        </div>
                        <div class="flex items-center text-purple-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            <span>{{ $category->name }} Hub</span>
                        </div>
                    </div>
                </div>
                <div class="lg:w-1/3">
                    <div class=" bg-opacity-10 backdrop-blur-sm rounded-sm bg-[{{ $category->color }}] p-6 border border-neutral-300 shadow-lg border-opacity-20">
                        <h3 class="text-lg font-semibold mb-4">{{ $category->name }} Spotlight</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-purple-200">This Week</span>
                                <span class="font-bold">{{ count($articles) }} Articles</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-purple-200">Hot Topic</span>
                                <span class="font-bold">{{ $category->name }} Innovation</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-purple-200">Trending</span>
                                <span class="font-bold">Startups</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Filter and Sort Bar -->
    <section class="bg-white border-b border-gray-200 sticky top-16 z-40">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                    <span class="text-sm font-medium text-gray-700">Filtered by:</span>
                    <button class="px-3 py-1 bg-[{{ $category->color }}] text-white rounded-full text-sm font-medium">{{ $category->name }}</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Technology Articles Section -->
            <div class="lg:col-span-3">
                <!-- Featured Tech Article -->
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden mb-8 border border-gray-100">
                    <div class="relative">
                        <img src="https://picsum.photos/seed/{{rand(1000,10000)}}/800/300" alt="Featured Tech Article" class="w-full h-64 object-cover">
                        <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-6">
                            <h2 class="text-2xl md:text-3xl font-bold text-white mb-2"><a href="{{ url('/article', [$featuredArticle[0]->slug]) }}">{{ $featuredArticle[0]->title }}</a></h2>
                            <p class="text-gray-200 mb-3">{{ $featuredArticle[0]->excerpt }}</p>
                            <div class="flex items-center text-gray-300 text-sm">
                                <span>{{ $featuredArticle[0]->user->name }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ $featuredArticle[0]->published_at->format('F d, Y') }}</span>
                                <span class="mx-2">•</span>
                                <span>{{ rand(5, 20) }} min read</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Tech Articles Grid -->
                <div class="space-y-6">
                    <!-- Tech Article 1 -->
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3">
                                <img src="/placeholder.svg?height=200&width=300" alt="Tech Article" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded text-xs font-medium mr-3">AI & ML</span>
                                    <span class="text-gray-500 text-sm">3 hours ago</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-tech transition-colors">
                                    <a href="article.html">Local University Develops AI-Powered Traffic Management System</a>
                                </h3>
                                <p class="text-gray-600 mb-4">Batangas State University researchers create innovative artificial intelligence solution to optimize traffic flow and reduce congestion in major city intersections...</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <img src="/placeholder.svg?height=24&width=24" alt="Author" class="w-6 h-6 rounded-full mr-2">
                                        <span>Dr. Elena Reyes</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>2.1k views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Tech Article 2 -->
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3">
                                <img src="/placeholder.svg?height=200&width=300" alt="Tech Article" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium mr-3">Startups</span>
                                    <span class="text-gray-500 text-sm">5 hours ago</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-tech transition-colors">
                                    <a href="article.html">Fintech Startup Raises ₱50M to Digitize Rural Banking</a>
                                </h3>
                                <p class="text-gray-600 mb-4">Lipa-based financial technology company secures major funding round to expand digital banking services to underserved rural communities across Batangas...</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <img src="/placeholder.svg?height=24&width=24" alt="Author" class="w-6 h-6 rounded-full mr-2">
                                        <span>Miguel Santos</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>1.8k views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Tech Article 3 -->
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3">
                                <img src="/placeholder.svg?height=200&width=300" alt="Tech Article" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-xs font-medium mr-3">Digital Gov</span>
                                    <span class="text-gray-500 text-sm">8 hours ago</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-tech transition-colors">
                                    <a href="article.html">Smart City Initiative Transforms Batangas City Services</a>
                                </h3>
                                <p class="text-gray-600 mb-4">Digital transformation program introduces IoT sensors, mobile apps, and automated systems to improve public services and citizen engagement...</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <img src="/placeholder.svg?height=24&width=24" alt="Author" class="w-6 h-6 rounded-full mr-2">
                                        <span>Ana Rodriguez</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>1.5k views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Tech Article 4 -->
                    <article class="bg-white rounded-xl shadow-md hover:shadow-lg transition-shadow duration-300 overflow-hidden border border-gray-100">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3">
                                <img src="/placeholder.svg?height=200&width=300" alt="Tech Article" class="w-full h-48 md:h-full object-cover">
                            </div>
                            <div class="md:w-2/3 p-6">
                                <div class="flex items-center mb-3">
                                    <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-xs font-medium mr-3">Software</span>
                                    <span class="text-gray-500 text-sm">12 hours ago</span>
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-3 hover:text-tech transition-colors">
                                    <a href="article.html">Local Developers Create Educational App for Filipino Students</a>
                                </h3>
                                <p class="text-gray-600 mb-4">Batangas-based software development team launches innovative mobile application designed to enhance learning experiences for K-12 students nationwide...</p>
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <img src="/placeholder.svg?height=24&width=24" alt="Author" class="w-6 h-6 rounded-full mr-2">
                                        <span>Roberto Silva</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        <span>987 views</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-12">
                    <button class="bg-primary text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition-colors font-medium">
                        Load More Tech Articles
                    </button>
                </div>
            </div>

            <!-- Tech Sidebar -->
            <aside class="lg:col-span-1">
                <div class="space-y-8">
                    <!-- Tech Newsletter Signup -->
                    <div class="bg-gradient-to-br from-white to-[{{ $category->color }}] rounded-2xl p-6 text-white">
                        <h3 class="text-lg font-bold mb-3">{{ $category->name }} Weekly</h3>
                        <p class="text-purple-100 text-sm mb-4">Get the latest {{ $category->name }} news and innovation updates delivered every Tuesday.</p>
                        <form class="space-y-3">
                            <input type="email" placeholder="Your email address" class="w-full px-3 py-2 rounded-lg text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white">
                            <button type="submit" class="w-full bg-white text-purple-600 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
                                Subscribe to {{ $category->name }} News
                            </button>
                        </form>
                    </div>

                    <!-- Trending in Tech -->
                    <div class="bg-white rounded-2xl p-6 shadow-md border border-gray-100">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Trending in Tech</h3>
                        <div class="space-y-3">
                            @foreach($trendingArticles as $index=>$article)
                                <div class="flex items-center">
                                    <span class="w-6 h-6 bg-[rgb({{ rand(1, 255), rand(1, 255), rand(1, 255) }})] text-white rounded-full flex items-center justify-center text-xs font-bold mr-3">{{ $index + 1 }}</span>
                                    <a href="#" class="text-sm text-gray-700 hover:text-tech">{{ Str::words($article->title, 10, '...') }}</a>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </main>
@endsection
