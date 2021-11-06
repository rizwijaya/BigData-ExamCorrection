</div>
</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <!-- Content -->
    <div class="card mb-12">
        <div id="piechart"></div>
            
            <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
            <script type="text/javascript">
            // Load google charts
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            // Draw the chart and set the chart values
            function drawChart() {
            var data = google.visualization.arrayToDataTable([
            ['Status', '%'],
            ['Lulus', 88],
            ['Tidak Lulus', 12],
            ]);

            // Optional; add a title and set the width and height of the chart
            var options = {'title':'Surabaya', 'width':550, 'height':400};

            // Display the chart inside the <div> element with id="piechart"
            var chart = new google.visualization.PieChart(document.getElementById('piechart'));
            chart.draw(data, options);
            }
            </script>
        </div>
    </div>
  