<!DOCTYPE html>
<html>

<head>
    <title>Edit Mahasiswa</title>
</head>

<body>
    <h1>Edit Mahasiswa</h1>
    <form action="/mahasiswa/update/<?= $mahasiswa['id'] ?>" method="post" enctype="multipart/form-data">
        <p>
            <label for="nim">NIM:</label>
            <input type="text" name="nim" id="nim" value="<?= $mahasiswa['nim'] ?>">
        </p>
        <p>
            <label for="nama">Nama:</label>
            <input type="text" name="nama" id="nama" value="<?= $mahasiswa['nama'] ?>">
        </p>
        <p>
            <label for="foto_diri">Foto Diri:</label>
            <input type="file" name="foto_diri" id="foto_diri">
            <img src="/uploads/<?= $mahasiswa['foto_diri'] ?>" width="100">
        </p>
        <p>
            <label for="foto_ktp">Foto KTP:</label>
            <input type="file" name="foto_ktp" id="foto_ktp">
            <img src="/uploads/<?= $mahasiswa['foto_ktp'] ?>" width="100">
        </p>
        <button type="submit">Update</button>
    </form>
</body>

</html>