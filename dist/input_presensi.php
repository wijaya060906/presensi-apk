<?php
include 'session_login.php';
include 'head.php';
include 'navbar.php';
include 'koneksi.php';

$kelas = $_GET['kelas'];
$sql = "SELECT * FROM siswa WHERE kelas = '$kelas' order by nama_lengkap";
$result = mysqli_query($conn, $sql);

if (isset($_POST['submit'])) {
    while ($row = mysqli_fetch_assoc($result)) {
        $id_siswa = $row['id'];
        $keterangan = $_POST[$id_siswa];

        // Check if the student has already submitted attendance today
        $checkQuery = "SELECT * FROM presensi WHERE id_siswa = '$id_siswa' AND DATE(tanggal) = CURDATE()";
        $checkResult = mysqli_query($conn, $checkQuery);

        if (mysqli_num_rows($checkResult) == 0) {
            // If the student hasn't submitted attendance today, insert the new data
            $insertQuery = "INSERT INTO `presensi` VALUES (NULL, '$id_siswa', '$keterangan', CURRENT_TIMESTAMP)";
            $insertResult = mysqli_query($conn, $insertQuery);
        } else {
            // If the student has already submitted attendance today, you may want to handle this case (e.g., show a message)
            // For simplicity, we'll just skip the insertion in this example
        }

        mysqli_free_result($checkResult);
    }

    if ($insertResult) {
        echo "<script>alert('Data berhasil ditambahkan');window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Data sudah pernah ditambahkan');window.location.href='index.php';</script>";
    }
}


?>
<div class="body flex-grow-1 px-3">
  <div class="container-lg">
    <div class="card mb-4">
      <div class="card-body">
        <div class="d-flex justify-content-between">
          <div>
            <h4 class="card-title mb-0"><?php echo $kelas; ?></h4>
            <div class="small my-1 text-large-emphasis"><?php echo "Tanggal " . date("d-m-Y") . "<br>";
 ?></div>
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
                    <input type="hidden" name="id_siswa" value="<?= $row['id']?>">
                      <span><?php echo $row['nama_lengkap']; ?></span>
                    </td>
                    <td>
                      <div class="d-flex">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="<?= $row['id']?>" id="flexRadioDefault1" value="hadir" checked>
                          <label class="form-check-label" for="flexRadioDefault1">
                            Hadir
                          </label>
                        </div>
                        <div class="mx-2">
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault2" value="izin">
                          <label class="form-check-label" for="flexRadioDefault2">
                            Izin
                          </label>
                        </div>
                        <div class="mx-2">
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault3" value="sakit">
                          <label class="form-check-label" for="flexRadioDefault3">
                            Sakit
                          </label>
                        </div>
                        <div>
                          <input class="form-check-input" type="radio" name="<?= $row['id'] ?>" id="flexRadioDefault4" value="alpa">
                          <label class="form-check-label" for="flexRadioDefault4">
                            Alpa
                          </label>
                        </div>
                      </div>
                    </td>
                  </tr>
                <?php
                }

              
                ?>
              </tbody>
            </table>
            <button type="submit" class="btn btn-primary" name="submit">Kirim</button>
          </form>
        </div>
      </div>
    </div>
    <?php
    include 'footer.php';
    ?>