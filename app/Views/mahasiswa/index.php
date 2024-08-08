<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .container {
            max-width: 900px;
            margin-top: 30px;
        }

        .card-header {
            background-color: #343a40;
            color: white;
        }

        .table {
            margin-top: 20px;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .table th {
            background-color: #f1f1f1;
        }

        .modal-header {
            background-color: #343a40;
            color: white;
        }

        .btn-primary {
            background-color: #343a40;
            border: none;
        }

        .btn-primary:hover {
            background-color: #495057;
        }

        /* .container {
            max-width: 800px;
            margin-top: 20px;
        } */

        /* body {
            background-color: #999;

        } */
    </style>
</head>

<body>
    <!-- CONTAINER -->
    <div class="container">
        <!-- CARD -->
        <div class="card">
            <div class="card-header bg-secondary text-white">
                Data Mahasiswa
            </div>
            <div class="card-body">
                <a href="/mahasiswa/create" class="btn btn-primary mb-3">Tambah Data Mahasiswa</a>
                <table class="table mt-3 text-center">
                    <thead>
                        <tr>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Foto Diri</th>
                            <th>Foto KTP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($mahasiswa as $mhs) : ?>
                            <tr text-center>
                                <td><?= $mhs['nim'] ?></td>
                                <td><?= $mhs['nama'] ?></td>
                                <td><img src="/uploads/<?= $mhs['foto_diri'] ?>" width="100"></td>
                                <td><img src="/uploads/<?= $mhs['foto_ktp'] ?>" width="100"></td>
                                <td>
                                    <a href="/mahasiswa/edit/<?= $mhs['id'] ?>" class="btn btn-warning">Edit</a>
                                    <a href="/mahasiswa/delete/<?= $mhs['id'] ?>" class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
        <!-- SCRIPT -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <script>
            function hapus($id) {
                var result = confirm('Are you sure want to delete?');
                if (result) {
                    window.location = "<?php echo site_url('mahasiswa/hapus') ?>/" + $id;
                }
            }

            function edit($id) {
                $.ajax({
                    url: "<?php echo site_url('mahasiswa/edit') ?>/" + $id,
                    type: "get",
                    success: function(hasil) {
                        var $obj = $.parseJSON(hasil);
                        if ($obj.id != '') {
                            $('#inputId').val($obj.id);
                            $('#inputNim').val($obj.nim);
                            $('#inputNama').val($obj.nama);
                            $('#inputFotoDiri').val($obj.foto_diri);
                            $('#inputFotoKTP').val($obj.foto_ktp);
                        }
                    }
                });
            }

            function bersihkan() {
                $('#inputId').val('');
                $('#inputNim').val('');
                $('#inputNama').val('');
                $('#inputFotoDiri').val('');
                $('#inputFotoKTP').val('');
            }

            $('.tombol-tutup').on('click', function() {
                if ($('.sukses').is(":visible")) {
                    window.location.href = "<?php echo current_url() . "?" . $_SERVER['QUERY_STRING'] ?>";
                }
                $('.alert').hide();
                bersihkan();
            });

            $('#tombolSimpan').on('click', function() {
                var $id = $('#inputId').val();
                var $nim = $('#inputNim').val();
                var $nama = $('#inputNama').val();
                var $foto_diri = $('#inputFotoDiri').val();
                var $foto_ktp = $('#inputFotoKTP').val();

                $.ajax({
                    url: "<?php echo site_url('mahasiswa/simpan') ?>",
                    type: "POST",
                    data: {
                        id: $id,
                        nim: $nim,
                        nama: $nama,
                        foto_diri: $foto_diri,
                        foto_ktp: $foto_ktp,
                    },
                    success: function(hasil) {
                        var $obj = $.parseJSON(hasil);
                        if ($obj.sukses == false) {
                            $('.sukses').hide();
                            $('.error').show();
                            $('.error').html($obj.error);
                        } else {
                            $('.error').hide();
                            $('.sukses').show();
                            $('.sukses').html($obj.sukses);
                        }
                    }
                });
                bersihkan();
            });
        </script>

</body>

</html>