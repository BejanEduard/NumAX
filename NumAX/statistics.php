<?php include("path.php"); ?>
<?php include(ROOT_PATH . "/app/controllers/coins.php") ?>
<?php include(ROOT_PATH . "/app/helpers/exportStatistics.php") ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Sen:wght@400;700;800&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/cdd030e6ac.js" crossorigin="anonymous"></script>
    <title>NumAx</title>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script type="text/javascript">
      google.charts.load('current', {
        'packages':['geochart','corechart'],
        // Note: you will need to get a mapsApiKey for your project.
        // See: https://developers.google.com/chart/interactive/docs/basic_load_libs#load-settings
        'mapsApiKey': 'AIzaSyD-9tSrke72PouQMnMX-a7eZSW0jkFMBWY'
      });
      google.charts.setOnLoadCallback(drawRegionsMap);
      
    
      function drawRegionsMap() {
        var data1 = google.visualization.arrayToDataTable([
          ['Country', 'Number of Coins'],
          <?php foreach ($coins_by_country as $key => $value) {
                echo "['" . $key . "'," . $value . "],";
            } ?>
          
        ]);

            var data2 = google.visualization.arrayToDataTable([
          ['Coins', 'Composition'],
          <?php foreach ($coins_by_composition as $key => $value) {
                echo "['" . $key . "'," . $value . "],";
            } ?>
        ]);

        var data3 = google.visualization.arrayToDataTable([
          ['Coins', 'Circulation'],
          <?php foreach ($coins_by_circulation as $key => $value) {
                echo "['" . $key . "'," . $value . "],";
            } ?>
        ]);

        var data4 = google.visualization.arrayToDataTable([
          ['Coins', 'Shape'],
          <?php foreach ($coins_by_shape as $key => $value) {
                echo "['" . $key . "'," . $value . "],";
            } ?>
        ]);

        var btnPDF = document.getElementById('statisticsPDF');    
          
        
        var options1 = {
            colorAxis: {colors: ['#e7711c', '#4374e0']},
            datalessRegionColor: '#C0C0C0',
            
        };

        var options2 = {
          title: 'Coins by composition',
          pieHole: 0.4,
        };

        var options3 = {
          title: 'Coins by circulation',
          pieHole: 0.4,
        };

        var options4 = {
          title: 'Coins by shape',
          pieHole: 0.4,
        };

         

        var chart1 = new google.visualization.GeoChart(document.getElementById('regions_div'));
        chart1.draw(data1, options1);
        
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);

        var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart3.draw(data3, options3);

        var chart4 = new google.visualization.PieChart(document.getElementById('piechart4'));
        chart4.draw(data4, options4);
        
        google.visualization.events.addListener(chart1, 'ready', function () {
    btnPDF.disabled = false;
  });   

        btnPDF.addEventListener('click', function () {
    var doc = new jsPDF();
    doc.addImage(chart1.getImageURI(), 0, 0);
    doc.addImage(chart2.getImageURI(), 0, 150);
    doc.addImage(chart3.getImageURI(), 100, 150);
    doc.addImage(chart4.getImageURI(), 0, 220);

    doc.addPage();
    doc.text(20,20, <?php echo "'Total weight is: " . $total_weight . "'"; ?>);
    doc.text(20,40, <?php echo "'Average diameter is: " . $average_diameter . "'"; ?>);
    doc.text(20,60, <?php echo "'Number of coins is: " . $number_of_coins . "'"; ?>);

    doc.save('charts.pdf');
  }, false);

        window.onresize = resize;

function resize() {
    
        var chart1 = new google.visualization.GeoChart(document.getElementById('regions_div'));
        chart1.draw(data1, options1);
        
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart2.draw(data2, options2);

        var chart3 = new google.visualization.PieChart(document.getElementById('piechart3'));
        chart3.draw(data3, options3);

        var chart4 = new google.visualization.PieChart(document.getElementById('piechart4'));
        chart4.draw(data4, options4);
} 
      }
    </script>
</head>

<body>
    <!-- NAVBAR HERE -->
    <?php include(ROOT_PATH . "/app/includes/nav.php"); ?>

    

    <section id="personal-statistics">
    <div class="container s-around">
    <form  action="statistics.php" enctype="multipart/form-data" method="post" class="col-4 col-s-10 m-1" >
                    <div >
                        <button type="submit" id="statisticsPDF" name="statisticsPDF" class="btn form-btn sucess">Export Statistics to PDF</button>
                    </div>                
    </form>
    <form  action="statistics.php" enctype="multipart/form-data" method="post" class="col-4 col-s-10 m-1" >
                    <div >
                        <button type="submit" id="statisticsCSV" name="statisticsCSV" class="btn form-btn sucess">Export Statistics to CSV</button>
                     </div>                
    </form>
    </div>
<div class="container s-around col-8 col-s-9">
    <div id="regions_div"  style="width:65%; height:auto; "></div>
 </div>   
 <div class="container s-around" style="margin-top:100px;">
    <div id="piechart2"  style="margin-left:auto; margin-right:auto; height: 300px;"></div>
    <div id="piechart3"  style=" height: 300px;"></div>
    <div id="piechart4"  style=" height: 300px;"></div>
 </div>   


<div class="container s-around" style="margin-top:100px;">
    
    <div id="weight" class="coin-statistics">
        <img style="height: 100px; " src="assets/img/icons/weight.png" alt="No picture available">
        <h2>Total Weight:  <?php echo $total_weight . 'g'; ?> </h2>
    </div>
    <div id="diameter" class="coin-statistics">
        <img style="height: 100px; " src="assets/img/icons/axis.png" alt="No picture available">
        <h2>Average Diameter:  <?php echo $average_diameter . ' mm'; ?> </h2>
    </div>
    <div id="number" class="coin-statistics">
        <img style="height: 100px; " src="assets/img/icons/money.png" alt="No picture available">
        <h2>Number of Coins:  <?php echo $number_of_coins; ?> </h2>
    </div>
    
 </div>
</section>

<section style="margin-top:50px" id="public-statistics" class="m-1 container s-around">
    <div>
    <table class="table-info">
    <tr> <th colspan="3"> Top Five Coins By Number Of Owners </th> </tr>
      <tr>
        <th> Id </th>
        <th> Name </th>
        <th> Number of Owners </th>
      </tr>
      <?php foreach ($top_five_coins as $coin) : ?>
        <tr>
            <th> <?php echo $coin['id']; ?> </th>
            <th class="table-hover"><a href="<?php echo BASE_URL . '\coin.php?id=' . $coin['id'] ?>"> <?php echo $coin['name']; ?> </a> </th>
            <th> <?php echo $coin['number']; ?> </th>
        </tr>
      <?php endforeach; ?>
    </table>
    </div>
</section>
    <?php include(ROOT_PATH . "/app/includes/footer.php"); ?>
</body>

</html>