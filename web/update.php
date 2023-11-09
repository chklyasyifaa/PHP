<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Formulir Pendaftaran Anggota</title>
</head>
<body>
   <div class="container">
    <?php
    
    include "koneksi.php";

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    if (isset($_GET['id_peserta'])) {
        $id_peserta=input($_GET["id_peserta"]);

        $sql="SELECT * FROM peserta WHERE id_peserta=$id_peserta";
        $hasil=mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($hasil);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $id_peserta=htmlspecialchars($_POST["id_peserta"]);
        $nama=input($_POST["nama"]);
        $sekolah=input($_POST["sekolah"]);
        $jurusan=input($_POST["jurusan"]);
        $no_hp=input($_POST["no_hp"]);
        $alamat=input($_POST["alamat"]);

        $sql="UPDATE  peserta SET
            nama='$nama',
            sekolah='$sekolah',
            jurusan='$jurusan',
            no_hp='$no_hp',
            alamat='$alamat',
            WHERE id_peserta ='$id_peserta'";

        $hasil = mysqli_query($conn,$sql);

        if ($hasil) {
            header("Location:index.php");
        }
        else {
            echo "<div class='alert alert-danger> Data gagal disimpan.</div>";

        }

    }

    ?>
    <h2>Update data</h2>


    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])?>" method="post">
        <div class="form-group">
            <label>Nama:</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama'];?>" placeholder="Masukan Nama" required/>
        </div>
        <div class="form-group">
            <label>Sekolah:</label>
            <input type="text" name="sekolah" class="form-control" value="<?= $data['sekolah'];?>" placeholder="Masukan Nama Sekolah" required/>
        </div>
        <div class="form-group">
            <label>Jurusan:</label>
            <input type="text" name="jurusan" class="form-control" value="<?= $data['jurusan'];?>" placeholder="Masukan Jurusan" required/>
        </div>
        <div class="form-group">
            <label>No HP:</label>
            <input type="text" name="no_hp" class="form-control" value="<?= $data['no_hp'];?>" placeholder="Masukan No HP" required/>
        </div>
        <div class="form-group">
            <label>Alamat:</label>
            <input type="text" name="alamat" class="form-control" value="<?= $data['alamat'];?>" placeholder="Masukan Alamat" required/>
        </div>

        <input type="hidden" name="id_peserta" value="<?php echo $data['id_peserta']; ?>">

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
   </div> 
</body>
</html>