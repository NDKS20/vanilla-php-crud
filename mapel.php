<?php
require 'functions.php';

$formData = [];
$siswa = getData("SELECT * FROM tbmapel");
$jurusan = getData("SELECT * FROM tbjurusan");
$kelas = getData("SELECT * FROM tbkelas");
$guru = getData("SELECT * FROM tbguru");

if (isset($_POST['save'])) {
  if (runQuery("INSERT INTO tbmapel (id, nama, id_guru, id_kelas, id_jurusan) VALUES ('{$_POST['id']}', '{$_POST['nama']}', '{$_POST['id_guru']}', '{$_POST['id_kelas']}', '{$_POST['id_jurusan']}')")) {
    header('Location: mapel.php');
  }
}

if (isset($_POST['delete'])) {
  if (runQuery("DELETE FROM tbmapel WHERE id = '{$_POST['id']}'")) {
    header('Location: mapel.php');
  }
}

if (isset($_POST['formdata'])) {
  $formData = findMapel($_POST['id']);
}

if (isset($_POST['update'])) {
  $query = "UPDATE tbmapel SET id = '{$_POST['id']}', nama = '{$_POST['nama']}', id_guru = '{$_POST['id_guru']}', id_kelas = '{$_POST['id_kelas']}', id_jurusan = '{$_POST['id_jurusan']}' WHERE id = '{$_POST['currentId']}'";

  if (runQuery($query)) {
    header('Location: mapel.php');
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
      <input type="hidden" name="currentId" value="<?= $formData['id'] ?? '' ?>">
      <div class="row">
        <div class="col-lg-3 mb-3">
          <input class="form-control" type="text" placeholder="Id" name="id" value="<?= $formData['id'] ?? '' ?>">
        </div>
        <div class="col-lg-3 mb-3">
          <input class="form-control" type="text" placeholder="Nama" name="nama" value="<?= $formData['nama'] ?? '' ?>">
        </div>
        <div class="col-lg-3">
          <div class="form-group">
            <select name="id_guru" class="form-select" value="<?= $formData['id_guru'] ?? '' ?>">
              <option value="" disabled selected hidden>Id Guru</option>
              <?php foreach ($guru as $data) : ?>
                <option value="<?= $data['id'] ?>" <?= ($formData && $formData['id_guru'] == $data['id']) ? 'selected' : '' ?>><?= $data['nama'] ?></option>
              <?php endforeach; ?>
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
              <?php if (isset($formData['id'])) : ?>
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
          <th scope="col">Id</th>
          <th scope="col">Nama</th>
          <th scope="col">Guru</th>
          <th scope="col">Kelas</th>
          <th scope="col">Jurusan</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($siswa as $data) : ?>
        <tr>
          <th scope="row"><?= $data['id'] ?></th>
          <td><?= $data['nama'] ?></td>
          <td><?= findGuru($data['id_guru'])['nama'] ?></td>
          <td><?= findKelas($data['id_kelas'])['nama'] ?></td>
          <td><?= findJurusan($data['id_jurusan'])['nama'] ?></td>
          <td class="d-flex">
            <form action="" method="POST">
              <input type="hidden" name="id" value="<?= $data['id'] ?>">
              <button type="submit" class="btn btn-danger" name="delete">Delete</button>
            </form>
            <form action="" method="POST">
              <input type="hidden" name="id" value="<?= $data['id'] ?>">
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