@extends('layouts.website')
@section('content')
    <transparency_report :t_report=" {{ $t_report }}"></transparency_report>
@endsection
