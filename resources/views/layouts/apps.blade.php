<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>JIKO</title>
</head>
<body>
    @if (Route::has('login'))
    <div class="bg-gray-200 p-4 md:p-6 text-center">
        <div class="flex flex-wrap justify-between items-center">
            <!-- Image -->
            <a href="{{ url('/') }}" class="mb-4 md:mb-0">
                <img class="h-12 w-12 rounded-full" src='https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription01&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light' alt="my avatar">
            </a>
            
            <!-- Search bar -->
            <div class="flex justify-center items-center mb-4 md:mb-0 md:mx-auto">
                <form action="{{ route('search') }}" method="GET" class="flex">
                    <input type="text" name="query" class="py-2 px-4 border border-gray-300 rounded-md focus:outline-none focus:border-indigo-400" placeholder="Search...">
                    <button type="submit" class="py-2 px-4 bg-indigo-600 text-white rounded-md ml-2">Search</button>
                </form>
            </div>
    
            <!-- Login/Logout -->
            @auth
                <form method="POST" action="{{ route('logout') }}" class="mb-4 md:mb-0">
                    @csrf
                    <button type="submit" class="text-sm py-1 px-2 border text-white bg-indigo-400 hover:bg-indigo-700 border-indigo-400 shadow-sm rounded-md hover:shadow-md">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">Log in</a>
            @endauth
        </div>
    </div>
@endif

    <div id="app">
        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>