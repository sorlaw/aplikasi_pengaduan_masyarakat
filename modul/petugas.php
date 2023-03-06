<!DOCTYPE html>
<html lang="en">
<?php

include('../config/database.php');
session_start();
if (empty($_SESSION['username'])) {
    @header('location:login.php');
} else {
    if ($_SESSION['level'] == 'admin' || 'petugas') {
        $id_petugas = $_SESSION['id_petugas'];
    }
}

if (isset($_POST['simpan'])) {
    $nama_petugas = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password = md5($_POST['password']);
    $q = mysqli_query($con, "INSERT INTO `petugas` (nama_petugas, username, password, telp, level) VALUES ('$nama_petugas', '$username', '$password', '$telp', 'petugas')");
}

if (isset($_POST['update'])) {
    $nikLama = $_POST['nikLama'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $telp = $_POST['telp'];
    $password = md5($_POST['password']);
    if ($password == '') {
        $q = mysqli_query($con, "UPDATE `masyarakat` SET nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    } else {
        $q = mysqli_query($con, "UPDATE `masyarakat` SET `password` = '$password', nik = '$nik', nama = '$nama', username = '$username', telp = '$telp' WHERE nik = '$nikLama'");
    }
}

if (isset($_POST['hapus'])) {
    $id_petugas = $_POST['id_petugas'];
    $q = mysqli_query($con, "DELETE FROM `petugas` WHERE id_petugas = '$id_petugas'");
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
                            <h3>Petugas</h3>

                            <?php
                            if ($_SESSION['level'] == 'admin') { ?>
                                <button type="button" class="btn btn-primary " data-bs-toggle="modal"
                                    data-bs-target="#exampleModal">
                                    Tambah Petugas
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
                                        <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <form action="" method="post">
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nama Petugas</label>
                                                <input type="text" name="nama_petugas" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Username</label>
                                                <input type="text" name="username" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                                <input type="password" name="password" class="form-control"
                                                    id="exampleInputPassword1">
                                            </div>
                                            <div class="mb-3">
                                                <label for="exampleInputEmail1" class="form-label">Nomor Telepon</label>
                                                <input type="number" name="telp" class="form-control"
                                                    id="exampleInputEmail1" aria-describedby="emailHelp">

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" name="simpan" class="btn btn-primary">Save
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
                                        <th scope="col">Id_Petugas</th>
                                        <th scope="col">Nama_Petugas</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">No.Telp</th>
                                        <th scope="col">Level</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    $q = mysqli_query($con, "SELECT * FROM `petugas`");
                                    while ($d = mysqli_fetch_object($q)) { ?>
                                        <tr>
                                            <th scope="row">
                                                <?= $no++ ?>
                                            </th>
                                            <td>
                                                <?= $d->id_petugas ?>
                                            </td>
                                            <td>
                                                <?= $d->nama_petugas ?>
                                            </td>
                                            <td>
                                                <?= $d->username ?>
                                            </td>
                                            <td>
                                                <?= $d->telp ?>
                                            </td>
                                            <td>
                                                <?= $d->level ?>
                                            </td>
                                            </td>
                                            <td>
                                                <?php
                                                if ($_SESSION['level'] == 'admin') { ?>

                                                    <form action="" method="post">
                                                        <input type="hidden" name="id_petugas"
                                                            value="<?= $d->id_petugas ?>"><button class="btn btn-danger"
                                                            name="hapus"><i class="fa fa-trash"></i></button>
                                                    </form>
                                                <?php }
                                                ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
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