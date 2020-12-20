<?php 
session_start();

if( !isset($_SESSION["login"])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
$mahasiswa = query("SELECT * FROM mahasiswa ORDER BY id DESC");

// tombol search ditekan
if ( isset($_POST["cari"])) {
    $mahasiswa = cari($_POST["keyword"]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Admin</title>
    <style>
        .loader {
            width: 100px;
            position: absolute;
            top: 95px;
            left: 380px;
            z-index: -1;
            display: none;
        }
    </style>
    <!-- Jquery -->
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/script.js"></script>
</head>
<body>
    <a href="logout.php" id="logout">LOGOUT</a>| <a href="cetak.php" target="_blank">Cetaks</a>
    
    <h1>List College Students</h1>
    <a href="tambah.php">Tambah data mahasiswa</a>
    <br><br>
    
    <form action="" method="post">
        <input type="text" name="keyword" id="keyword" placeholder="Searching want you need.." size="50" autofocus autocomplete="off">
        <button type="submit" name="cari" id="tombol-cari">Seacrh</button>
        <img src="img/loader.gif" alt="" class="loader">
    </form>
    <br>

    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Action</th>
            <th>Picture</th>
            <th>NRP</th>
            <th>Name</th>
            <th>Email</th>
            <th>Jurusan</th>
        </tr>
        <?php $i=1 ?>
        <?php foreach( $mahasiswa as $row) : ?>
        <tr>
            <td><?= $i ?></td>
            <td>
                <a href="edit.php?id=<?= $row["id"] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row["id"] ?>" onclick="return confirm('Are You sure about that?')">Delete</a>
            </td>
            <td>
                <img src="foto/<?= $row["pict"] ?>" width="50" alt="">
            </td>
            <td><?= $row["nrp"]; ?></td>
            <td><?= $row["name"]; ?></td>
            <td><?= $row["email"]; ?></td>
            <td><?= $row["jurusan"]; ?></td>
        </tr>
        <?php $i++ ?>
        <?php endforeach; ?>
    </table>
    </div>
</body>
</html>