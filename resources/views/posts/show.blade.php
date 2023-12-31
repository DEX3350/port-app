@extends('layouts.apps')
@section('content')

<div class="bg-gray-50 py-16 px-4 sm:grid sm:grid-cols-12">
    <div class="sm:col-start-4 sm:col-span-6">
        <a href="/">
            <div class="bg-blue-50 hover:bg-blue-100 text-center px-4 py-3 rounded-sm shadow-sm hover:shadow-md">Back</div>
        </a>

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

            <h2 class="mt-6 text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">{{ $post -> title  }}</h2>
            <p class="mt-6 leading-6 text-gray-500">{!! preg_replace('/#(\w+)/', '<span class="text-blue-500 font-bold">#$1</span>', nl2br(old('text', $post->text))) !!}</p>
        </div>
        <h2 class="mt-6 text-4xl leading-10 tracking-tight font-bold text-gray-900 text-center">
            Comments
        </h2>
        <div class="">
            <form action="/posts/{{ $post->id }}/comments" method="POST" class="mb-0">
                @csrf
                <label for="author" class="text-sm font-medium text-gray-700">Author</label>
                <input type="text" name="author" class="mt-1 py-2 px-3 block w-full borded border-gray-400 rounded-md shadow-sm" value="{{ old('author') }}" required>

                <label for="text" class="mt-6 text-sm block font-medium text-gray-700">Text</label>
                <textarea name="text" class="mt-1 py-2 px-3 w-full borded border-gray-400 rounded-md shadow-sm" required>{{ old('text') }}</textarea>

                @if($errors->any())
                    <div class="mt-6">
                        <ul class="bg-red-100 px-4 py-5 rounded-md">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    
                @endif

                <button type="submit" class="mt-6 py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none">Post</button>

            </form>
        </div>
        <div class="mt-6">
            @foreach($comments as $comment)
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
            @endforeach

            {{ $comments->links() }}
        </div>
    </div>
</div>

@endsection