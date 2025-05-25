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

    // Toggle password visibility
    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const eyeIcon = document.getElementById(`eye-icon-${inputId === 'password' ? 'password' : 'confirm'}`);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                `;
        } else {
            passwordInput.type = 'password';
            eyeIcon.innerHTML = `
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                `;
        }
    }

    // Password strength checker
    document.getElementById('password').addEventListener('input', function(e) {
        const password = e.target.value;
        const strength = calculatePasswordStrength(password);
        updatePasswordStrengthUI(strength);
    });

    function calculatePasswordStrength(password) {
        let score = 0;
        if (password.length >= 8) score++;
        if (/[a-z]/.test(password)) score++;
        if (/[A-Z]/.test(password)) score++;
        if (/[0-9]/.test(password)) score++;
        if (/[^A-Za-z0-9]/.test(password)) score++;
        return Math.min(score, 4);
    }

    function updatePasswordStrengthUI(strength) {
        const indicators = ['strength-1', 'strength-2', 'strength-3', 'strength-4'];
        const colors = ['bg-red-500', 'bg-orange-500', 'bg-yellow-500', 'bg-green-500'];
        const texts = ['Very Weak', 'Weak', 'Fair', 'Good', 'Strong'];

        // Reset all indicators
        indicators.forEach(id => {
            document.getElementById(id).className = 'h-1 w-1/4 bg-gray-200 rounded';
        });

        // Update based on strength
        for (let i = 0; i < strength; i++) {
            document.getElementById(indicators[i]).className = `h-1 w-1/4 ${colors[Math.min(strength - 1, 3)]} rounded`;
        }

        document.getElementById('strength-text').textContent = texts[strength];
        document.getElementById('strength-text').className = `text-xs mt-1 ${strength < 2 ? 'text-red-500' : strength < 3 ? 'text-orange-500' : strength < 4 ? 'text-yellow-500' : 'text-green-500'}`;
    }
</script>
