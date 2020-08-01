@extends('crud::list')
{{-- @extends(backpack_view('blank')) --}}

@section('content')
    <div id="module-change" class="vuetify">
        <change-container-component />
    </div>
@endsection

@push('crud_list_styles')
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ mix('modules/change/css/app.css') }}" rel="stylesheet">
@endpush

@push('crud_list_scripts')
    <script src="{{ mix('modules/change/js/manifest.js') }}" defer></script>
    <script src="{{ mix('modules/change/js/vendor.js') }}" defer></script>
    <script src="{{ mix('modules/change/js/app.js') }}" defer></script>
@endpush
