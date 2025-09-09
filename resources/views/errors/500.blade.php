<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Something went wrong</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <style>body{font-family: 'Inter', sans-serif;}</style>
    <meta name="robots" content="noindex">
 </head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center p-6">
    <div class="max-w-lg w-full text-center">
        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-red-100 text-red-600 mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>
        <h1 class="text-3xl font-semibold text-gray-900">Something went wrong</h1>
        <p class="mt-3 text-gray-600">We’re experiencing an internal error. Please try again later.</p>
        <div class="mt-6 flex items-center justify-center gap-3">
            <a href="/" class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-md">Go to Home</a>
            <a href="javascript:history.back()" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-md">Go Back</a>
        </div>
        <div class="mt-8 text-xs text-gray-400">Error code: 500</div>
    </div>
</body>
</html>


