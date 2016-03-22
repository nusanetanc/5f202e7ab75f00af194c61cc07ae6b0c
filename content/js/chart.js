      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart1);
      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Paket', 'Total Customer']
          <?php
          $reslt= $col_package->find();
          foreach($res as $row) {
            $packages=$row['nama'];
          $res = $col_user->find(array("paket"=>$packages));
                          $length = $res->count();
           echo "['{$packages}', {$length}],";
          }
          ?>
        ]);

        var options = {
          title: 'Popular Package',
          hAxis: {title: 'Package', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }