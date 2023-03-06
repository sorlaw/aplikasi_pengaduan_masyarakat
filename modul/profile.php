<!DOCTYPE html>
<html lang="en">
<?php

session_start();
if (empty($_SESSION['username'])) {
    @header('location:login.php');
} else {
    $nik = $_SESSION['nik'];
    $nama = $_SESSION['nama'];
    $username = $_SESSION['username'];
    $telp = $_SESSION['telp'];
}
?>

<?php include('../assets/header.php') ?>

<body>
    <div class="container-fluid mt-5">
        <div class="row justify-content-center">
            <div class="info">
                <!-- <div class="alert alert-success mt-3" alert-dismiss>
                    <h5>Halo!
                        <br> Selamat datang
                        <?= $_SESSION['username'] ?> Anda login sebagai
                        <?= $_SESSION['level'] ?>
                    </h5>
                </div> -->
                <div class="col-4">

                    <?php include('../assets/menu.php') ?>
                </div>
                <div class="col-9" style="margin-left: 300px;">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Profile</h5>
                        </div>
                        <div class="card-body">


                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><i class=" "></i>
                                    <img style="max-height: 200px;" src="../assets/images/no-foto.png" alt=""
                                        class="img img-thumbnail ">
                                </li>
                                <li class="list-group-item"><i class="fa fa-address-card"></i> Nik :
                                    <?= $_SESSION['nik'] ?>
                                </li>
                                <li class="list-group-item"><i class="fa fa-address-book"></i> Nama Lengkap :
                                    <?= $_SESSION['nama'] ?>
                                </li>
                                <li class="list-group-item"><i class="fa fa-user"></i> Username :
                                    <?= $_SESSION['username'] ?>
                                </li>
                                <li class="list-group-item"><i class="fa fa-phone"></i> No.Telp :
                                    <?= $_SESSION['telp'] ?>
                                </li>
                                <li class="list-group-item"><i class="fa fa-circle"></i> Status :
                                    <?= $_SESSION['level'] ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include('../assets/footer.php') ?>
</body>

</html>