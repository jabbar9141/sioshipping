<div>
    @if (count($errors))
        <div class="alert alert-danger alert-dismissible">
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif
    @if (Session::has('message') or isset($message))
        <div class="alert alert-{{ Session::get('message_type', ($message_type ?? 'danger')) }} alert-dismissable">
            <strong>Message &nbsp;</strong> {{ Session::get('message') ?? $message }}
        </div>
    @endif
</div>
