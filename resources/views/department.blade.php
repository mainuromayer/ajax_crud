@extends('dashboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Department Management</h2>

        @include('department.list')
        @include('department.create')
        @include('department.update')
        @include('department.delete')
    </div>
@endsection

@section('scripts')

@endsection