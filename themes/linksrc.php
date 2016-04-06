<link href='https://fonts.googleapis.com/css?family=Poppins:400,500,300,700,600' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<link href="<?php echo $base_url ?>/content/css/bootstrap.css" rel="stylesheet">
<link href="<?php echo $base_url ?>/content/css/style.css" rel="stylesheet">
<link href="<?php echo $base_url ?>/content/css/JesterBox.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo $base_url ?>/content/css/datepicker.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.10/css/dataTables.bootstrap.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
  <script src="<?php echo $base_url ?>/content/js/bootstrap.js"></script>
  <script src='https://www.google.com/recaptcha/api.js'></script> 
  <script src="<?php echo $base_url ?>/content/js/bootstrap-datepicker.js"></script>
  <script src="https://www.google.com/jsapi" type="text/javascript"></script> 
    <script src="https://cdn.datatables.net/1.10.10/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="<?php echo $base_url; ?>/content/js/registrationvalidate.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    } );
    </script>
     <?php
			if ($level=="1"){ ?>
	 <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart1);
      google.setOnLoadCallback(drawChart2);
      google.setOnLoadCallback(drawChart3);
      // Chart untuk popular paket  
      function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Paket', 'Total Customer'],
          <?php
          $reslt= $col_package->find();
          foreach($reslt as $row) {
            $package=$row['nama'];
          $res = $col_user->find(array("paket"=>$package));
                          $length = $res->count();
           echo "['{$package}', {$length}],";
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
      //Chart untuk cust regis
      function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Tanggal', 'Total Customer'],
          <?php
          $month = date(m);
          $reslt= $col_user->find();
          foreach($reslt as $row) {
            $bln = substr($row['tanggal_registrasi'], 5,2);
            $day0 = substr($row['tanggal_registrasi'], 8,10);
            if ($bln==$month && $day<>$day0){
              $tanggal = $row['tanggal_registrasi'];
              $day = substr($tanggal, 8,10);
          $res = $col_user->find(array("tanggal_registrasi"=>$tanggal));
                          $length1 = $res->count();
           echo "['{$day}', {$length1}],";
          } }
          if (empty($length1)){
            echo "['00', 0],";
          }
          ?>
        ]);

        var options = {
          <?php $month = bulan($month); ?>
          title: 'Customer Registrasi <?php echo ' '.$month; ?>',
          hAxis: {title: 'Tanggal Registrasi', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }
      //Chart untuk ticket
      function drawChart3() {
        var data = google.visualization.arrayToDataTable([
          ['Status', 'Jumlah'],
          <?php
            $month=$_POST['month'];
            $year=$_POST['year'];
                      if (empty($month)){
                        $month=date(m);
                      }
                      if (empty($year)){
                        $year=date(Y);
                      }
          $reslt= $col_ticket->find();
          foreach($reslt as $row) {
            $bln = substr($row['dateopen'], 5,2);
            if ($bln==$month){
              $status = $row['status'];
          $res = $col_ticket->find(array("status"=>$status));
                          $length2 = $res->count();
           echo "['{$status}', {$length}],";
          } }
           if (empty($length2)){
            echo "['open', 0],['solved', 0],['close', 0],";
          }
          $bulan= bulan($month);
          ?>
        ]);

        var options = {
          title: 'Grafik Pengaduan <?php echo $bulan.' '.$year; ?>',
          hAxis: {title: 'status', titleTextStyle: {color: 'red'}}
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_div3'));
        chart.draw(data, options);
      }      
    </script>
	<?php } ?>
    	   </head>
