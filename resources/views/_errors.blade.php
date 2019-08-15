@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if (session('error'))
    <div class="alert alert-success">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <ul class="alert alert-danger padding-lg">
        @foreach ($errors->all() as $error)
            <li class=''>{{$error}}</li>
        @endforeach
    </ul>
@endif