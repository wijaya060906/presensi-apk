<?php


include 'session_login.php';
include 'head.php';
include 'navbar.php';
include 'koneksi.php';

$kelas = $_GET['kelas'];
$currentDate = date("Y-m-d"); // Get the current date

$sql = "SELECT siswa.id, siswa.nama_lengkap, siswa.kelas, presensi.keterangan, presensi.tanggal 
        FROM presensi 
        LEFT JOIN siswa ON siswa.id = presensi.id_siswa 
        WHERE siswa.kelas = '$kelas' AND DATE(presensi.tanggal) = CURDATE()
        ORDER BY siswa.nama_lengkap;";

$result = mysqli_query($conn, $sql);

if (isset($_POST['ubah'])) {
  while ($row = mysqli_fetch_assoc($result)) {
      $id_siswa = $row['id'];
      $keterangan = $_POST[$id_siswa];

      $updateQuery = "UPDATE `presensi` SET `keterangan` = '$keterangan' WHERE `id_siswa` = '$id_siswa' AND DATE(tanggal) = CURDATE()";
      $updateResult = mysqli_query($conn, $updateQuery);
  }

  if ($updateResult) {
      echo "<script>alert('Data berhasil diubah');window.location.href='index.php';</script>";
  } else {
      echo "<script>alert('Data gagal diubah');window.location.href='index.php';</script>";
  }
}

?>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0">XI PPLG 1</h4>
            <div class="small text-medium-emphasis">January - July 2022</div>
          </div>
        </div>
        <div>
          <form action="" method="POST">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Keterangan</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                // mysqli_data_seek($result, 0);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr>
                    <td>
                      <p><?php echo $i++; ?></p>
                    </td>
                    <td>
                      <input type="hidden" name="id_siswa" value="<?= $row['id'] ?>">
                      <span><?php echo $row['nama_lengkap']; ?></span>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault1" value="hadir" <?php echo ($row['keterangan'] == 'hadir') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="flexRadioDefault1">
                            Hadir
                          </label>
                        </div>
                        <div class="mx-2">
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault2" value="izin" <?php echo ($row['keterangan'] == 'izin') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="flexRadioDefault2">
                            Izin
                          </label>
                        </div>
                        <div class="mx-2">
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault3" value="sakit" <?php echo ($row['keterangan'] == 'sakit') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="flexRadioDefault3">
                            Sakit
                          </label>
                        </div>
                        <div>
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault4" value="alpa" <?php echo ($row['keterangan'] == 'alpa') ? 'checked' : ''; ?>>
                          <label class="form-check-label" for="flexRadioDefault4">
                            Alpa
                          </label>
                        </div>

                    </td>
                  </tr>
                <?php
                }


                ?>
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary" name="ubah">Ubah</button>
          </form>
        </div>
      </div>
    </div>
    <?php
    include 'footer.php';
    ?>