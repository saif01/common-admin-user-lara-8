@extends('layouts.admin.master')
@section('title', 'Admin All')

@push('styles')

@endpush

@section("content")

    @livewire('admin.users.all')

@endsection

