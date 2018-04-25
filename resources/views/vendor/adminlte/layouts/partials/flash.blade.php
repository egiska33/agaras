@if (Session::has('flash_message_success'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('flash_message_success') }}
    </div>
@endif

@if (Session::has('flash_message_error'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        {{ Session::get('flash_message_error') }}
    </div>
@endif

@if (Session::has('flash_message_multiple'))
    @foreach(Session::get('flash_message_multiple') as $message)
        @foreach($message as $type => $text)
            <div class="alert alert-{{ $type }} alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                {{ $text }}
            </div>
        @endforeach
    @endforeach
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif