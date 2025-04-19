@extends('dashboard')

@section('content')
    <div class="container">
        <h2 class="mb-4">Employee Management</h2>


        @include('employee.list')
        @include('employee.create')
        @include('employee.update')
        @include('employee.delete')
    </div>
@endsection

@section('scripts')

@endsection
