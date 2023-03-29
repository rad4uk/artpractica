@extends('layouts.main')

@push('styles')
    @vite(['resources/sass/frontend/design.scss'])
@endpush

@section('content')
    <design-tabs></design-tabs>


    @include('frontend.partials.feedback')
@endsection

@push('scripts')
    @vite(['resources/js/frontend/design.js'])
@endpush
