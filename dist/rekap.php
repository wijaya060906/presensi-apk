<?php
include 'session_login.php';
include 'head.php';
include 'navbar.php';
include 'koneksi.php';

$kelas = $_GET['kelas'];
$sql = "SELECT siswa.nama_lengkap, presensi.keterangan, presensi.tanggal FROM presensi LEFT JOIN siswa ON siswa.id = presensi.id_siswa WHERE siswa.kelas = '$kelas' ORDER BY siswa.nama_lengkap;";
$result = mysqli_query($conn, $sql);
$tanggalArray = [];

while ($row = mysqli_fetch_assoc($result)) {
  $tanggalArray[] = $row['tanggal'];
}

$tanggalArray = array_unique($tanggalArray); // Remove duplicate dates
sort($tanggalArray); // Sort dates


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
          <div>
            <a href="edit.php?kelas=<?php echo "$kelas"; ?> "><button type="submit" class="btn btn-primary" name="submit">Edit</button></a>
          </div>
        </div>
        <div>
          <form action="input_presensi.php" method="POST">
            <table class="table table-dark table-striped-columns">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <?php
                  foreach ($tanggalArray as $tanggal) {
                    echo "<th>$tanggal</th>";
                  }
                  ?>
                </tr>
              </thead>

              <tbody>
                <?php
                $i = 1;
                mysqli_data_seek($result, 0);

                $processedNames = []; // To track processed names

                while ($row = mysqli_fetch_assoc($result)) {
                  if (!in_array($row['nama_lengkap'], $processedNames)) {
                    echo "<tr>";
                    echo "<td><p>$i</p></td>";
                    echo "<td><span>{$row['nama_lengkap']}</span></td>";
                    
                    foreach ($tanggalArray as $tanggal) {
                      // Modify the query to use table aliases
                      $queryPresensi = "SELECT presensi.keterangan FROM presensi LEFT JOIN siswa ON siswa.id = presensi.id_siswa WHERE siswa.nama_lengkap = '{$row['nama_lengkap']}' AND siswa.kelas = '$kelas' AND presensi.tanggal = '$tanggal'";
                      $resultPresensi = mysqli_query($conn, $queryPresensi);
                      $keterangan = "";
                      
                      if ($rowPresensi = mysqli_fetch_assoc($resultPresensi)) {
                        $keterangan = $rowPresensi['keterangan'];
                      }
                      
                      echo "<td><span>$keterangan</span></td>";
                    }
                    
                    echo "</tr>";
                    $processedNames[] = $row['nama_lengkap']; // Add the processed name to the array
                    $i++;
                  }
                }
                ?>
              </tbody>
            </table>
          </form>
        </div>
      </div>
    </div>
    <?php
    include 'footer.php';
    ?>
