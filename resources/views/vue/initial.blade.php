@extends('layouts.main')

@section('content')
    <!-- Site wrapper -->
    <vue-snotify></vue-snotify>
    <preloader-component></preloader-component>
    <router-view></router-view>
@endsection


