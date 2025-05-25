<footer class="bg-gray-900 text-white mt-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            <div class="col-span-2">
                <h3 class="text-xl font-bold mb-4">{{ \App\Models\Setting::get('site_name', 'My Blog') }}</h3>
                <p class="text-gray-400 mb-4">{{ \App\Models\Setting::get('site_description', '') }}</p>
                <p class="text-gray-400">Contact: {{ \App\Models\Setting::get('contact_email', '') }}</p>
            </div>

            <div>
                <h4 class="text-lg font-semibold mb-4">Categories</h4>
                <ul class="space-y-2">
                    @foreach(\App\Models\Category::all() as $category)
                        <li>
                            <a href="{{ url('/category', [$category->slug]) }}"
                               class="text-gray-400 hover:text-white">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div>   
                <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/" class="text-gray-400 hover:text-white">Home</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-gray-800 mt-8 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} {{ \App\Models\Setting::get('site_name', 'My Blog') }}. All rights reserved.</p>
        </div>
    </div>
</footer>

<script>
    // Mobile menu toggle
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');

    mobileMenuButton.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu when clicking outside
    document.addEventListener('click', (e) => {
        if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
            mobileMenu.classList.add('hidden');
        }
    });
</script>
