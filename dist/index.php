<?php
include 'session_login.php';
include 'head.php';
include 'navbar.php';

?>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <!--  -->
    <!-- /.row-->
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">Presensi</h4>
            <div class="small my-1 text-large-emphasis"><?php echo "Tanggal " . date("d-m-Y") . "<br>";
 ?></div>
          </div>
        </div>
        <div>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">PPLG</th>
                <th scope="col">AKL</th>
                <th scope="col">MPLB</th>
                <th scope="col">PM</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <a href="input_presensi.php?kelas=xi_pplg_1" class="d-flex justify-content-between">
                    <p>XI PPLG 1</p>
                  </a>
                </td>
                <td>
                  <a href="input_presensi.php?kelas=xi_akl_1" class="d-flex justify-content-between">
                    <p>XI AKL 1</p>
                  </a>
                </td>
                <td>
                  <a href="input_presensi.php?kelas=xi_mplb_1" class="d-flex justify-content-between">
                    <p>XI MPLB 1</p>
                  </a>
                </td>
                <td>
                  <a href="input_presensi.php?kelas=xi_pm_1" class="d-flex justify-content-between">
                    <p>XI PM 1</p>
                  </a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <?php
  include 'footer.php';
  ?>