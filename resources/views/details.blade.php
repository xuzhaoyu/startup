@extends('app')

@section('content')
    <?php
    echo 'Title: ' . $idea->name;
    echo '<br>';
    echo 'Written By: ' . $idea->username;
    echo '<br>';
    echo 'Market: ' . $idea->market;
    echo '<br>';
    echo 'Description: ' . $idea->description;
    ?>
@endsection
