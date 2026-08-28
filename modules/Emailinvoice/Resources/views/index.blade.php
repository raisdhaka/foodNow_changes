@extends('emailinvoice::layouts.master')

@section('content')
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: {!! config('emailinvoice.name') !!}
    </p>
@endsection
