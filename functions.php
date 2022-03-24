<?php
require 'connection.php';

function runQuery($query) {
  global $conn;

  return mysqli_query($conn, $query);
}

function getData($query) {
  global $conn;

  $query = mysqli_query($conn, $query);
  $data = [];

  while ($result = mysqli_fetch_assoc($query)) {
    $data[] = $result;
  }
  
  return $data;
}

function findSiswa($id) {
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM tbsiswa WHERE nis = '$id' LIMIT 1");
  $result = mysqli_fetch_assoc($query);

  return $result;
}

function findMapel($id) {
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM tbmapel WHERE id = '$id' LIMIT 1");
  $result = mysqli_fetch_assoc($query);

  return $result;
}

function findJurusan($id) {
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM tbjurusan WHERE id = '$id' LIMIT 1");
  $result = mysqli_fetch_assoc($query);

  return $result;
}

function findKelas($id) {
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM tbkelas WHERE id = '$id' LIMIT 1");
  $result = mysqli_fetch_assoc($query);

  return $result;
}

function findGuru($id) {
  global $conn;

  $query = mysqli_query($conn, "SELECT * FROM tbguru WHERE id = '$id' LIMIT 1");
  $result = mysqli_fetch_assoc($query);

  return $result;
}