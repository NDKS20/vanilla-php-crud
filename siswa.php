<?php
require 'functions.php';

$formData = [];
$siswa = getData("SELECT * FROM tbsiswa");
$jurusan = getData("SELECT * FROM tbjurusan");
$kelas = getData("SELECT * FROM tbkelas");

if (isset($_POST['save'])) {
  if (runQuery("INSERT INTO tbsiswa (nis, nama, tgl_lahir, tempat_lahir, jenis_kelamin, id_jurusan, id_kelas) VALUES ('{$_POST['nis']}', '{$_POST['nama']}', '{$_POST['tgl_lahir']}', '{$_POST['tempat_lahir']}', '{$_POST['jenis_kelamin']}', '{$_POST['id_jurusan']}', '{$_POST['id_kelas']}')")) {
    header('Location: siswa.php');
  }
}

if (isset($_POST['delete'])) {
  if (runQuery("DELETE FROM tbsiswa WHERE nis = '{$_POST['nis']}'")) {
    header('Location: siswa.php');
  }
}

if (isset($_POST['formdata'])) {
  $formData = findSiswa($_POST['nis']);
}

if (isset($_POST['update'])) {
  $query = "UPDATE tbsiswa SET nis = '{$_POST['nis']}', nama = '{$_POST['nama']}', tgl_lahir = '{$_POST['tgl_lahir']}', tempat_lahir = '{$_POST['tempat_lahir']}', jenis_kelamin = '{$_POST['jenis_kelamin']}', id_jurusan = '{$_POST['id_jurusan']}', id_kelas = '{$_POST['id_kelas']}' WHERE nis = '{$_POST['currentId']}'";

  if (runQuery($query)) {
    header('Location: siswa.php');
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Crud Siswa</title>
</head>
<body>
  <div class="container mt-5">
    <form action="" method="POST" class="mt-4">
      <input type="hidden" name="currentId" value="<?= $formData['nis'] ?? '' ?>">
      <div class="row">
        <div class="col-lg-3 mb-3">
          <input class="form-control" type="text" placeholder="Nis" name="nis" value="<?= $formData['nis'] ?? '' ?>">
        </div>
        <div class="col-lg-3 mb-3">
          <input class="form-control" type="text" placeholder="Nama" name="nama" value="<?= $formData['nama'] ?? '' ?>">
        </div>
        <div class="col-lg-3 mb-3">
          <input class="form-control" type="date" placeholder="Tanggal Lahir" name="tgl_lahir" value="<?= $formData['tgl_lahir'] ?? '' ?>">
        </div>
        <div class="col-lg-3 mb-3">
          <input class="form-control" type="text" placeholder="Tempat Lahir" name="tempat_lahir" value="<?= $formData['tempat_lahir'] ?? '' ?>">
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <select name="jenis_kelamin" class="form-select" value="<?= $formData['jenis_kelamin'] ?? '' ?>">
              <option value="" disabled selected hidden>Pilih Jenis Kelamin</option>
              <option value="L" <?= ($formData && $formData['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>Laki-Laki</option>
              <option value="P" <?= ($formData && $formData['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>Perempuan</option>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <select name="id_jurusan" class="form-select" value="<?= $formData['id_jurusan'] ?? '' ?>">
              <option value="" disabled selected hidden>Id Jurusan</option>
              <?php foreach ($jurusan as $data) : ?>
                <option value="<?= $data['id'] ?>" <?= ($formData && $formData['id_jurusan'] == $data['id']) ? 'selected' : '' ?>><?= $data['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <select name="id_kelas" class="form-select" value="<?= $formData['id_kelas'] ?? '' ?>">
              <option value="" disabled selected hidden>Id Kelas</option>
              <?php foreach ($kelas as $data) : ?>
                <option value="<?= $data['id'] ?>" <?= ($formData && $formData['id_kelas'] == $data['id']) ? 'selected' : '' ?>><?= $data['nama'] ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        </div>
        <div class="col-lg-3">
          <div class="row">
            <div class="col-lg-6">
              <?php if (isset($formData['nis'])) : ?>
                  <button type="submit" class="btn btn-primary form-control" name="update">Update</button>
                <?php else : ?>
                  <button type="submit" class="btn btn-primary form-control" name="save">Save</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </form>

    <table class="table mt-4">
      <thead>
        <tr>
          <th scope="col">Nis</th>
          <th scope="col">Nama</th>
          <th scope="col">Tempat, Tgl Lahir</th>
          <th scope="col">Jenis Kelamin</th>
          <th scope="col">Jurusan</th>
          <th scope="col">Kelas</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($siswa as $data) : ?>
        <tr>
          <th scope="row"><?= $data['nis'] ?></th>
          <td><?= $data['nama'] ?></td>
          <td><?= $data['tempat_lahir'] . ', ' . date('j F Y', strtotime($data['tgl_lahir'])) ?></td>
          <td><?= $data['jenis_kelamin'] ?></td>
          <td><?= findJurusan($data['id_jurusan'])['nama'] ?></td>
          <td><?= findKelas($data['id_kelas'])['nama'] ?></td>
          <td class="d-flex">
            <form action="" method="POST">
              <input type="hidden" name="nis" value="<?= $data['nis'] ?>">
              <button type="submit" class="btn btn-danger" name="delete">Delete</button>
            </form>
            <form action="" method="POST">
              <input type="hidden" name="nis" value="<?= $data['nis'] ?>">
              <button type="submit" class="btn btn-warning" name="formdata">Edit</button>
            </form>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
</body>
</html>