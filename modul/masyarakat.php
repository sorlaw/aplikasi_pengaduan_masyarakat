<!DOCTYPE html>
<html lang="en">
<?php

include('../config/database.php');
session_start();
if (empty($_SESSION['username'])) {
    @header('location:login.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}

// CRUD
if (isset($_POST['edit'])) {
    $status = $_POST['status'];
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "UPDATE `masyarakat` SET verifikasi = '$status' WHERE nik = '$nik'");
}

if (isset($_POST['hapus'])) {
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "DELETE FROM `masyarakat` WHERE nik = '$nik'");
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

?>

<?php include('../assets/header.php') ?>

<body>
    <!-- <?php include('../assets/navbar.php') ?> -->


    <div class="container-fluid mt-5">
        <div class=" row justify-content-center">
            <div class="info">
            <div class="col-4">

<?php include('../assets/menu.php') ?>
</div>
                <div class="col-9" style="margin-left: 300px;">
                    <div class="card">
                        <div class="card-header">
                            <h3>Masyarakat</h3>

                        </div>

                        <div class="card-body">
                            <table class="table table-hover" id="dataTablesNya">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nik</th>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Username</th>
                                        <th scope="col">No.Telp</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Edit Data</th>
                                        <th scope="col">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $no = 1;
                                    $q = mysqli_query($con, "SELECT * FROM `masyarakat`");
                                    while ($d = mysqli_fetch_object($q)) { ?>
                                        <tr>
                                            <th scope="rows">
                                                <?= $no++ ?>
                                            </th>
                                            <td>
                                                <?= $d->nik ?>
                                            </td>
                                            <td>
                                                <?= $d->nama ?>
                                            </td>
                                            <td>
                                                <?= $d->username ?>
                                            </td>
                                            <td>
                                                <?= $d->telp ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($d->verifikasi == 0) {
                                                    echo '<form method="post"><input name="nik" type="hidden"  value="' . $d->nik . '"><input type="hidden" name="status" value="1"><button type="submit" name="edit" class="btn btn-danger"><i class="fa fa-ban"></i></button></form>';
                                                } else {
                                                    echo '<form method="post"><input name="nik" type="hidden"  value="' . $d->nik . '"><input type="hidden" name="status" value="0"><button type="submit" name="edit" class="btn btn-success"><i class="fa fa-check"></i></button></form>';
                                                }

                                                ?>
                                            </td>
                                            <td>
                                                <button type="submit" class="btn btn-primary " data-toggle="modal"
                                                    data-target="#modal-xl<?= $d->nik ?>">
                                                    Edit
                                                </button>
                                            </td>
                                            <td>
                                                <form action="" method="post">
                                                    <input type="hidden" name="nik" value="<?= $d->nik ?>"><button
                                                        type="submit" class="btn btn-danger" name="hapus"><i
                                                            class=" fa fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>

                                        <div class="modal fade" id="modal-xl<?= $d->nik ?>">
                                            <div class="modal-dialog modal-xl<?= $d->nik ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Edit Data</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="nikLama" value="<?= $d->nik ?>">
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="">Nik :</label>
                                                                <input class="form-control" type="text" name="nik"
                                                                    value="<?= $d->nik ?>">

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="">Nama :</label>
                                                                <input class="form-control" type="text" name="nama"
                                                                    value="<?= $d->nama ?>">

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="">Username :</label>
                                                                <input class="form-control" type="text" name="username"
                                                                    value="<?= $d->username ?>">

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="">Password :</label>
                                                                <input class="form-control" type="password" name="password">

                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="">No.Telp :</label>
                                                                <input class="form-control" type="number" name="telp"
                                                                    value="<?= $d->telp ?>">

                                                            </div>
                                                        </div>
                                                        <div class=" modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" name="update" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>

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