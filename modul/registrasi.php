<?php

session_start();
include('../config/database.php');
if (isset($_POST['cek'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['nomor'];
    $q = mysqli_query($con, "INSERT INTO `masyarakat` (nik, nama, username, password, telp, verifikasi) VALUES ('$nik', '$nama', '$username', '$password', $telp, 0)");
    if ($q) {
        echo '<div class="alert alert-success alert-dismissable">
                <a href="" class="close" data-dismiss="alert" aria-label="close">×</a>
                Registrasi Berhasil Tunggu verifikasi oleh admin
                </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="en">


<?php include('../assets/header.php') ?>

<body>

<main class="main-content  mt-0">
  
  <div class="container">
      <div class="row">
          <div class="col-4 offset-4">
              <div class="card z-index-0 mt-5">
                  <div class="card-body">
                    <form role="form" action="" method="POST">
                        <div class="mb-3">
                          <input type="text" class="form-control" placeholder="NIK" aria-label="NIK" name="nik">
                        </div>
                      <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Nama" aria-label="Name" name="nama">
                      </div>
                      <div class="mb-3">
                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" name="username">
                      </div>
                      <div class="mb-3">
                        <input type="password" class="form-control" placeholder="Password" aria-label="Password" name="password">
                      </div>
                      <div class="mb-3">
                          <input type="number" class="form-control" placeholder="Nomor Telepon" aria-label="no-telp" name="nomor">
                      </div>
                      <div class="text-center">
                        <input type="submit" value="Daftar" class="btn bg-gradient-dark w-100 my-4 mb-2" name="cek">
                      </div>
                      <p class="text-sm mt-3 mb-0">Sudah Punya Akun? Masuk <a href="../" class="text-dark font-weight-bolder">disini</a></p>
                    </form>
                  </div>
                </div>
          </div>
      </div>
  </div>
</main>

    <?php include('../assets/footer.php') ?>
</body>

</html>