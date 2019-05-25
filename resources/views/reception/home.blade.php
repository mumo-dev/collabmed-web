@extends('layouts.app')

@section('sidebar')
  @include('reception._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Reception Department</h6>
@endsection

@section('content')

<div class="card">
    <div class="card-header bg-white">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        You are logged in as receptionist!
    </div>
</div>
     
@endsection
