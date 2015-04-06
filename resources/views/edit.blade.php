@extends('app')

@section('content')
    {!! Form::open(array('route' => 'edited')) !!}
    {!! Form::select('market', ['Health' => 'Health', 'Technology' => 'Technology', 'Finance' => 'Finance', 'Travel' => 'Travel', 'Education' => 'Education'], $idea->market) !!}
    <br>
    <br>
    {!! Form::hidden('id', $idea->id) !!}
    {!! Form::label('name', 'Title: ') !!}
    {!! Form::text('name', $idea->name)!!}
    <br>
    {!! Form::label('description', 'Description:')!!}
    <br>
    {!! Form::textarea('description', $idea->description)!!}
    <br>
    {!! Form::label('keywords', 'Tags:') !!}
    {!! Form::text('keywords')!!}
    <br>
    <br>
    {!! Form::submit('Submit') !!}
    {!! Form::close() !!}
@endsection