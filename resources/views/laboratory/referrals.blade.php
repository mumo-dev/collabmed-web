@extends('layouts.app')

@section('sidebar')
  @include('laboratory._header')
@endsection

@section('header-title')
  <h6 class="text-white text-uppercase">Laboratory Department</h6>
@endsection

@section('content')
   <app-referral-dashboard :department="'laboratory'"></app-referral-dashboard>

@endsection