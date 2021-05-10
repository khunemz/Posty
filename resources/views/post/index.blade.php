@extends('layouts.app')
@section('content')
  <section class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        
      <form action="{{route('posts')}}" method="post" class="mb-4">
        <div class="mb-4">
          @csrf
          <label for="body" id="body" class="sr-only">
            body
          </label>
          <textarea name="body" id="body" cols="30" class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('body') border-red-500 @enderror"
          placeholder="Post something !!"
          ></textarea>

          @error('body')
            <div class="text-red-500 mt-2 text-small">
              {{ $message }}
            </div>
          @enderror
        </div>

        <div>
          <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">
            Post
          </button>
        </div>
      </form>

      @if ($posts->count())
          @foreach ($posts as $post)
              <div class="mb-4">
                <a href="" class="font-bold">{{ $post->user->username }} 
                  <span class="text-gray-600 text-small">{{ $post->updated_at->diffForHumans() }}</span></a>
                <p class="mb-2">{{$post->body}}</p>

                <div class="flex items-center">
                  @auth
                    @can('delete', $post)
                      <form action="{{route('posts.destroy',$post) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">
                          Delete</button>
                      </form>
                    @endcan
                    
                    @if(!$post->likedBy(auth()->user()))
                      <form action="{{ route('posts.likes', $post)}}" method="post" class="mr-1">
                        @csrf
                        <button type="submit" class="text-blue-500">Like</button>
                      </form>
                    @else
                      <form action="{{ route('posts.likes', $post)}}" method="post" class="mr-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-blue-500">
                          Unlike
                        </button>
                      </form>
                    @endif
                  @endauth
                  <span>{{ $post->likes->count() }} {{ Str::plural('like',$post->likes->count()) }}</span>
                </div>
              </div>
          @endforeach

          {{ $posts->links() }}
      @else
          <div class=""><p>No data to show</p></div>
      @endif
              
    </div>
  </section>
@endsection

@section('scripts')
@endsection