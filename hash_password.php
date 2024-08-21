<?php

// Fungsi untuk meng-hash password menggunakan Bcrypt
function hashPassword($password)
{
  return password_hash($password, PASSWORD_BCRYPT);
}

// Contoh penggunaan
$password = '12345';
$hashedPassword = hashPassword($password);

// Output hasil hash
echo "Password asli: " . $password . PHP_EOL;
echo "Password ter-hash: " . $hashedPassword . PHP_EOL;

// Kode ini hanya untuk tujuan ilustrasi dan tidak disarankan untuk digunakan dalam aplikasi produksi
