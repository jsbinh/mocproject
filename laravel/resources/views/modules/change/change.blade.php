@extends('crud::list')
{{-- @extends(backpack_view('blank')) --}}

@section('content')
    <div id="module-change" class="vuetify">
        <change-container-component />
    </div>
@endsection

@push('crud_list_styles')
    <!-- Styles -->
    <link href="{{ mix('modules/change/css/app.css') }}" rel="stylesheet">
@endpush

@push('crud_list_scripts')
    <script>
    // global baseRoute
    var baseRoute = "/{{ config('backpack.base.route_prefix', 'admin') }}";
    </script>

    <script src="{{ mix('modules/change/js/manifest.js') }}" defer></script>
    <script src="{{ mix('modules/change/js/vendor.js') }}" defer></script>
    <script src="{{ mix('modules/change/js/app.js') }}" defer></script>
@endpush
