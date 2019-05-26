@extends('layouts.app')

@section('sidebar')
  @include('optical._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Optical Department</h6>
@endsection

@section('content')
     {{-- <app-doctor-home></app-doctor-home> --}}
     <app-dashboard :department="'optical'"></app-dashboard>

@endsection
