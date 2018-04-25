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
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li>
                        <!-- Menu Toggle Button -->
                        <span class="li-span">
                            <span>{{ Auth::user()->name }} @role('driver')<strong>( {{ Auth::user()->plate }} )</strong>@endrole</span><br />
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
                @endif
            </ul>
        </div>
        <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="visible-xs mobile-auth">
                    <!-- Menu Toggle Button -->
                    <span class="li-span">
                        <span>{{ Auth::user()->name }} @role('driver')<strong>( {{ Auth::user()->plate }} )</strong>@endrole</span><br />
                    </span>
                </li>
                @hasanyrole('superadmin|driver')
                    <li @if(Request::is('animals') || Request::is('animals/*') )class="active"@endif><a href="{{ url('animals') }}"><i class="fa fa-github-alt" aria-hidden="true"></i> <span>{{ trans('adminlte_lang::message.animals') }}</span></a></li>
                    <li @if(Request::is('sellers') || Request::is('sellers/*') )class="active"@endif><a href="{{ url('sellers') }}"><i class="fa fa-handshake-o" aria-hidden="true"></i> <span>{{ trans('adminlte_lang::message.sellers') }}</span></a></li>
                @endhasanyrole
                @role('superadmin')
                    <li @if(Request::is('drivers') || Request::is('drivers/*') )class="active"@endif><a href="{{ url('drivers') }}"><span><i class="fa fa-truck" aria-hidden="true"></i> {{ trans('adminlte_lang::message.drivers') }}</span></a></li>
                    <li @if(Request::is('managers') || Request::is('managers/*') )class="active"@endif><a href="{{ url('managers') }}"><span><i class="fa fa-black-tie" aria-hidden="true"></i> {{ trans('adminlte_lang::message.managers') }}</span></a></li>
                @endrole
                <li @if(Request::is('routes') || Request::is('routes/*') )class="active"@endif><a href="{{ url('routes') }}"><span><i class="fa fa-globe" aria-hidden="true"></i> {{ trans('adminlte_lang::message.routes') }}</span></a></li>
                @hasanyrole('manager')
                    <li @if(Request::is('drivers-statistics') || Request::is('drivers-statistics/*') )class="active"@endif><a href="{{ url('drivers-statistics') }}"><span><i class="fa fa-truck" aria-hidden="true"></i> {{ trans('adminlte_lang::message.driversStatistics') }}</span></a></li>
                @endhasanyrole
                @hasanyrole('superadmin|driver')
                    <li @if(Request::is('documents') || Request::is('documents/*') )class="active"@endif><a href="{{ url('documents') }}"><span><i class="fa fa-book" aria-hidden="true"></i> {{ trans('adminlte_lang::message.documents') }}</span></a></li>
                @endhasanyrole
                @hasanyrole('superadmin|manager')
                    <li @if(Request::is('uploads/files') || Request::is('uploads/files/*') )class="active"@endif><a href="{{ url('uploads/files') }}"><span><i class="fa fa-arrow-up" aria-hidden="true"></i> {{ trans('adminlte_lang::message.uploads') }}</span></a></li>
                @endhasanyrole
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
