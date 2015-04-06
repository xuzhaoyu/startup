@extends('app')

@section('content')
    <style>
        table, th, td {
            border: 1px solid black;
            font-weight: 600;
        }
    </style>
    <table>
        <tr>
            <th><a href="/sort/name">Name</a></th>
            <th><a href="/sort/market">Market</a></th>
            <th><a href="/sort/market">Tags</a></th>
            <th>User Submitted</th>
            <th><a href="/sort/date">Date Created</a></th>
        </tr>

<?php
    foreach($ideas as $idea){
        echo '<tr>';
        echo '<td>';
        echo '<a href="/details/'.$idea->id.'">';
        echo $idea->name;
        echo '</a>';
        echo '</td>';
        echo '<td>';
        echo $idea->market;
        echo '</td>';
        echo '<td>';
        echo $idea->tags;
        echo '</td>';
        echo '<td>';
        echo $idea->username;
        echo '</td>';
        echo '<td>';
        echo $idea->created;
        echo '</td>';
        echo '<td>';
        echo '<a href="/like/'.$idea->id.'">';
        echo 'Like';
        echo '</a>';
        echo '</td>';
        echo '</tr>';
    }
?>
    </table>
@endsection
