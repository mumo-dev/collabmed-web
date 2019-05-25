@extends('layouts.app')

@section('sidebar')
  @include('admin.layouts._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Admin Dashboard</h6>
@endsection

@section('content')
<div class="card">
  <div class="card-body">
    Welcome to Admin Dashboard
  </div>

</div>
@endsection
