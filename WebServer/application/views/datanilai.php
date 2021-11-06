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
                    <h3 class="mb-0">Data Nilai Siswa</h3>
                </div>

                <!-- Button trigger modal -->
                <div class="btn-group pl-5">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Mata Pelajaran
                    </button>
                    <div class="dropdown-menu pre-scrollable">
                        <?php 
                        foreach ($mapel as $m) :
                        ?>
                        <a class="dropdown-item" href="<?= base_url(); ?>admin/filtermapel/<?= $m['id_mapel'];?>"><?= $m['nama_mapel'];?></a>
                        <?php endforeach; ?>
                    </div>
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
                        <th scope="col" class="sort" data-sort="Jumlah Benar">Nama Mapel</th>
                        <th scope="col" class="sort" data-sort="nilai">Nilai</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <?php $no = 1;
                        foreach ($nilai->result() as $mk) : ?>
                            <th scope="row"><?= $no++; ?></th>
                            <td><?= $mk->nisn; ?></td>
                            <td><?= $mk->nama_siswa; ?></td>
                            <td><?= $mk->nama_mapel; ?></td>
                            <td><?= $mk->nilai; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="col">
                <!--Tampilkan pagination-->
                <?php echo $pagination;?>
                <!--Tampilkan pagination-->
            </div>
        </div>
        <!-- Ini table nya -->

    </div> <!-- Div Class Container Content-->
    <!-- End Content -->