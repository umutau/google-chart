<!DOCTYPE html>
<?php
$months = [
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
];
$persons = [0 => 'John', 1 => 'Mark', 2 => 'Thomas'];
foreach ($persons as $keyPerson => $person) {
    foreach ($months as $keyMonth => $month) {
        $value[$keyPerson][$keyMonth] = rand(10, 100);
    }
}
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Google Chart with Random Numbers</title>
        <!-- Bootstrap -->
        <link href="bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Custom CSS -->
        <style>
            body {
                padding-top: 70px;
                /* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
            }
        </style>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
        <!-- Page Content -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h1>Google Chart Examples with Random Numbers</h1>
                    <button type="button" class="btn btn-primary" id="btnCreateMessage" onClick="history.go(0)">Refresh Random Numbers</button>
                    <br/><br/>
                    <table class="table table-striped table-bordered table-hover">
                        <tr>
                            <th>Person</th>
                            <?php
                            foreach ($months as $month) {
                                echo '<th style="width:80px;text-align:center">' . $month . '</th>';
                            }
                            ?>
                        </tr>
                        <?php
                        foreach ($persons as $personKey => $person) {
                            echo '<tr><th>' . $person . '</th>';
                            foreach ($months as $monthKey => $month) {
                                echo '<td>' . $value[$personKey][$monthKey] . '</td>';
                            }
                            echo'</tr>';
                        }
                        ?>
                    </table>
                </div>
                <div class="col-lg-12 text-center" id="columnchart_values" style="width: 900px; height: 300px;"></div>

            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
            google.charts.load("current", {packages: ['bar']});
            google.charts.setOnLoadCallback(drawChart);
            function drawChart() {
                var data = google.visualization.arrayToDataTable([
                <?php
                echo "['Month'";
                foreach ($persons as $person) {
                    echo ",'$person'";
                }
                echo "]";
                $sum=[];
                foreach ($months as $monthKey => $month) {
                    echo ",['$month'";
                    foreach ($persons as $personKey => $person) {
                        echo "," . $value[$personKey][$monthKey];
                        if(!isset($sum[$personKey]))
                            $sum[$personKey]=0;
                        $sum[$personKey]+=$value[$personKey][$monthKey];
                    }
                    
                    echo "]";
                }
                echo ",['Average'";
                foreach ($persons as $personKey => $person) {
                    echo "," . round($sum[$personKey]/12);
                }
                echo "]";
                ?>
                ]);
                var options = {
                    title: "Google Chart Examples with Random Numbers",
                    width: 1200,
                    height: 400,
                };
                var chart = new google.charts.Bar(document.getElementById("columnchart_values"));
                chart.draw(data, google.charts.Bar.convertOptions(options));
            }
        </script>
    </body>
</html>