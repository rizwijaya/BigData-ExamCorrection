</div>
        </div>
        </div>
        <!-- Page content -->
        <div class="container-fluid mt--6">
            <!-- Content -->
            <div class="card mb-12">
                <!-- Table dimulai -->
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">Data Siswa</h3>
                        </div>
                        <!-- Button trigger modal -->
                        <!-- <div class="col text-right">
                            <a class="btn btn-primary mb-0" href="daftarpeserta/cetak_sesi/"><i class="fa fa-print"></i> Cetak Laporan</a>
                        </div> -->
                    </div>
                </div>
                <!-- Isi Tabel -->
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" class="sort" data-sort="no">No</th>
                                <th scope="col" class="sort" data-sort="nisn">Nisn</th>
                                <th scope="col" class="sort" data-sort="nama_siswa">Nama Siswa</th>
                                <th scope="col" class="sort" data-sort="jenis_kelamin">Jenis Kelamin</th>
                                <th scope="col" class="sort" data-sort="nama_asal">Nama Asal</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            <tr>
                                <?php $no =1; foreach ($siswa as $mk) : ?>
                                <th scope="row"><?= $no++;?></th>
                                <td><?= $mk['nisn']; ?></td>
                                <td><?= $mk['nama_siswa'];?></td>
                                <td><?= $mk['jenis_kelamin']; ?></td>
                                <td><?= $mk['nama_asal']; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <!-- Ini table nya -->
            </div> <!-- Div Class Container Content-->
            <!-- End Content -->

<!-- <html>
    <head>
        <title>Test Datatable</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="container">
            <h3>Data siswa</h3>
            <table id="table" class="display" cellspacing="0" width="100%">
                <thead>
                    <tr><th>No.</th><th>Nisn</th><th>Nama Siswa</th><th>Jenis Kelamin</th></tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.13/js/dataTables.bootstrap.min.js"></script>
        <script type="text/javascript">

            var save_method; //for save method string
            var table;

            $(document).ready(function() {
                //datatables
                table = $('#table').DataTable({
                    // columnDefs: [{
                    //     "defaultContent": "-",
                    //     "targets": "_all"
                    // }], 
                    "processing": true, //Feature control the processing indicator.
                    "serverSide": true, //Feature control DataTables' server-side processing mode.
                    "order": [], //Initial no order.
                    // Load data for the table's content from an Ajax source
                    "ajax": {
                        "url": '<?php echo site_url('admin/json'); ?>',
                        "type": "POST"
                    },
                    //Set column definition initialisation properties.
                    "columns": [
                        {"data": "id_user",width:170},
                        {"data": "nisn",width:100},
                        {"data": "nama_siswa",width:100},
                        {"data": "jenis_kelamin",width:100}
                    ],

                });

            });
        </script>

    </body>
</html> -->
