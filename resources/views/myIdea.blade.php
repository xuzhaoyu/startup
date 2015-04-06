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
            <th>Name</th>
            <th>Market</th>
            <th>Time Created</th>
        </tr>

        <?php
        foreach($ideas as $idea){
            echo '<tr>';
            echo '<td>';
            echo $idea->name;
            echo '</td>';
            echo '<td>';
            echo $idea->market;
            echo '</td>';
            echo '<td>';
            echo $idea->created;
            echo '</td>';
            echo '<td>';
            echo '<a href="';
            echo URL::route('myIdea');
            echo '/delete/';
            print_r($idea -> id);
            echo '">';
            print_r('Delete');
            echo '</a>';
            echo '</td>';
            echo '<td>';
            echo '<a href="';
            echo URL::route('myIdea');
            echo '/edit/';
            print_r($idea -> id);
            echo '">';
            print_r('Edit');
            echo '</a>';
            echo '</td>';
            echo '</tr>';
        }
        ?>
    </table>
@endsection
