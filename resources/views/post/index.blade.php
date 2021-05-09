@extends('layouts.app')
@section('content')
  <section class="flex justify-center">
    <div class="w-8/12 bg-white p-6 rounded-lg">
        
      <form action="{{route('posts')}}" method="post">
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

    </div>
  </section>
@endsection