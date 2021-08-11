<nav class="navbar navbar-expand-md navbar-light bg-primary mb-2 sticky-top">
    <a class="navbar-brand mx-1 mx-5" href="{{ route('index') }}">
        <img src="{{ asset('media/logo.png') }}" class="img-fluid" width="60" alt="Logo">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <!-- Left Side Of Navbar -->
        <ul class="navbar-nav">

            <li class="nav-item ml-4">
                <a class="nav-link" href="{{ route('index') }}">Startseite</a>
            </li>

        </ul>

        <!-- Right Side of Navbar -->
        <ul class="navbar-nav mr-5 ml-auto">

            <li class="nav-item mx-5">
                <span class="nav-link">{{ auth()->user()->email }}</span>
            </li>

            <li class="nav-item large dropdown d-none d-md-block">
                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-users-cog"></i><span class="caret"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">

                    <a class="dropdown-item" href="{{ route('profile') }}">Konto</a>


                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <input type="submit" class="dropdown-item" value="{{ __('Logout') }}">
                    </form>

                </div>
            </li>

        </ul>

    </div>
</nav>
