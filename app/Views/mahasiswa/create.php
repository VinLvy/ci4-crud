<h1>Tambah Mahasiswa</h1>
<form action="/mahasiswa/store" method="post" enctype="multipart/form-data">
    <p>
        <label for="nim">NIM:</label>
        <input type="text" name="nim" id="nim">
    </p>
    <p>
        <label for="nama">Nama:</label>
        <input type="text" name="nama" id="nama">
    </p>
    <p>
        <label for="foto_diri">Foto Diri:</label>
        <input type="file" name="foto_diri" id="foto_diri">
    </p>
    <p>
        <label for="foto_ktp">Foto KTP:</label>
        <input type="file" name="foto_ktp" id="foto_ktp">
    </p>
    <button type="submit">Simpan</button>
</form>