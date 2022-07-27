<?php
  // Koneksi Database
  $server = "localhost";
  $user = "root";
  $password = "";
  $database = "dbcrud2022";

  // Buat Koneksi
  $koneksi = mysqli_connect($server, $user, $password, $database) or die(mysqli_error($koneksi));

  // kode otomatis
  $q = mysqli_query($koneksi, "SELECT kode From tbarang order by kode desc limit 1");
  $datax = mysqli_fetch_array($q);
  if($datax){
    $no_terakhir = substr($datax['kode'], -3);
    $no = $no_terakhir + 1;

    if ($no > 0 and $no <10) {
      $kode = "00". $no;
    }else if($no > 10 and $no <100){
      $kode = "0". $no;
    }else if($no > 100){
      $kode = $no;
    }
  }else{
    $kode = "001";
  }

  $tahun = date('Y');
  $vkode = "CUTI-" . $tahun . '-' .  $kode;
  //CUTI-2022-001

  // Jika Tombol Simpan diKlik
  if(isset($_POST['bsimpan'])){

   // pengujian apakah data akan diedit atau disimpan baru
   if(isset($_GET['hal']) == "edit"){
    // data akan diedit
    $edit = mysqli_query($koneksi, "UPDATE tbarang SET
                                           nama = '$_POST[tnama]',
                                           bagian = '$_POST[tbagian]',
                                           jabatan = '$_POST[tjabatan]',
                                           pengambilan = '$_POST[tpengambilan]',
                                           masuk = '$_POST[tmasuk]',
                                           keperluan = '$_POST[tkeperluan]'
                                          WHERE id_barang = '$_GET[id]'
                                   ");

   // uji jika edit data sukses
if($edit){
  echo "<script>
        alert('Edit Data Sukses');
        document.location='index.php';
      </script>";
}else{  
  echo "<script>
  alert('Edit Data Gagal');
  document.location='index.php';
</script>";

}
                
   } else {
      // Data akan disimpan baru
      $simpan = mysqli_query($koneksi, " INSERT INTO tbarang (kode, nama, bagian, jabatan, pengambilan, masuk, keperluan)
      VALUE ( '$_POST[tkode]',
              '$_POST[tnama]',
              '$_POST[tbagian]',
              '$_POST[tjabatan]',
              '$_POST[tpengambilan]',
              '$_POST[tmasuk]',
              '$_POST[tkeperluan]'
               )
    ");

// uji jika simpan data sukses
if($simpan){
echo "<script>
alert('Simpan Data Sukses');
document.location='index.php';
</script>";
}else{  
echo "<script>
alert('Simpan Data Gagal');
document.location='index.php';
</script>";

}

   }

  


  }

  //deklarasi variabel utk menampung data yang akan diedit

  $vnama = "";
  $vbagian = "";
  $vjabatan = "";
  $vpengambilan = "";
  $vmasuk = "";
  $vkeperluan = "";

  // Pengujian Jika Tombol Edit Atau Hapus Diklik
  if(isset($_GET['hal'])){
 
    // Pengujian jika edit data
    if($_GET['hal'] == 'edit'){

    // tampillkan data yang akan diedit
    $tampil = mysqli_query($koneksi, " SELECT * FROM tbarang WHERE id_barang = '$_GET[id]' ");
    $data = mysqli_fetch_array($tampil);
    if($data){
      // jika data ditemukan, maka data ditampung ke dalam variabel
      $vkode = $data['kode'];
      $vnama = $data['nama'];
      $vbagian = $data['bagian'];
      $vjabatan = $data['jabatan'];
      $vpengambilan = $data['pengambilan'];
      $vmasuk = $data['masuk'];
      $vkeperluan = $data['keperluan'];
    }
    }else if ($_GET['hal'] == "hapus") {
      //  persiapan hapus data
      $hapus = mysqli_query($koneksi, "DELETE FROM tbarang WHERE id_barang = '$_GET[id]' ");
      // uji jika hapus data sukses
if($hapus){
  echo "<script>
  alert('Hapus Data Sukses');
  document.location='table.php';
  </script>";
  }else{  
  echo "<script>
  alert('Hapus Data Gagal');
  document.location='table.php';
  </script>";
  
  }
    }


  }

?>







<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DATA SISDAMSA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-danger">
  <div class="container-fluid">
  <a href="https://sadasa.id/"><img src="image\sadasa.png" alt="logo_sadasa" width="150" height="" class="d-inline-block align-text-top mt-2 mb-2"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:white">
            About Sadasa
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="https://sadasa.id/">Situs Sadasa</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Ini nanti dikasih sesuatu</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>



<!-- awal container -->
    <div class="container">
       <h3 class="text-center mt-3">Sistem Informasi Sumber Daya Manusia</h3>
       <h3 class="text-center">Sadasa Academy</h3>


       <!--awal row-->
<div class="row">
    <!-- awal col-->
    <div class="col-md-5 mx-auto">
  
    </div>
     <!-- akhir col-->
</div>
<!-- akhir row -->

     <!-- awal card  -->
     <div class="card mt-3">
  <div class="card-header bg-danger text-light">
    Data Karyawan
    <a href="index.php"><button class="btn btn-success float-end" name="btambah" type="button">Tambah Data</button></a>
  </div>
  <div class="card-body">
    <div class="col-md-6 mx-auto">
      <form method="POST">
        <div class="input-group mb-3">
          <input type="text" name="tcari" value="<?= @$_POST['tcari'] ?>" class="form-control" placeholder="Masukkan Kata Kunci">
          <button class="btn btn-primary" name="bcari" type="submit">Cari</button>
          <button class="btn btn-danger" name="breset" type="submit">Reset</button>
        </div>

      </form>
    </div>
    <table class="table table-success table-striped table-hover table-bordered" >
      <tr> 
        <th>No.</th>
        <th>Kode Karyawan</th>
        <th>Nama Karyawan</th>
        <th>Bagian</th>
        <th>Jabatan</th>
        <th>Pengambilan Cuti</th>
        <th>Tanggal Masuk Kembali</th>
        <th>Keperluan Cuti</th>
        <th>Aksi</th>
     </tr>

     <?php
     // Persiapan Menampilkan Data
     $no = 1;

     // untuk pencarian data
     // jika tombol cari di klik
     if(isset($_POST['bcari'])){
      // tampilkan data yang dicari
      $keyword = $_POST['tcari'];
      $q = "SELECT * FROM tbarang WHERE kode like '%$keyword%' or nama like '%$keyword%' or jabatan like '%$keyword%' order by
      id_barang desc ";
     }else{
      $q = "SELECT * FROM tbarang order by id_barang desc";
     }


     $tampil = mysqli_query($koneksi, $q);
     while($data = mysqli_fetch_array($tampil)) : 

     ?>

     <tr>
      <td><?= $no++ ?></td>
      <td><?= $data['kode'] ?></td>
      <td><?= $data['nama'] ?></td>
      <td><?= $data['bagian'] ?></td>
      <td><?= $data['jabatan'] ?></td>
      <td><?= $data['pengambilan'] ?></td>
      <td><?= $data['masuk'] ?></td>
      <td><?= $data['keperluan'] ?></td>
      <td>
        <a href="index.php?hal=edit&id=<?=$data['id_barang']?>" class="btn btn-warning">Edit</a>

        <a href="index.php?hal=hapus&id=<?=$data['id_barang']?>" 
        class="btn btn-danger" onclick="return confirm('Apakah Anda yakin akan hapus data ini?')">Hapus</a>
            </td>
     </tr>

    <?php endwhile; ?>


    </table>

  </div>
  <div class="card-footer bg-danger">
    
  </div>
</div>
  <!-- awal card  -->
       




    </div>
<!-- akhir container -->






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>