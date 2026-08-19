<section class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <header class="mb-6">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ __('Update Password') }}
                    </h2>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </div>
            </div>
        </header>

        <form method="post" action="{{ route('password.update') }}" class="space-y-6">
            @csrf
            @method('put')

            <!-- Current Password -->
            <div class="space-y-2">
                <label for="update_password_current_password" class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"></path>
                    </svg>
                    {{ __('Current Password') }}
                </label>
                <div class="relative group">
                    <x-text-input
                        id="update_password_current_password"
                        name="current_password"
                        type="password"
                        class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 pr-12"
                        autocomplete="current-password"
                        required
                        placeholder="{{ __('Enter your current password') }}"
                    />
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" onclick="togglePassword('update_password_current_password', this)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
            </div>

            <!-- New Password -->
            <div class="space-y-2">
                <label for="update_password_password" class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    {{ __('New Password') }}
                </label>
                <div class="relative group">
                    <x-text-input
                        id="update_password_password"
                        name="password"
                        type="password"
                        class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 pr-12"
                        autocomplete="new-password"
                        required
                        minlength="8"
                        placeholder="{{ __('Enter a strong new password') }}"
                        oninput="checkPasswordStrength(this.value)"
                    />
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" onclick="togglePassword('update_password_password', this)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>

                <!-- Password strength indicator -->
                <div id="password-strength" class="mt-3"></div>

                <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-lg p-3 mt-3">
                    <div class="flex items-start">
                        <svg class="w-4 h-4 text-blue-500 mt-0.5 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="text-xs text-blue-700 dark:text-blue-300">
                            <p class="font-medium mb-1">{{ __('Password requirements:') }}</p>
                            <ul class="space-y-1">
                                <li>• {{ __('At least 8 characters long') }}</li>
                                <li>• {{ __('Contains uppercase and lowercase letters') }}</li>
                                <li>• {{ __('Includes numbers and special characters') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="space-y-2">
                <label for="update_password_password_confirmation" class="flex items-center text-sm font-semibold text-gray-700 dark:text-gray-300">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    {{ __('Confirm Password') }}
                </label>
                <div class="relative group">
                    <x-text-input
                        id="update_password_password_confirmation"
                        name="password_confirmation"
                        type="password"
                        class="block w-full px-4 py-3 rounded-lg border-2 border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all duration-200 pr-12"
                        autocomplete="new-password"
                        required
                        placeholder="{{ __('Confirm your new password') }}"
                        oninput="checkPasswordMatch()"
                    />
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300 transition-colors" onclick="togglePassword('update_password_password_confirmation', this)">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                    </button>
                </div>
                <div id="password-match" class="mt-2"></div>
                <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Submit Button -->
            <div class="pt-4">
                <div class="flex items-center justify-between">
                    <x-primary-button
                        class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    >
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                        {{ __('Update Password') }}
                    </x-primary-button>

                    @if (session('status') === 'password-updated')
                        <div
                            x-data="{ show: true }"
                            x-show="show"
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform translate-x-6 scale-90"
                            x-transition:enter-end="opacity-100 transform translate-x-0 scale-100"
                            x-transition:leave="transition ease-in duration-200"
                            x-transition:leave-start="opacity-100 transform translate-x-0 scale-100"
                            x-transition:leave-end="opacity-0 transform translate-x-6 scale-90"
                            x-init="setTimeout(() => show = false, 5000)"
                            class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 text-green-800 dark:text-green-200 px-4 py-3 rounded-lg flex items-center shadow-sm"
                        >
                            <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="font-medium">{{ __('Password updated successfully!') }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- Enhanced JavaScript functionality -->
    <script>
        // Toggle password visibility
        function togglePassword(fieldId, button) {
            const field = document.getElementById(fieldId);
            const isPassword = field.type === 'password';

            field.type = isPassword ? 'text' : 'password';

            // Update icon with animation
            const svg = button.querySelector('svg');
            svg.style.transform = 'scale(0.8)';

            setTimeout(() => {
                if (isPassword) {
                    svg.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"></path>
                    `;
                } else {
                    svg.innerHTML = `
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    `;
                }
                svg.style.transform = 'scale(1)';
            }, 100);
        }

        // Enhanced password strength checker
        function checkPasswordStrength(password) {
            const strengthDiv = document.getElementById('password-strength');
            let strength = 0;
            let checks = [];

            if (password.length === 0) {
                strengthDiv.innerHTML = '';
                return;
            }

            // Length check
            if (password.length >= 8) {
                strength++;
                checks.push({ text: '{{ __("8+ characters") }}', passed: true });
            } else {
                checks.push({ text: '{{ __("8+ characters") }}', passed: false });
            }

            // Uppercase check
            if (/[A-Z]/.test(password)) {
                strength++;
                checks.push({ text: '{{ __("Uppercase") }}', passed: true });
            } else {
                checks.push({ text: '{{ __("Uppercase") }}', passed: false });
            }

            // Lowercase check
            if (/[a-z]/.test(password)) {
                strength++;
                checks.push({ text: '{{ __("Lowercase") }}', passed: true });
            } else {
                checks.push({ text: '{{ __("Lowercase") }}', passed: false });
            }

            // Number check
            if (/\d/.test(password)) {
                strength++;
                checks.push({ text: '{{ __("Numbers") }}', passed: true });
            } else {
                checks.push({ text: '{{ __("Numbers") }}', passed: false });
            }

            // Special character check
            if (/[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\?]/.test(password)) {
                strength++;
                checks.push({ text: '{{ __("Symbols") }}', passed: true });
            } else {
                checks.push({ text: '{{ __("Symbols") }}', passed: false });
            }

            const strengthText = ['{{ __("Very Weak") }}', '{{ __("Weak") }}', '{{ __("Fair") }}', '{{ __("Good") }}', '{{ __("Strong") }}'];
            const strengthColors = [
                { bg: 'bg-red-500', text: 'text-red-600' },
                { bg: 'bg-orange-500', text: 'text-orange-600' },
                { bg: 'bg-yellow-500', text: 'text-yellow-600' },
                { bg: 'bg-blue-500', text: 'text-blue-600' },
                { bg: 'bg-green-500', text: 'text-green-600' }
            ];

            // Create strength indicator
            const checksHtml = checks.map(check => `
                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium ${
                    check.passed
                        ? 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400'
                        : 'bg-gray-100 text-gray-600 dark:bg-gray-700 dark:text-gray-400'
                }">
                    ${check.passed ? '✓' : '○'} ${check.text}
                </span>
            `).join('');

            strengthDiv.innerHTML = `
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="${strengthColors[strength].text} font-semibold text-sm">{{ __('Password Strength:') }} ${strengthText[strength]}</span>
                        <div class="flex space-x-1">
                            ${Array.from({length: 5}, (_, i) =>
                                `<div class="w-3 h-2 rounded-full transition-all duration-300 ${i < strength ? strengthColors[strength].bg : 'bg-gray-200 dark:bg-gray-600'}"></div>`
                            ).join('')}
                        </div>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        ${checksHtml}
                    </div>
                </div>
            `;
        }

        // Enhanced password match checker
        function checkPasswordMatch() {
            const password = document.getElementById('update_password_password').value;
            const confirmation = document.getElementById('update_password_password_confirmation').value;
            const matchDiv = document.getElementById('password-match');

            if (confirmation.length > 0) {
                if (password === confirmation) {
                    matchDiv.innerHTML = `
                        <div class="flex items-center text-sm text-green-600 dark:text-green-400 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg px-3 py-2">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ __("Passwords match perfectly!") }}</span>
                        </div>
                    `;
                } else {
                    matchDiv.innerHTML = `
                        <div class="flex items-center text-sm text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-lg px-3 py-2">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="font-medium">{{ __("Passwords do not match") }}</span>
                        </div>
                    `;
                }
            } else {
                matchDiv.innerHTML = '';
            }
        }

        // Form validation before submit
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form[action*="password.update"]');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const password = document.getElementById('update_password_password').value;
                    const confirmation = document.getElementById('update_password_password_confirmation').value;

                    if (password !== confirmation) {
                        e.preventDefault();
                        alert('{{ __("Password confirmation does not match.") }}');
                        return false;
                    }

                    if (password.length < 8) {
                        e.preventDefault();
                        alert('{{ __("Password must be at least 8 characters long.") }}');
                        return false;
                    }
                });
            }
        });
    </script>
</section>
