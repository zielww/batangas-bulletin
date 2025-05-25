@extends('layouts.blog')

@section('content')
    <!-- Author Header -->
    <div class="bg-gradient-to-r from-primary to-blue-700 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row items-center space-y-6 md:space-y-0 md:space-x-8">
                <img src="http://picsum.photos/seed/{{rand(0, 10000)}}/150" alt="pfp" class="w-32 h-32 md:w-40 md:h-40 rounded-full border-4 border-white shadow-lg">
                <div class="text-center md:text-left">
                    <h1 class="text-4xl md:text-5xl font-bold mb-2">{{ $author->name }}</h1>
                    <p class="text-xl text-blue-100 mb-4">Senior Business Reporter</p>
                    <div class="flex flex-wrap justify-center md:justify-start gap-4 text-blue-100">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <span>{{ count($author->articles) }} Article/s</span>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a4 4 0 118 0v4m-4 8a2 2 0 100-4 2 2 0 000 4zm0 0v4a2 2 0 002 2h6a2 2 0 002-2v-4a2 2 0 00-2-2H10a2 2 0 00-2 2z"></path>
                            </svg>
                            <span>Started {{ $author->created_at->format("F d, Y") }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Author Bio and Articles -->
            <div class="lg:col-span-2">
                <!-- Author Bio -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">About {{ $author->name }}</h2>
                    <div class="prose prose-lg max-w-none text-gray-700">
                        <p class="mb-4">
                            {{ $author->about }}
                        </p>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-3">Contact Information</h3>
                        <div class="flex flex-wrap gap-4">
                            <a href="mailto:maria.santos@batangasbulletin.com" class="flex items-center text-primary hover:text-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                {{Str::replace(' ', '.', Str::lower($author->name))}}@batangasbulletin.com
                            </a>
                            <a href="#" class="flex items-center text-primary hover:text-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/>
                                </svg>
                                @ {{Str::replace(' ', '.', Str::lower($author->name))}}
                            </a>
                            <a href="#" class="flex items-center text-primary hover:text-blue-700">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                                LinkedIn Profile
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Author's Articles -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recent Articles</h2>
                    </div>

                    <div class="space-y-6">
                        <!-- Articles -->
                        @foreach($articles as $article)
                            <article class="border-b border-gray-200 pb-6">
                                <div class="flex flex-col md:flex-row md:space-x-4">
                                    <img src="http://picsum.photos/seed/{{rand(0, 10000)}}/200/120" alt="Article" class="w-full md:w-48 h-32 object-cover rounded-lg mb-4 md:mb-0">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-2">
                                            <span style="background-color: {{ $article->category->color }}" class=" text-white px-2 py-1 rounded text-xs font-semibold">{{ Str::upper($article->category->name) }}</span>
                                            <span class="text-gray-500 text-sm ml-2">{{ $article->published_at->format("F d, Y H:i A") }}</span>
                                        </div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2 hover:text-primary cursor-pointer">
                                            <a href="{{ url('/article', [$article->slug]) }}">{{ $article->title }}</a>
                                        </h3>
                                        <p class="text-gray-600 mb-3">{{ $article->excerpt }}</p>
                                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                            </svg>
                                            {{ rand(500, 100000) }} views
                                        </span>
                                            <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                                            </svg>
                                            {{ $article->comment ?? 0 }} comment/s
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Load More -->
                    <div class="text-center mt-6">
                       {{ $articles->links() }}
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Author Stats -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Author Statistics</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Articles</span>
                            <span class="font-semibold text-gray-900">{{ count($author->articles) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Views</span>
                            <span class="font-semibold text-gray-900">{{ number_format(rand(1000, 500000)) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Total Comments</span>
                            <span class="font-semibold text-gray-900">{{ number_format($author->comment) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Member Since</span>
                            <span class="font-semibold text-gray-900">{{ $author->created_at->format("M Y") }}</span>
                        </div>
                    </div>
                </div>

                <!-- Expertise Areas -->
                <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Areas of Expertise</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($categories  as $category)
                            <span style="background-color: {{ $category->color }}" class=" text-white px-3 py-1 rounded-full text-sm">{{ $category->name }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
