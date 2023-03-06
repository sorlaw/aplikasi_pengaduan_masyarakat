<!DOCTYPE html>
<html lang="en">
<?php

include('../config/database.php');
if (isset($_POST['cek'])) {
    $pilihan = $_POST['pilihan']; //masyarakat atau petugas
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if ($pilihan == 'masyarakat') {
        $q = mysqli_query($con, "SELECT * FROM `masyarakat` WHERE username='$username' AND password='$password' AND verifikasi= 1 ");
        $r = mysqli_num_rows($q);
        if ($r == 1) {
            $d = mysqli_fetch_object($q);
            session_start();
            $_SESSION['nik'] = $d->nik;
            $_SESSION['nama'] = $d->nama;
            $_SESSION['username'] = $d->username;
            $_SESSION['telp'] = $d->telp;
            $_SESSION['level'] = 'masyarakat';
            header('location:profile.php');
        } else {
            echo '<div class="alert alert-danger alert-dismissable" >
        <a href="" class="close" data-dismiss="alert" ></a>
        data yang anda masukan salah atau belum terverifikasi
        </div>';
        }
    } elseif ($pilihan == 'petugas') {
        $q = mysqli_query($con, "SELECT * FROM `petugas` WHERE username='$username' AND password='$password'");
        $r = mysqli_num_rows($q);
        if ($r == 1) {
            $d = mysqli_fetch_object($q);
            session_start();
            $_SESSION['username'] = $d->username;
            $_SESSION['id_petugas'] = $d->id_petugas;
            $_SESSION['level'] = $d->level;
            header('location:petugas.php');
        }
    }
}
?>

<?php include('../assets/header.php') ?>

<body>

<main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-100">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-xl-4 col-lg-5 col-md-7 d-flex mx-lg-0 mx-auto justify-content-center">
              <div class="card card-plain">
                <div class="card-header pb-0 text-start">
                  <h4 class="font-weight-bolder">Masuk</h4>
                  <p class="mb-0">Masukkan Username dan Password</p>
                </div>
                <div class="card-body">
                  <form role="form" action="" method="POST">
                    <div class="mb-3">
                      <input type="text" class="form-control form-control-lg" placeholder="Username" aria-label="Email" id="user" name="username">
                    </div>
                    <div class="mb-3">
                      <input type="password" class="form-control form-control-lg" placeholder="Password" aria-label="Password" id="pass" name="password">
                    </div>
                    <select class="form-select" name="pilihan" id="pilih" > 
                      <option value="masyarakat">Masyarakat</option>
                      <option value="petugas">Petugas</option>
                    </select>
                    <div class="text-center">
                      <!-- <button type="button" class="btn btn-lg btn-primary btn-lg w-100 mt-4 mb-0" name="cek">Masuk</button> -->
                      <input type="submit" value="Masuk" name="cek" class="btn btn-primary mt-3">
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                    Tidak punya akun? daftar 
                    <a class="text-primary text-gradient font-weight-bold" id="register" href="./registrasi.php">disini</a>
                    
                  </p>
                 
  

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>

    <?php include('../assets/footer.php') ?>
</body>

</html>