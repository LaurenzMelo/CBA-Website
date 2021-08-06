@extends('layouts.website')
@section('content')
    <all_announcement :all=" {{ $all }}"></all_announcement>
@endsection
