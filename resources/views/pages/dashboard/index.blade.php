@extends('layouts.app')

@section('content')
    <dashboard-index :auth="{{ Auth::user() }}"></dashboard-index>
@endsection
