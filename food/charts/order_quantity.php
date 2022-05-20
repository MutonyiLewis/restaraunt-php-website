<?php 

$conn = mysqli_connect("localhost","root","","foodproject");
if ($conn == true) {
  // code...
  echo "connected";
}


?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['food', 'quantity'],

          <?php 
          $sql = "SELECT * FROM order_tbl";
          $fire = mysqli_query($conn, $sql);
          while ($result = mysqli_fetch_assoc($fire)) {
            // code...
            echo "['".$result['food']."','".$result['quantity']."'],";
          }

          ?>
          
        ]);

        var options = {
          title: 'order quantity'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>