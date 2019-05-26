@extends('layouts.app')

@section('sidebar')
  @include('treatment._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Treatment Department</h6>
@endsection

@section('content')
     {{-- <app-doctor-home></app-doctor-home> --}}
     <app-visit-details :visit="{{$visit}}"></app-visit-details>
    

@endsection