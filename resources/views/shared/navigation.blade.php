<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{url('/')}}"><img src="/assets/icons/android-chrome-512x512.png" alt="brand logo" class="brand">{{config('app.name', 'AquaFun')}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            @guest
                <ul class="navbar-nav ml-auto">
{{--                    Aangezien gebruikers niet moeten kunnen inloggen/registreren, worden deze opties verwijderd--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="/login">Aanmelden</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a class="nav-link" href="/register">Registreren</a>--}}
{{--                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="/contact-us">Contact</a>
                    </li>
                </ul>
            @endguest
            @auth
                <div class="nav-item ml-auto dropdown">
                    <a class="nav-link dropdown-toggle" href="#!" data-toggle="dropdown">
                        {{ auth()->user()->name }}
{{--                        <span class="caret"></span>--}}
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="/contact-us">Contact</a>
                        <a class="dropdown-item" href="/profile">Profiel bewerken</a>
                        <a class="dropdown-item" href="/profile/resetpassword">Wachtwoord wijzigen</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="/logout">Afmelden</a>
                        @if(auth()->user()->teacher)
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/watch">Zwemlessen bekijken</a>
                        @endif
                        @if(auth()->user()->admin)
                            <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/assets/docs/instructies.pdf">Help</a>
                                <a class="dropdown-item" href="/admin/meals/">Maaltijden beheren</a>
                                <a class="dropdown-item" href="/admin/schools/">Scholen beheren</a>
                                <a class="dropdown-item" href="/admin/rates/">Tarieven instellen</a>
                                <a class="dropdown-item" href="/admin/teachers">Zwemleraren beheren</a>
                                <a class="dropdown-item" href="/admin/zwemles/">Zwemles beheren</a>
                                <a class="dropdown-item" href="/admin/zwemmers/">Zwemmers toekennen aan Zwemles</a>
                                <a class="dropdown-item" href="/admin/zwemmers/lijst">Zwemmers beheren</a>
                                <a class="dropdown-item" href="/admin/zwemfeest">Zwemfeest beheren</a>
                        @endif
                    </div>
                </div>
            @endauth
        </div>
    </div>
</nav>
