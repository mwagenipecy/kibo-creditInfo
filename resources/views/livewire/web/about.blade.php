<div>
<!-- resources/views/about-us.blade.php -->


    <div class="bg-white w-full">
        <!-- Breadcrumb -->
        <div class="bg-gray-100 py-4 border-b border-gray-200">
            <div class="container mx-auto px-4 md:px-8">
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('home.page') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-green-600 transition duration-300">
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
                                <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">About Us</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="relative bg-gradient-to-r from-green-700 to-green-500 text-white overflow-hidden">
            <div class="container mx-auto px-4 md:px-8 py-20 md:py-28">
                <div class="max-w-3xl mx-auto text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">Connecting You with Vehicle Financing Solutions</h1>
                    <p class="text-xl md:text-2xl mb-8 opacity-90">We bridge the gap between car dealers and lenders to make vehicle ownership accessible and affordable.</p>
                    <a href="{{ route('client.registration') }}" class="inline-block bg-white text-green-600 font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-gray-100 hover:shadow-xl transition duration-300 transform hover:-translate-y-1">Get Started Today</a>
                </div>
            </div>
            <div class="absolute bottom-[-150px] left-0 right-0 mt-16">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320" class="w-full h-auto">
                    <path fill="#ffffff" fill-opacity="1" d="M0,96L80,106.7C160,117,320,139,480,133.3C640,128,800,96,960,90.7C1120,85,1280,107,1360,117.3L1440,128L1440,320L1360,320C1280,320,1120,320,960,320C800,320,640,320,480,320C320,320,160,320,80,320L0,320Z"></path>
                </svg>
            </div>
        </div>

        <!-- Our Mission -->
        <div class="container mx-auto px-4 md:px-8 py-20">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col md:flex-row items-center gap-12">
                    <div class="md:w-1/2">
                        <img src="{{ asset('/cars/City driver-bro.png') }}" alt="Our Mission" class="rounded-2xl shadow-xl w-full h-auto hover:shadow-2xl transition duration-300 transform hover:-translate-y-1">
                    </div>
                    <div class="md:w-1/2">
                        <div class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold mb-4">Our Purpose</div>
                        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">Our Mission</h2>
                        <p class="text-lg text-gray-700 mb-6 leading-relaxed">At our core, we believe that everyone deserves access to reliable transportation. Our mission is to simplify the vehicle financing process by connecting borrowers with multiple lending options and trusted car dealers across Tanzania.</p>
                        <p class="text-lg text-gray-700 leading-relaxed">We're committed to transparency, fair practices, and personalized service that puts you in control of your vehicle buying journey.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- How We Work -->
        <div class="bg-gray-50 py-20">
            <div class="container mx-auto px-4 md:px-8">
                <div class="max-w-4xl mx-auto text-center mb-16">
                    <div class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold mb-4">Our Process</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">How We Work</h2>
                    <p class="text-lg text-gray-700">Our platform streamlines the car buying and financing process from start to finish.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center transform transition duration-500 hover:shadow-2xl hover:-translate-y-2">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 text-green-600 rounded-full mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">1. Apply Online</h3>
                        <p class="text-gray-700 leading-relaxed">Complete our simple application form with your details and financing needs. It takes just a few minutes.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center transform transition duration-500 hover:shadow-2xl hover:-translate-y-2">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 text-green-600 rounded-full mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">2. Get Multiple Offers</h3>
                        <p class="text-gray-700 leading-relaxed">We match you with multiple lenders who compete for your business, ensuring you get the best rates available.</p>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg p-8 text-center transform transition duration-500 hover:shadow-2xl hover:-translate-y-2">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-green-100 text-green-600 rounded-full mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-900 mb-4">3. Choose & Drive</h3>
                        <p class="text-gray-700 leading-relaxed">Select the offer that works best for you, complete the paperwork, and drive away in your new vehicle.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Our Partners -->
        <div class="container mx-auto px-4 md:px-8 py-20">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <div class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold mb-4">Who We Work With</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Partners</h2>
                <p class="text-lg text-gray-700">We work with Tanzania's top lenders and dealerships to bring you the best options.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 max-w-6xl mx-auto">
                <!-- Partner logos would go here -->
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
                <div class="flex items-center justify-center p-6 bg-white border border-gray-100 rounded-xl shadow-md hover:shadow-lg transition duration-300">
                    <div class="h-12 w-full bg-gray-200 rounded opacity-70"></div>
                </div>
            </div>
        </div>

        <!-- Team Section -->
        <div class="bg-gray-50 py-20">
            <div class="container mx-auto px-4 md:px-8">
                <div class="max-w-4xl mx-auto text-center mb-16">
                    <div class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold mb-4">Meet Our Experts</div>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Our Team</h2>
                    <p class="text-lg text-gray-700">Meet the dedicated professionals working to connect you with the best financing options.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10 max-w-6xl mx-auto">
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:shadow-2xl hover:-translate-y-2">
                        <div class="h-72 bg-gray-200"></div>
                        <div class="p-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">John Doe</h3>
                            <p class="text-green-600 mb-4 font-medium">CEO & Founder</p>
                            <p class="text-gray-700 leading-relaxed">With over 15 years in financial services, John brings extensive experience in automotive financing and consumer lending.</p>
                            <div class="mt-6 flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:shadow-2xl hover:-translate-y-2">
                        <div class="h-72 bg-gray-200"></div>
                        <div class="p-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Jane Smith</h3>
                            <p class="text-green-600 mb-4 font-medium">Head of Partnerships</p>
                            <p class="text-gray-700 leading-relaxed">Jane manages our network of lenders and dealerships, ensuring seamless collaboration to benefit our customers.</p>
                            <div class="mt-6 flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden transform transition duration-500 hover:shadow-2xl hover:-translate-y-2">
                        <div class="h-72 bg-gray-200"></div>
                        <div class="p-8">
                            <h3 class="text-xl font-semibold text-gray-900 mb-1">Michael Johnson</h3>
                            <p class="text-green-600 mb-4 font-medium">Chief Loan Officer</p>
                            <p class="text-gray-700 leading-relaxed">Michael oversees all financing operations, leveraging his expertise to secure competitive rates for our clients.</p>
                            <div class="mt-6 flex space-x-4">
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fab fa-linkedin fa-lg"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fab fa-twitter fa-lg"></i>
                                </a>
                                <a href="#" class="text-gray-400 hover:text-green-600 transition duration-300">
                                    <i class="fas fa-envelope fa-lg"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Testimonials -->
        <div class="container mx-auto px-4 md:px-8 py-20">
            <div class="max-w-4xl mx-auto text-center mb-16">
                <div class="inline-block px-3 py-1 bg-green-100 text-green-600 rounded-full text-sm font-semibold mb-4">Success Stories</div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">What Our Customers Say</h2>
                <p class="text-lg text-gray-700">Don't just take our word for it. Here's what customers have to say about their experience.</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-10 max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-500 hover:shadow-2xl transition duration-300">
                    <div class="flex mb-6">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="relative mb-6">
                        <div class="absolute top-0 left-0 transform -translate-x-6 -translate-y-8 h-16 w-16 text-green-100 opacity-50">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>

                        <p class="text-gray-700 leading-relaxed">"I was able to secure financing for my dream car in just a few days. The process was seamless, and the team was incredibly supportive throughout."</p>
                    </div>
                    <div class="text-gray-900 font-semibold">- Sarah K., Dar es Salaam</div>
                </div>
                <div class="bg-white rounded-xl shadow-lg p-8 border-t-4 border-green-500 hover:shadow-2xl transition duration-300">
                    <div class="flex mb-6">
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <svg class="w-5 h-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                    </div>
                    <div class="relative mb-6">
                        <p class="text-gray-700 leading-relaxed">"The team went above and beyond to help me find the best financing option. I couldn't be happier with the service."</p>
                    </div>
                    <div class="text-gray-900 font-semibold">- James M., Arusha</div>
                </div>
            </div>
        </div>
    </div>


</div>
