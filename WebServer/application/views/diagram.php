</div>
</div>
</div>
<!-- Page content -->
<div class="container-fluid mt--6">
    <!-- Content -->
    <div class="card mb-12">
    <!-- Diagram -->
    <canvas id="labelChart"></canvas>
    <script>
        var ctxP = document.getElementById("pieChart").getContext('2d');
        var myPieChart = new Chart(ctxP, {
        type: 'pie',
        data: {
        labels: ["Bangkalan", "Banyuwangi", "Blitar", "Bojonegoro", "Bondowoso", "Gresik", 
                "Jember", "Jombang", "Kediri", "Lamongan", "Lumajang", "Madiun", "Magetan", 
                "Malang", "Mojokerto", "Nganjuk", "Ngawi", "Pacitan", "Pamekasan", "Pasuruan", 
                "Ponorogo", "Probolinggo", "Sampang", "Sidoarjo", "Situbondo", "Sumenep", "Trenggalek",
                "Tuban", "Tulungagung", "Kota Batu", "Kota Blitar", "Kota Kediri", "Kota Madiun", 
                "Kota Malang", "Kota Mojokerto", "Kota Pasuruan", "Kota Probolinggo", "Surabaya"],
        datasets: [{
        data: [20, 20, 30, 40, 120],
        //kita bikin 38 warna LOL :")
        // oke
        backgroundColor: ["#F7464A", "#46BFBD", "#FDB45C", "#949FB1", "#4D5360", "#ED50F1"],
        hoverBackgroundColor: ["#FF5A5E", "#5AD3D1", "#FFC870", "#A8B3C5", "#616774"]}]
        },
        options: {
        responsive: true
        }
        });
    </script>

    
    