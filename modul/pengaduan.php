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
    }
}
// CRUD
if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl_pengaduan = $_POST['tgl_pengaduan'];
    //upload
    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl_pengaduan', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($con, $q);
            if ($r) {
                move_uploaded_file($file_tmp, '../assets/images/masyarakat/' . $foto);
            }
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl_pengaduan', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($con, $q);
    }
}

if (isset($_POST['delete'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($_SESSION['foto'] == '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = '$id_pengaduan'";
        $r = mysqli_query($con, $q);
        $d = mysqli_fetch_object($r);
        unlink('../assets/images/masyarakat/' . $d->foto);
    }
    $q = mysqli_query($con, "DELETE FROM `pengaduan` WHERE id_pengaduan = '$id_pengaduan'");
}

if (isset($_POST['edit'])) {
    $status = $_POST['status'];
    $id_pengaduan = $_POST['id_pengaduan'];
    $q = mysqli_query($con, "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'");
}


?>

<?php include('../assets/header.php') ?>

<body>
    <!-- <?php include('../assets/navbar.php') ?> -->

    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="info">
            <div class="col-4">

        <?php include('../assets/menu.php') ?>  
            </div>
                <div class="col-9" style="margin-left: 300px;">
                    <div class="card">
                        <div class="card-header">
                            <h3>Pengaduan</h3>
                            <?php
                            if ($_SESSION['level'] == 'masyarakat') { ?>
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah Pengaduan
                                </button>
                            <?php }

                            ?>
                        </div>
                        <!-- Button trigger modal -->


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Pengaduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>

                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Tanggal
                                                    Pengaduan</label>
                                                <input type="date" name="tgl_pengaduan" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nik</label>
                                                <input type="text" name="nik" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp"
                                                    value="<?= $nik ?>" readonly>

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Isi Laporan</label>
                                                <textarea name="isi_laporan" cols="30" rows="10" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" class="form-control"></textarea>

                                            </div>
                                            <div class="mb-3">
                                                <label for="poto" class="form-label">Foto</label>
                                                <input type="file" name="foto" class="form-control" id="poto">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="tambahPengaduan" class="btn btn-primary">Tambah
                                                Pengaduan</button>
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
                                        <th scope="col">Tanggal Pengaduan</th>
                                        <th scope="col">Nik</th>
                                        <th scope="col">Isi Laporan</th>
                                        <th scope="col">Foto</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Ubah Status</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q = mysqli_query($con, "SELECT * FROM `pengaduan`");
                                    while ($d = mysqli_fetch_object($q)) { ?>
                                        <tr>
                                            <th scope="rows">
                                                <?= $no++ ?>
                                            </th>
                                            <td>
                                                <?= $d->tgl_pengaduan ?>
                                            </td>
                                            <td>
                                                <?= $d->nik ?>
                                            </td>
                                            <td>
                                                <?= $d->isi_laporan ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($d->foto == '') {
                                                    echo '<img style="max-height: 100px"
                                                        src="../assets/images/masyarakat/no-foto.png" alt=""
                                                        class="img img-thumbnail ">';
                                                } else {
                                                    echo '<img style="max-height: 100px"
                                                        src="../assets/images/masyarakat/' . $d->foto . '" alt=""
                                                        class="img img-thumbnail ">';
                                                } ?>
                                            </td>
                                            <td>
                                                <?= $d->status ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($_SESSION['level'] == 'petugas') { ?>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_pengaduan"
                                                            value="<?= $d->id_pengaduan ?>">
                                                        <label for="Default select example" class="form-label"></label>
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="status">
                                                            <option value="0">belum diproses</option>
                                                            <option value="proses">dalam proses</option>
                                                            <option value="selesai">selesai</option>
                                                        </select>
                                                        <button type="submit" name="edit"
                                                            class="btn btn-success form-control">Submit</button>
                                                    </form>
                                                <?php }
                                                ?>

                                            </td>
                                            <td>
                                                <?php
                                                if ($_SESSION['level'] == 'masyarakat' || 'admin') { ?>
                                                    <form action="" method="POST">
                                                        <input type="hidden" name="id_pengaduan"
                                                            value="<?= $d->id_pengaduan ?>"><button type="submit"
                                                            class="btn btn-danger" name="delete">Hapus</button>
                                                    </form>
                                                <?php }

                                                ?>
                                            </td>
                                        </tr>
                                    <?php }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../assets/footer.php') ?>
</body>

</html>