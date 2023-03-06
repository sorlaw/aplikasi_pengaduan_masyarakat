<!DOCTYPE html>
<html lang="en">
<?php

session_start();
include('../config/database.php');
if (empty($_SESSION['username'])) {
    @header('location:login.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    } else {
        $id_petugas = $_SESSION['id_petugas'];
    }
}
// tambah tanggapan
if (isset($_POST['tambah_tanggapan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $id_petugas = $_POST['id_petugas'];
    $tanggapan = $_POST['tanggapan'];
    $q = "INSERT INTO `tanggapan` (id_tanggapan, id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('','$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
    $r = mysqli_query($con, $q);
}
// hapus tanggapan
if (isset($_POST['hapusTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($con, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}
// update tanggapan
if (isset($_POST['ubahTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($con, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
}

?>

<?php include('../assets/header.php') ?>

<body>
    <!-- <?php include('../assets/menu.php') ?> -->

    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="info">
                <div class="alert alert-success mt-5" alert-dismiss>
                    <h5>Halo!
                        <br> Selamat datang
                        <?= $_SESSION['username'] ?> Anda login sebagai
                        <?= $_SESSION['level'] ?>
                    </h5>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Tanggapan</h3>
                            <?php
                            if ($_SESSION['level'] != 'masyarakat') { ?>

                                <button type="submit" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#modal-mg">
                                    Tambah Tanggapan
                                </button>
                            <?php }

                            ?>
                        </div>
                        <!-- Button trigger modal -->


                        <!-- Modal -->
                        <div class="modal fade" id="modal-mg" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Tanggapan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="Default select example"
                                                    class="form-label">Id_Pengaduan</label>
                                                <select class="form-select" aria-label="Default select example" name="id_pengaduan">
                                                    <?php
                                                    $q = mysqli_query($con, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik ");
                                                    while ($d = mysqli_fetch_object($q)) { ?>
                                                        <option value="<?= $d->id_pengaduan ?>">Id_Pengaduan : <?=
                                                              $d->id_pengaduan ?>, Nama : <?= $d->nama ?>, Nik : <?= $d->nik ?>
                                                        <?php }
                                                    ?>
                                                    </option>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Id_Petugas</label>
                                                <input type="text" name="id_petugas" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                    value="<?= $id_petugas ?>" readonly>

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                                    Tanggapan</label>
                                                <input type="date" name="tgl_tanggapan" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tanggapan</label>
                                                <textarea rows="10" cols="10" name="tanggapan" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp"></textarea>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="tambah_tanggapan" class="btn btn-primary">Save
                                                changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-hover" id="dataTablesNya">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Id_Tanggapan</th>
                                        <th scope="col">Id_Pengaduan</th>
                                        <th scope="col">Tanggal_Tanggapan</th>
                                        <th scope="col">Tanggapan</th>
                                        <th scope="col">Id_Petugas</th>
                                        <th scope="col">Edit Tanggapan</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q = mysqli_query($con, "SELECT * FROM `tanggapan` JOIN `petugas` JOIN `pengaduan` WHERE tanggapan.id_petugas = petugas.id_petugas AND tanggapan.id_pengaduan = pengaduan.id_pengaduan");
                                    while ($d = mysqli_fetch_object($q)) { ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $no++ ?>
                                            </th>
                                            <td>
                                                <?= $d->id_tanggapan ?>
                                            </td>
                                            <td>
                                                <?= $d->id_pengaduan ?>
                                            </td>
                                            <td>
                                                <?= $d->tgl_tanggapan ?>
                                            </td>
                                            <td>
                                                <?= $d->tanggapan ?>
                                            </td>
                                            <td>
                                                <?= $d->nama_petugas ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($_SESSION['level'] != 'masyarakat') { ?>

                                                        <button class="btn btn-success" type="submit"
                                                        data-toggle="modal"
                                                        data-target="#modal-xl<?= $d->id_pengaduan ?>"><i
                                                            class=""></i>Edit</button>

                                                <?php }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($_SESSION['level'] != 'masyarakat') { ?>
                                                <form action="" method="post">
                                                    <input type="hidden" name="id_tanggapan"
                                                        value="<?= $d->id_tanggapan ?>"><button type="submit" name="hapusTanggapan" class="btn btn-danger"><i
                                                            class="fa fa-trash"></i></button></form>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-xl<?= $d->id_pengaduan ?>">
                                            <div class="modal-dialog modal-xl<?= $d->id_pengaduan ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Tanggapan</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post" enctype="multipart/form-data">
                                                        <input type="hidden" name="id_tanggapan"
                                                            value="<?= $d->id_tanggapan ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="Default select example"
                                                                    class="form-label">Id_Pengaduan</label>
                                                                <select class="form-select"
                                                                    aria-label="Default select example" name="">
                                                                    <?php
                                                                    $q = mysqli_query($con, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik");
                                                                    while ($data = mysqli_fetch_object($q)) { ?>
                                                                        <option value="<?= $data->$id_pengaduan ?>">Id_Pengaduan : <?=
                                                                              $d->id_pengaduan ?>, Nik : <?= $d->nik ?>, Nama : <?=
                                                                                   $data->nama ?></option>
                                                                    <?php }
                                                                    ?>
                                                                </select>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">Id_Petugas</label>
                                                                <input type="text" name="id_petugas" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    value="<?= $d->id_petugas ?>">

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                                                    Tanggapan</label>
                                                                <input type="text" name="tgl_tanggapan" class="form-control"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                                    value="<?= $d->tgl_tanggapan ?>">

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1"
                                                                    class="form-label">Tanggapan</label>
                                                                <textarea name="tanggapan" class="form-control" rows="5" cols="5"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp"><?= $d->tanggapan ?></textarea>

                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close</button>
                                                            <button type="submit" name="ubahTanggapan"
                                                                class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <?php include('../assets/footer.php') ?>
</body>

</html>