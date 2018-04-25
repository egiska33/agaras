<header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <img src="{{ url('img/agaras.png') }}" class="navbar-brand" />
        <!-- /.navbar-collapse -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false">
            <i class="fa fa-bars"></i>
        </button>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu hidden-xs">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li>
                    <!-- Menu Toggle Button -->
                    <span class="li-span">
                        <span class='syncStatusIcon'></span><span>{{ Auth::user()->name }} @role('driver')<strong>( {{ Auth::user()->plate }} )</strong>@endrole</span><br />
                    </span>
                </li>
                <li>
                    <a href="{{ url('/logout') }}" class="" id="logout"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ trans('adminlte_lang::message.signout') }}
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="submit" value="logout" style="display: none;">
                    </form>
                </li>
            </ul>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="visible-xs mobile-auth">
                    <!-- Menu Toggle Button -->
                    <span class="li-span">
                        <span class='syncStatusIcon'></span><span>{{ Auth::user()->name }} @role('driver')<strong>( {{ Auth::user()->plate }} )</strong>@endrole</span><br />
                    </span>
                </li>

                <li id="nav-animals"><a href="{{ url('o/animals') }}"><i class="fa fa-github-alt" aria-hidden="true"></i> <span>{{ trans('adminlte_lang::message.animals') }}</span></a></li>
                <li id="nav-sellers"><a href="{{ url('o/sellers') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>{{ trans('adminlte_lang::message.sellers') }}</span></a></li>
                <li id="nav-routes"><a href="{{ url('o/routes') }}"><span><i class="fa fa-globe" aria-hidden="true"></i> {{ trans('adminlte_lang::message.routes') }}</span></a></li>
                <li id="nav-documents"><a href="{{ url('o/documents') }}"><span><i class="fa fa-book" aria-hidden="true"></i> {{ trans('adminlte_lang::message.documents') }}</span></a></li>
                <li class="visible-xs mobile-logout">
                    <a href="{{ url('/logout') }}" class="" id="logout"
                       onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        {{ trans('adminlte_lang::message.signout') }}
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="submit" value="logout" style="display: none;">
                    </form>
                </li>
            </ul>
        </div>
      </div>
      <!-- /.container-fluid -->
    </nav>
</header>

  <script>
        var currURL = window.location.href.split('/');

        var navURLs = ['animals', 'sellers', 'routes', 'documents'];

        for(var uex = 0; uex < navURLs.length; uex++)
        {
            var navURL = navURLs[uex];
            if(currURL.includes(navURL))
            {
                var targetElem = document.getElementById("nav-"+navURL);

                targetElem.className += " active";

                break;
            }
        }
  </script>
