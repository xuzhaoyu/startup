@extends('app')

@section('content')
    {!! Form::open(array('route' => 'submit')) !!}
    {!! Form::select('market', ['Health' => 'Health', 'Technology' => 'Technology', 'Finance' => 'Finance', 'Travel' => 'Travel', 'Education' => 'Education']) !!}
    <br>
    <br>
    {!! Form::label('name', 'Title: ') !!}
    {!! Form::text('name')!!}
    <br>
    {!! Form::label('description', 'Description:')!!}
    <br>
    {!! Form::textarea('description')!!}
    <br>
    {!! Form::label('keywords', 'Tags:') !!}
    {!! Form::text('keywords')!!}
    <br>
    <br>
    {!! Form::submit('Submit') !!}
    {!! Form::close() !!}
@endsection