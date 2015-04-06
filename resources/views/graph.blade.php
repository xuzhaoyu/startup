@extends('app')

@section('content')
<html>
<head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
        google.load("visualization", "1", {packages:["corechart"]});
        google.setOnLoadCallback(drawChart);
        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Market', 'How many'],
                ['Health', <?php echo $counts['Health']; ?>],
                ['Technology',<?php echo $counts['Technology']; ?>],
                ['Finance', <?php echo $counts['Finance']; ?>],
                ['Travel', <?php echo $counts['Travel']; ?>],
                ['Education', <?php echo $counts['Education']; ?>]
            ]);

            var options = {
                title: 'Market Distribution',
                pieHole: 0.4
            };

            var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
            chart.draw(data, options);
        }
    </script>
</head>
<body>
<div id="donutchart" style="width: 900px; height: 500px;"></div>
</body>
</html>
@endsection