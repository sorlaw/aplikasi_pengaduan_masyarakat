
<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
      
      <hr class="horizontal dark mt-0">
      <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
        
        <?php 
        if ($_SESSION['level'] == 'admin') { ?>
          
          <li class="nav-item">
            <a class="nav-link active" href="./masyarakat.php">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-badge text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Masyarakat</span>
            </a>
          </li>
        <?php }
                ?>
              <?php 
        if ($_SESSION['level'] == 'admin') { ?>   
          <li class="nav-item">
            <a class="nav-link active" href="./petugas.php">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-briefcase-24 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Petugas</span>
            </a>
          </li>
          <?php } ?>
          <li class="nav-item">
            <a class="nav-link active" href="./pengaduan.php">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-calendar-grid-58 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Pengaduan</span>
            </a>
          </li>
          <?php 
        if ($_SESSION['level'] == 'masyarakat' ) { ?> 
          <li class="nav-item">
            <a class="nav-link active" href="./profile.php">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
          </li>
          <?php }  ?>
          <li class="nav-item">
            <a class="nav-link active" href="./tanggapan.php">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-chat-round text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Tanggapan</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="./logout.php">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="ni ni-collection text-info text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Log Out</span>
            </a>
          </li>
      
      
          
        
      
        
        </ul>
      </div>
      
    </aside>