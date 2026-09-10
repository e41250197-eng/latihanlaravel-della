@extends('layout')

@section('title', 'Home Page Della')

@push('styles')
<style>
    body { font-family: sans-serif; padding: 20px; }
</style>
@endpush

@section('content')
    <h1>Welcome to the Home Page Della</h1>
    <p>This is a paragraph Della</p>

    <hr>

    {{-- Conditional Rendering @if --}}
    @if ($role == 'admin')
        <p>Welcome, Admin!</p>
    @elseif ($role == 'editor')
        <p>Welcome, Editor!</p>
    @else
        <p>Welcome, User!</p>
    @endif

    <hr>

    {{-- Conditional Rendering @switch --}}
    @switch($status)
        @case('pending')
            <p>Order Pending</p>
            @break
        @case('completed')
            <p>Order Completed</p>
            @break
        @default
            <p>Unknown order status</p>
            @break
    @endswitch
@endsection

@push('scripts')
<script>
    console.log("Halaman Home Della berhasil dimuat!");
</script>
@endpush
