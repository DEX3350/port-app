@extends('layouts.apps')

@section('content')
    <div class="bg-gray-50 py-16 px-4 sm:grid sm:grid-cols-12">
        <a href="/" class="sm:col-start-4 sm:col-span-6">
            <div class="bg-blue-50 hover:bg-blue-100 text-center px-4 py-3 rounded-sm shadow-sm hover:shadow-md">Back</div>
        </a>

        @if ($posts->isEmpty())
            <div class="sm:col-start-4 sm:col-span-6">
                <div class="bg-white mt-4 px-4 py-6 rounded-sm shadow-sm">
                    <p class="text-gray-500 text-center">No results found for your search query.</p>
                </div>
            </div>

        @elseif (!$query)
        <div class="sm:col-start-4 sm:col-span-6">
            <div class="bg-white mt-4 px-4 py-6 rounded-sm shadow-sm">
                <p class="text-gray-500 text-center">Nothing searched yet. Enter a search query and click the button.</p>
            </div>
        </div>

        @else
            @foreach ($posts as $post)
                <div class="sm:col-start-4 sm:col-span-6">
                    <div class="bg-white mt-4 px-4 py-6 rounded-sm shadow-sm">
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                
                                <img class="h-10 w-10 rounded-full" src='https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription01&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light' alt="my avatar">
                                
                            </div>

                            <div class="ml-3">
                                <p class="text-sm leading-5 font-medium text-gray-900">Deepanshu Panwar</p>
                                <div class="flex text-sm leading-5 text-gray-500">
                                    <time datetime="{{ $post->created_at ?? now() }}">
                                        {{ optional($post->created_at)->diffForHumans() ?? 'Date unknown' }}
                                    </time>
                                    <span class="mx-1">&middot;</span>
                                    <span>{{ ceil(strlen($post->text ?? '') / 863) }} min read</span>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 rounded-sm overflow-hidden">
                            <img class="h-48 w-full object-cover" src="https://images.pexels.com/photos/919734/pexels-photo-919734.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="jiko image">
                        </div>

                        <h2 class="mt-6 text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">{{ $post->title }}</h2>
                        <p class="mt-6 leading-6 text-gray-500">{!! preg_replace('/#(\w+)/', '<span class="text-blue-500 font-bold">#$1</span>', $post->text) !!}</p>

                        <!-- Display Comments -->
                        @foreach($post->comments as $comment)
                            <!-- Your HTML structure to display comments, similar to how it's displayed in show.blade.php -->
                            <div class="mt-6">
                                
                                    <div class="mb-5 bg-white px-4 py-6 rounded-lg shadow-sm">
                                        <div class="flex">
                                            {{-- Avatar --}}
                                            <div class="mr-3 flex flex-col justify-center">
                                                <div>
                                                    <?php
                                                        $parts = explode(' ', $comment->author);
                                                        $initials = strtoupper($parts[0][0] . $parts[count($parts) - 1][0]);
                                                    ?>
                                                    <span class="bg-gray-300 p-3 rounded-full">{{ $initials }}</span>
                                                </div>
                                            </div>
                                            {{-- Avatar --}}
                                            
                                            <div class="flex flex-col justify-center">
                                                <p class="mr-2 font-bold">{{ $comment->author }}</p>
                                                <p class="text-gray-600">{{ $comment->created_at->diffForHumans() }}</p>
                                            </div>
                                        </div>
                    
                                        <div class="mt-3 px-5 bg-gray-50 rounded-lg">
                                            <p>{!! preg_replace('/#(\w+)/', '<span class="text-blue-500 font-bold">#$1</span>', $comment->text) !!}</p>
                                        </div>
                                        @auth
                                        <form action="/comments/{{ $comment->id }}" method="POST" class="mb-0 mt-3">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm py-1 px-2 text-white bg-red-500 hover:bg-red-700 border border-gray-400 shadow-sm rounded-md hover:shadow-md">Delete</button>
                                        </form>
                                        @endauth
                    
                                    </div>

                            </div>
                        @endforeach

                        
                    </div>
                </div>
            @endforeach
        @endif
       
    </div>
@endsection
