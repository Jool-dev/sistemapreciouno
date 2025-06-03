@extends('intranet/layout')
@section('title', 'Dashboard')

@section('content')
    <div class="enable-scroll">
        @livewire('dashboard.dashboard')
    </div>
@endsection
