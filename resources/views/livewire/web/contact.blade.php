<div>
    {{-- In work, do what you enjoy. --}}

    <div class="bg-gray-100 py-4 border-b border-gray-200">
        <div class="container mx-auto px-4 md:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-3">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 transition duration-300">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                            </svg>
                            Home
                        </a>
                    </li>
                    <li aria-current="page">
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Contact Us</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

   <!-- Page Header with Background Video -->
<div class="relative h-[500px] overflow-hidden">
    <!-- Background video -->
    <video autoplay muted loop playsinline class="absolute inset-0 w-full h-full object-cover">
        <source src="{{ asset('/video/Car Cleaning.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>

    <!-- Overlay (to darken and make text readable) -->
    <div class="absolute inset-0 bg-gradient-to-r from-green-700/70 to-green-500/70"></div>

    <!-- Content -->
    <div class="relative z-10 container mx-auto px-4 md:px-8 py-16 md:py-24 text-white text-center">
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Contact Us</h1>
        <p class="text-xl opacity-90">We're here to help with your vehicle financing needs. Reach out to our team today.</p>
    </div>
</div>



    <!-- Contact Information & Form Section -->
    <div class="container mx-auto px-4 md:px-8 py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">
            <!-- Contact Information -->
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Get In Touch</h2>
                <p class="text-gray-700 mb-8">Have questions about our services or need assistance with your application? Our team is ready to help you navigate the vehicle financing process.</p>
                
                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Our Location</h3>
                            <p class="text-gray-700">123 Financial Street<br>Dar es Salaam, Tanzania</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Phone Number</h3>
                            <p class="text-gray-700">+255 123 456 789</p>
                            <p class="text-gray-700">+255 987 654 321</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Email Address</h3>
                            <p class="text-gray-700">info@vehiclefinance.co.tz</p>
                            <p class="text-gray-700">support@vehiclefinance.co.tz</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <div class="flex-shrink-0 bg-green-100 rounded-full p-3 mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-900 mb-1">Business Hours</h3>
                            <p class="text-gray-700">Monday-Friday: 8:00 AM - 6:00 PM</p>
                            <p class="text-gray-700">Saturday: 9:00 AM - 1:00 PM</p>
                            <p class="text-gray-700">Sunday: Closed</p>
                        </div>
                    </div>
                </div>

                <div class="mt-10">
                    <h3 class="font-semibold text-gray-900 mb-4">Connect With Us</h3>
                    <div class="flex space-x-4">
                        <a href="#" class="bg-green-100 hover:bg-green-200 text-green-600 p-3 rounded-full transition duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="bg-green-100 hover:bg-green-200 text-green-600 p-3 rounded-full transition duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="bg-green-100 hover:bg-green-200 text-green-600 p-3 rounded-full transition duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="bg-green-100 hover:bg-green-200 text-green-600 p-3 rounded-full transition duration-300">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Send Us a Message</h2>
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">First Name</label>
                            <input type="text" id="first_name" name="first_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Your first name" required>
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">Last Name</label>
                            <input type="text" id="last_name" name="last_name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Your last name" required>
                        </div>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Your email address" required>
                    </div>
                    <div class="mb-6">
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                        <input type="tel" id="phone" name="phone" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="Your phone number" required>
                    </div>
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Subject</label>
                        <input type="text" id="subject" name="subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="What is this regarding?" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message</label>
                        <textarea id="message" name="message" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent" placeholder="How can we help you?" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-3 px-4 rounded-lg transition duration-300 transform hover:-translate-y-1 hover:shadow-lg">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Map Section -->
    <div class="py-16 bg-gray-100">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-900 mb-4">Our Location</h2>
                    <p class="text-lg text-gray-700">Find us in the heart of Dar es Salaam, Tanzania</p>
                </div>
                
                <!-- Map Container -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Map iframe -->
                    <div class="h-96 w-full">
                        <!-- Note: In an actual implementation, replace with a real API key -->
                        <iframe 
                            class="w-full h-full border-0" 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126743.58585351667!2d39.1408784!3d-6.7924188!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x185c4c1a2c7fbf23%3A0xb2f34ea5425e6f0e!2sDar%20es%20Salaam%2C%20Tanzania!5e0!3m2!1sen!2sus!4v1651234567890!5m2!1sen!2sus"
                            allowfullscreen="" 
                            loading="lazy">
                        </iframe>
                    </div>
                </div>
                
                <!-- Additional Location Information -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mt-12">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 rounded-full p-3 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Headquarters</h3>
                        </div>
                        <p class="text-gray-700">Our main office is located in the central business district of Dar es Salaam, easily accessible by public transportation.</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 rounded-full p-3 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Branch Offices</h3>
                        </div>
                        <p class="text-gray-700">We also have branch offices in Arusha, Mwanza, and Dodoma to better serve customers across Tanzania.</p>
                    </div>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <div class="bg-green-100 rounded-full p-3 mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-900">Visit Us</h3>
                        </div>
                        <p class="text-gray-700">Book an appointment through our online system or walk in during business hours to meet with our financing specialists.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container mx-auto px-4 md:px-8 py-16">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Frequently Asked Questions</h2>
                <p class="text-lg text-gray-700">Find quick answers to common questions about contacting us.</p>
            </div>
            
            <div class="space-y-6">
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full p-6 text-left">
                        <span class="text-lg font-semibold text-gray-900">What information should I have ready when I contact you?</span>
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <p class="text-gray-700">When contacting us about financing, it's helpful to have information about your income, employment, the vehicle you're interested in, and any specific questions you have about our financing options.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full p-6 text-left">
                        <span class="text-lg font-semibold text-gray-900">How quickly will I receive a response?</span>
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <p class="text-gray-700">We strive to respond to all inquiries within 24 hours during business days. For urgent matters, we recommend calling our customer service line directly.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <button class="flex justify-between items-center w-full p-6 text-left">
                        <span class="text-lg font-semibold text-gray-900">Do I need to make an appointment to visit your office?</span>
                        <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div class="px-6 pb-6">
                        <p class="text-gray-700">While walk-ins are welcome during business hours, we recommend scheduling an appointment to ensure that a financing specialist is available to meet with you and provide personalized assistance.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="bg-green-600 text-white py-16">
        <div class="container mx-auto px-4 md:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl font-bold mb-6">Ready to Start Your Vehicle Financing Journey?</h2>
                <p class="text-xl mb-8 opacity-90">Apply online today or contact us to discuss your options with our friendly team.</p>
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="#" class="bg-white text-green-600 hover:bg-gray-100 font-semibold py-3 px-8 rounded-lg shadow-lg transition duration-300 transform hover:-translate-y-1">
                        Apply Now
                    </a>
                    <a href="#" class="bg-transparent border-2 border-white hover:bg-white hover:text-green-600 text-white font-semibold py-3 px-8 rounded-lg transition duration-300 transform hover:-translate-y-1">
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </div>


</div>
