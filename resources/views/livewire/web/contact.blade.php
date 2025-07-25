{{-- resources/views/livewire/contact-us.blade.php --}}
<div class="min-h-screen bg-white">
    
    {{-- Header Section --}}
    <div class="bg-green-600 text-white py-16">
        <div class="container mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4">Contact Us</h1>
            <p class="text-xl opacity-90">We're here to help with your vehicle financing needs</p>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="container mx-auto px-6 py-16">
        <div class="max-w-6xl mx-auto">
            
            {{-- Success Message --}}
            @if($success_message)
                <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-8">
                    {{ $success_message }}
                </div>
            @endif

            <div class="grid lg:grid-cols-2 gap-12">
                
                {{-- Contact Information --}}
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Get In Touch</h2>
                    <p class="text-gray-700 mb-8">
                        Have questions about our services? Our team is ready to help you with your vehicle financing needs.
                    </p>
                    
                    <div class="space-y-6">
                        {{-- Location --}}
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Our Location</h3>
                                <p class="text-gray-600">123 Financial Street<br>Dar es Salaam, Tanzania</p>
                            </div>
                        </div>

                        {{-- Phone --}}
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Phone Number</h3>
                                <p class="text-gray-600">+255 123 456 789</p>
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email Address</h3>
                                <p class="text-gray-600">info@vehiclefinance.co.tz</p>
                            </div>
                        </div>

                        {{-- Business Hours --}}
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Business Hours</h3>
                                <p class="text-gray-600">Monday-Friday: 8:00 AM - 6:00 PM<br>Saturday: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Contact Form --}}
                <div class="bg-green-50 rounded-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
                    
                    <form wire:submit.prevent="submitForm" class="space-y-6">
                        {{-- Name Fields --}}
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="first_name" class="block text-sm font-medium text-gray-700 mb-2">First Name</label>
                                <input type="text" 
                                       wire:model="first_name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                       placeholder="Your first name">
                                @error('first_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label for="last_name" class="block text-sm font-medium text-gray-700 mb-2">Last Name</label>
                                <input type="text" 
                                       wire:model="last_name" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                       placeholder="Your last name">
                                @error('last_name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                            <input type="email" 
                                   wire:model="email" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                   placeholder="your.email@example.com">
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Phone --}}
                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">Phone Number</label>
                            <input type="tel" 
                                   wire:model="phone" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                   placeholder="+255 123 456 789">
                            @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Subject --}}
                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                            <input type="text" 
                                   wire:model="subject" 
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                   placeholder="What is this regarding?">
                            @error('subject') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Message --}}
                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                            <textarea wire:model="message" 
                                      rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500" 
                                      placeholder="How can we help you?"></textarea>
                            @error('message') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        {{-- Submit Button --}}
                        <button type="submit" 
                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>

            {{-- Map Section --}}
            <div class="mt-16">
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Find Our Location</h3>
                    <p class="text-gray-600">Visit us in the heart of Dar es Salaam, Tanzania</p>
                </div>
                
                {{-- Map Container --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
                    <div class="h-96 w-full">
                        <iframe 
                            class="w-full h-full border-0" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58585351667!2d39.1408784!3d-6.7924188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4c1a2c7fbf23%3A0xb2f34ea5425e6f0e!2sDar%20es%20Salaam%2C%20Tanzania!5e0!3m2!1sen!2sus!4v1651234567890!5m2!1sen!2sus"
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
            </div>

          
        </div>
    </div>
</div>