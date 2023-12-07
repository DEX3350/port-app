@extends('layouts.apps')

@section('content')

<div class="bg-gray-50 py-16 px-4 sm:px-6 lg:px-8">
    <div class="text-center">
        <h2 class="text-4xl leading-10 tracking-tight font-bold text-gray-900">My Self Introduction</h2>
        <p class="max-w-2xl mx-auto mt-5 text-xl leading-7 text-gray-500">
            I am Deepanshu Panwar from the multi-diverse country India.<br>
             My friends in India Call me Deepu and in Japan, Deep<br>
             Here i will tell you all about my life.<br>
        </p>
    </div>
    
    @auth
        <a href="{{ url('/posts/new') }}" class="mt-6 py-2 px-4 w-full border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none justify-center">New Post</a>
    @endauth

    {{-- Posts Wrapper --}}
    <div class="mt-12 grid gap-5 max-w-lg mx-auto lg:grid-cols-3 lg:max-w-none">
        @foreach ($posts as $post)
            {{-- Post --}}
            <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                {{-- Header --}}
                <div class="flex-shrink-0">
                    <img class="h-48 w-full object-cover" src="https://images.pexels.com/photos/919734/pexels-photo-919734.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1" alt="jiko image">
                </div>

                {{-- Content --}}
                <div class="flex-1 p-6 flex flex-col justify-between">
                    <div class="flex-1">
                        <a href="/posts/{{ $post->id }}">
                            <h3 class="mt-2 text-xl leading-7 font-semibold text-gray-900">{{ $post->title }}</h3>
                        </a>
                        <p class="mt-3 text-base leading-6 text-gray-500">
                            @if (strlen($post->text) > 200)
                                {!! preg_replace('/#(\w+)/', '<span class="text-blue-500 font-bold">#$1</span>', substr($post->text, 0, 200)) !!}...
                            @else
                                {!! preg_replace('/#(\w+)/', '<span class="text-blue-500 font-bold">#$1</span>', $post->text) !!}
                            @endif
                        </p>
                    </div>

                    <div class="mt-6 flex justify-between items-center">
                        <div>
                            <div class="flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src='https://avataaars.io/?avatarStyle=Transparent&topType=ShortHairShortCurly&accessoriesType=Prescription01&hairColor=BrownDark&facialHairType=Blank&clotheType=BlazerShirt&eyeType=Default&eyebrowType=Default&mouthType=Default&skinColor=Light' alt="my avatar">
                                </div>

                                <div class="ml-3">
                                    <p class="text-sm leading-5 font-medium text-gray-900">Deepanshu Panwar</p>
                                    <div class="flex text-sm leading-5 text-gray-500">
                                        <time datetime="{{ $post->created_at }}">
                                            {{ $post->created_at->diffForHumans() }}
                                        </time>
                                        <span class="mx-1">&middot;</span>
                                        <span>{{ ceil(strlen($post->text) / 863) }} min read</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @auth
                            {{-- Buttons --}}
                            <div class="flex flex-wrap justify-end mt-4">
                                <a href="{{ route('posts.edit',$post->id) }}" class="text-sm py-1 px-2 mb-2 md:mb-0 md:mr-2 border text-white bg-indigo-400 hover:bg-indigo-700 border-indigo-400 shadow-sm rounded-md hover:shadow-md">Update</a>
                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-sm py-1 px-2 border text-white bg-red-400 hover:bg-red-700 border-red-400 shadow-sm rounded-md hover:shadow-md">Delete</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
