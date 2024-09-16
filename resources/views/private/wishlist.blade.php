<!DOCTYPE html>
<html lang="en">
<head>
    @extends('components.head')
    @section('title' , 'Wishlist')
    @section('adds')
        <link rel="stylesheet" href="{{asset("css/rate.css")}}">
    @endsection
</head>
<body>
    
    <!-- Start Header -->
    @extends('components.header')
    <!-- End Header -->
    
    <section class="wishlist">
        @if (count($wishlist->jobs) == 0 && count($wishlist->users) == 0)
            <div class="start">
                <i class="fa-solid fa-heart"></i>
                <h1>Wishlists</h1>
                <p>You Don't Have any Wishlists</p>
                <a href="/jobs" class="btn">Explore Now</a>      
            </div>
        @else
            <div class="jobs">
                <h2>Jobs:</h2>
                @if (count($wishlist->jobs) > 0)
                    <ul>
                        @foreach($wishlist->jobs as $job)
                            <li>
                                <a href="/projects/{{ $job->id }}">{{ $job->title }}</a>
                                {{-- Delete --}}
                                <form action="/destroy-job/{{ $job->id }}" method="POST">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else 
                    <p class="not-found">Don't Have Jobs In Wishlist</p>
                @endif
            </div>
            <div class="users">
                <h2>Users:</h2>
                @if (count($wishlist->users) > 0)
                    <ul>
                        @foreach($wishlist->users as $user)
                            <li>
                                <a href="/freelancers/{{ $user->id }}">{{ $user->title }}</a>
                                <form action="/destroy-user/{{ $user->id }}" method="POST">
                                    @csrf
                                    
                                    <button type="submit" class="btn btn-delete"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                @else 
                    <p class="not-found">Don't Have Users In Wishlist</p>
                @endif
            </div>
        @endif

    </section>

    <!-- Start Footer  -->
    @extends('components.footer')
    <!-- End Footer  -->

    <script src="{{ asset('js/rate.js') }}"></script>
</body>
</html>