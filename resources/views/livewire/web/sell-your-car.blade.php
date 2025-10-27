{{-- resources/views/livewire/web/sell-your-car.blade.php --}}
<div class="min-h-screen bg-gray-50">
    {{-- Hero Section --}}
    <div class="bg-gradient-to-r from-green-600 to-green-700 text-white py-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Sell your car</h1>
            <p class="text-xl md:text-2xl text-green-100">You're in control, choose how you want to sell your car.</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        {{-- Two Cards Section with Background Container --}}
        <div class="relative" style="height: 600px; margin-bottom: 300px;">
            {{-- Background Card with Image - Fixed Height --}}
            <div class="absolute inset-0 overflow-hidden" style="height: 600px; background-image: url('{{ asset('/images/sxv.png') }}'); background-size: cover; background-position: center;">
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/30 to-transparent"></div>
            </div>
            
            {{-- Content Cards Container - Positioned to overlap --}}
            <div class="relative grid md:grid-cols-2 gap-6 p-6" style="top: 250px; position: absolute; left: 0; right: 0;">
                {{-- Card 1: Advertise on Kiboauto --}}
                <div class="bg-white overflow-hidden transform hover:scale-[1.02] transition-transform duration-300" style="min-height: 550px;">
                    <div class="p-8 h-full flex flex-col">
                        <div class="flex-1">
                            <div class="mb-6">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Advertise on Kiboauto</h2>
                                <div class="w-16 h-1 bg-green-600"></div>
                            </div>
                            
                            <p class="text-lg font-semibold text-green-700 mb-8">Maximise your selling price</p>
                            
                            <div class="space-y-4 mb-8">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed pt-1">Advertise to over 10 million people each month—4x more than any other site*</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed pt-1">Your sale, your terms. Sell when you're happy with the offer</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <a href="{{ auth()->check() ? route('my.vehicles') : route('login') }}" class="block w-full text-center px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Start an advert
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Card 2: Sell fast for free --}}
                <div class="bg-white overflow-hidden transform hover:scale-[1.02] transition-transform duration-300" style="min-height: 500px;">
                    <div class="p-8 h-full flex flex-col">
                        <div class="flex-1">
                            <div class="mb-6">
                                <h2 class="text-3xl font-bold text-gray-900 mb-2">Sell fast for free</h2>
                                <div class="w-16 h-1 bg-green-600"></div>
                            </div>
                            
                            <p class="text-lg font-semibold text-green-700 mb-8">Sell in as little as 48 hours**</p>
                            
                            <div class="space-y-4 mb-8">
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed pt-1">Get the best price from thousands of verified dealers</p>
                                </div>
                                <div class="flex items-start gap-3">
                                    <div class="flex-shrink-0 w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <p class="text-gray-700 leading-relaxed pt-1">Free collection and same-day payment</p>
                                </div>
                            </div>
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <a href="{{ route('sell.fast.free') }}" class="block w-full text-center px-8 py-4 bg-green-600 text-white font-semibold rounded-lg hover:bg-green-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                                Sell for free
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Trust Badge Section --}}
        <div class="relative mb-16 bg-gray-800" style="min-height: 380px;">
            {{-- Background Image - Takes up most of the space --}}
            <div class="absolute inset-0 overflow-hidden" style="background-image: url('{{ asset('images/kiboauto.png') }}'); background-size: cover; background-position: center; opacity: 0.4;">
            </div>
            
            {{-- Content Card Positioned on the Right --}}
            <div class="relative grid md:grid-cols-3 items-center h-full" style="min-height: 400px;">
              
            {{-- Content Card --}}
                <div class="md:col-span-2 bg-white rounded-xl shadow-2xl p-4 m-4 md:m-8">
                    <div class="text-center mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Join thousands of happy sellers</h3>
                    </div>
                    
                    <div class="grid md:grid-cols- gap-6 items-center">
                        {{-- Logo Section --}}
                       
                        {{-- Rating & Review Section --}}
                        <div class="space-y-3">
                            <div>
                                <div class="text-4xl font-bold text-green-600 mb-1">4.7/5</div>
                                <p class="text-sm text-gray-600">Score based on 103,695 reviews</p>
                            </div>

                            <div class="bg-green-50 border-l-4 border-green-500 p-3 rounded">
                                <p class="text-sm text-gray-700 italic leading-relaxed">
                                    "Very easy to use Kiboauto. Sold the car at a bargain price quickly and smoothly."
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center mt-6">
                        <a href="#" class="inline-flex items-center text-green-600 hover:text-green-700 font-semibold transition-colors">
                            Read more Trustpilot reviews
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                </div>


            
            {{-- Empty space on left --}}
                <div class="hidden md:block"></div>
                
               
            </div>
        </div>

        {{-- How It Works Section --}}
        <div class="bg-white rounded-xl shadow-lg p-8 mb-16">
            <div class="grid md:grid-cols-2 gap-8">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Advertise on Kiboauto</h3>
                    <p class="text-gray-700 mb-4">With Tanzania's largest audience of car buyers, it's highly likely someone is currently searching our website for the car that's sat on your driveway. Speak with potential buyers directly to answers any questions and negotiate price.</p>
                </div>
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Sell fast for free</h3>
                    <p class="text-gray-700 mb-4">Once you've answered a few questions and uploaded your images, our partner Dealer Auction will take it from there! Once your listing is live, you could receive your highest offer within 48 hours.</p>
                </div>
            </div>
        </div>

        {{-- How to Sell Section --}}
        <div class="mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">How to sell your car, fast</h2>
            <div class="space-y-8 max-w-3xl mx-auto">
                <div class="flex items-start gap-6 pb-8 border-b border-gray-200">
                    <img src="{{ asset('sellyourcar/camera.svg') }}" alt="Take great photos" class="w-32 h-32 flex-shrink-0">
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Take great photos</h3>
                        <p class="text-gray-600">Taking good-quality photos means that the buyers have an accurate image of the car, and there won't be any issues after the sale.</p>
                    </div>
                </div>
                
                <div class="flex items-start gap-6 pb-8 border-b border-gray-200">
                    <img src="{{ asset('sellyourcar/keepItSnappy.svg') }}" alt="Keep it snappy" class="w-32 h-32 flex-shrink-0">
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Keep it snappy</h3>
                        <p class="text-gray-600">There are a few documents you'll need to make sure you have before you sell your car. <a href="#" class="text-green-600 hover:underline">Learn more about documents needed to sell</a></p>
                    </div>
                </div>
                
                <div class="flex items-start gap-6">
                    <img src="{{ asset('sellyourcar/be-honest.svg') }}" alt="Be honest" class="w-32 h-32 flex-shrink-0">
                    <div>
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Be honest</h3>
                        <p class="text-gray-600">Make sure your vehicle description is accurate. Mention any faults, like scratches, so buyers know what they're getting ahead of time.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Guides Section --}}
        <div class="mb-16 bg-white rounded-xl shadow-lg p-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-8 text-center">Guides to selling your car</h2>
            <div class="flex flex-col md:flex-row items-stretch justify-center gap-8 max-w-6xl mx-auto">
                <div class="flex-1 text-center border-r border-gray-300 pr-8 last:border-r-0 last:pr-0">
                    <a href="#" class="block hover:opacity-80 transition-opacity duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Preparing your car</h3>
                        <p class="text-gray-600">From keeping it clean to sorting repairs, here's how to get your car ready for sale.</p>
                    </a>
                </div>
                
                <div class="flex-1 text-center border-r border-gray-300 pr-8 last:border-r-0 last:pr-0">
                    <a href="#" class="block hover:opacity-80 transition-opacity duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Creating your advert</h3>
                        <p class="text-gray-600">Good-quality adverts lead to a fast sale. Read our tips to create an effective advert.</p>
                    </a>
                </div>
                
                <div class="flex-1 text-center border-r border-gray-300 pr-8 last:border-r-0 last:pr-0">
                    <a href="#" class="block hover:opacity-80 transition-opacity duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Taking payment</h3>
                        <p class="text-gray-600">Cash, bank transfer, cheque? Learn the best way to accept payment and keep yourself secure.</p>
                    </a>
                </div>
                
                <div class="flex-1 text-center">
                    <a href="#" class="block hover:opacity-80 transition-opacity duration-300">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3">Avoiding scams</h3>
                        <p class="text-gray-600">Learn how to stay safe online and protect yourself from fraud.</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
