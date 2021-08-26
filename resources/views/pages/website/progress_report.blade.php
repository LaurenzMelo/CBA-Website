@extends('layouts.website')
@section('content')
    <progress_report :p_report=" {{ $p_report }}"></progress_report>
@endsection
