<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</head>
<title>
    Contoh PHP CRUD</title>
<body>
    <nav class="navbar navbar-dark bg-dark">
            <span class="navbar-brand mb-0 h1">CRUD PHP</span>
        </div>   
    </nav>
<div class="container">
    <br>
    <h4><center>DAFTAR PESERTA PELATIHAN</center></h4>
<?php

    include "koneksi.php";

    if (isset($_GET['id_peserta'])) {
        $id_peserta=htmlspecialchars($_GET["ide_peserta"]);

        $sql="delete from peserta where id_peserta='$id_peserta'";
        $hasil=mysqli_query($conn,$sql);
    
            if ($hasil) {
                header("Locaton: index.php");

            }
            else {
                echo"<div class='alert alert-danger'> Data gagal dihapus.</div>";

            }
    
    }
?>

    <tr class="table-danger">
            <br>
        <thead>
            <tr>
            <table class="my-3 table table-bordered">  
                    <tr class="table-primary">
                    <th>No</th>      
                    <th>Nama</th>      
                    <th>Sekolah</th>      
                    <th>Jurusan</th>      
                    <th>No Hp</th>      
                    <th>Alamat</th>      
                    <th colspan='2' >Aksi</th>      
            </tr>
        </thead>

        <?php
        include "koneksi.php";
        $sql="SELECT * FROM peserta ORDER BY id_peserta DESC";

        $hasil=mysqli_query($conn,$sql);
        $no=0;
        while ($data = mysqli_fetch_array($hasil)) {
            $no++;
        
        ?>
        <tbody>
        <tr>
            <td><?php echo $no;?></td>
            <td><?php echo $data["nama"]; ?></td>
            <td><?php echo $data["sekolah"]; ?></td>
            <td><?php echo $data["jurusan"]; ?></td>
            <td><?php echo $data["no_hp"]; ?></td>
            <td><?php echo $data["alamat"]; ?></td>
            <td>
                <a href="update.php?id_peserta=<?php echo htmlspecialchars($data['id_peserta']); ?>" class="btn btn-warning" role="button">Update</a>
                <a href="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>id_peserta=<?php echo $data['id_peserta']; ?>" class="btn btn-danger" role="button">Delete</a>
            </td>
        </tr>    
        </tbody>
        <?php
        }
        ?>
    </table>
    <a href="create.php" class="btn btn-ptimary" role="button">Tambah Data</a>
    </div>
</body>
</html>