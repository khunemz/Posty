<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laravel app</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100">
  <div>
    <nav class="p-6 bg-white flex justify-between mb-6">
      <ul class="flex items-center">
        <li>
          <a class="p-3" href="/">Home</a>
        </li>
        <li>
          <a class="p-3" href="{{ route('dashboard') }}">Dashboard</a>
        </li>
        <li>
          <a class="p-3" href="{{ route('posts') }}">Post</a>
        </li>
      </ul>

      <ul class="flex items-center">
        @auth
          <li>
            <a class="p-3" href="">Logged in as : {{ auth()->user()->username}}</a>
          </li>
          <li>
            <form action="{{ route('logout') }}" method="post" class="inline">
              @csrf
              <button type="submit">Logout</button>
            </form>
          </li>
        @endauth
        @guest
          <li>
            <a class="p-3" href="{{ route('login') }}">Login</a>
          </li>
          <li>
            <a class="p-3" href="{{ route('register') }}">Register</a>
          </li>
        @endguest
      </ul>
    </nav>
    <div class="content">
      @yield('content')
    </div>
  </div>
</body>
</html>