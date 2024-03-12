<header>
    <div>
        <h1>Todo list App</h1>
    </div>
    <div class="header__infos">
        @auth
        <div>
            <div>
                <img class="header__image" src="{{ asset('/storage/'. Auth::user()->image ) }}" alt="">
            </div>
            <div>
                {{ Auth::user()->name }}
            </div>
        </div>
            <div>
                <a class="link" href="{{ route('auth.logout') }}">Logout</a>
            </div>
        @endauth
    </div>
</header>
