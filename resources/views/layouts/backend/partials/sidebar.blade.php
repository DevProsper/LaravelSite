<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            <img src="/storage/profile/{{ Auth::user()->image }}" width="48" height="48" alt="User" />
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{Auth::user()->name}}</div>
            <div class="email">{{Auth::user()->email}}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                <ul class="dropdown-menu pull-right">
                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            <i class="material-icons">input</i> Deconnection
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            @if(Request::is('admin*'))
                <li class="{{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{route('admin.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Accueil</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/tag*') ? 'active' : '' }}">
                    <a href="{{route('admin.tag.index')}}">
                        <i class="material-icons">label</i>
                        <span>Gestion de Tag</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/categories*') ? 'active' : '' }}">
                    <a href="{{route('admin.categories.index')}}">
                        <i class="material-icons">apps</i>
                        <span>Gestion des categories</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/post*') ? 'active' : '' }}">
                    <a href="{{route('admin.post.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Gestion des posts</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/pending/post') ? 'active' : '' }}">
                    <a href="{{route('admin.post.pending')}}">
                        <i class="material-icons">library_books</i>
                        <span>Post en attente</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/favorite') ? 'active' : '' }}">
                    <a href="{{route('admin.favorite.index')}}">
                        <i class="material-icons">favorite</i>
                        <span>Favoris du post</span>
                    </a>
                </li>

                <li class="{{ Request::is('admin/subscriber') ? 'active' : '' }}">
                    <a href="{{route('admin.subscriber.index')}}">
                        <i class="material-icons">subscriptions</i>
                        <span>Liste des souscription</span>
                    </a>
                </li>

                <li class="header">Systeme</li>

                <li class="{{ Request::is('admin/settings') ? 'active' : '' }}">
                    <a href="{{route('admin.settings')}}">
                        <i class="material-icons">settings</i>
                        <span>Parametres</span>
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif

            @if(Request::is('author*'))
                <li class="{{ Request::is('author/dashboard') ? 'active' : '' }}">
                    <a href="{{route('author.dashboard')}}">
                        <i class="material-icons">home</i>
                        <span>Accueil</span>
                    </a>
                </li>

                <li class="{{ Request::is('author/post*') ? 'active' : '' }}">
                    <a href="{{route('author.post.index')}}">
                        <i class="material-icons">library_books</i>
                        <span>Gestion des posts</span>
                    </a>
                </li>

                <li class="header">Systeme</li>
                <li>
                    <a class="dropdown-item" href="{{ route('logout') }}"
                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                        <i class="material-icons">input</i>
                        <span>Logout</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            &copy; 2016 - 2017 <a href="javascript:void(0);">AdminBSB - Material Design</a>.
        </div>
        <div class="version">
            <b>Version: </b> 1.0.5
        </div>
    </div>
    <!-- #Footer -->
</aside>