@extends(backpack_view('blank'))

@section('content')
<div class="jumbotron mb-2">

    <h1 class="display-3">Welcome!</h1>

    <p>Use the sidebar to the left to create, edit or delete content.</p>

    <p class="lead">
        <a class="btn btn-primary" href="/{{ config('backpack.base.route_prefix', 'admin') }}/change2" role="button">Enter Change Management</a>
        </p>
    </div>
@endsection
