<?php
require_once 'config/config.php';
require_once 'core/Database.php';
require_once 'core/Model.php';
require_once 'app/models/PendaftaranModel.php';

echo "<h1>Debug Admin Dashboard</h1>";

$model = new PendaftaranModel();

echo "<h2>Test getAll():</h2>";
$data = $model->getAll();
echo "Jumlah data: " . count($data) . "<br>";
echo "<pre>";
print_r($data);
echo "</pre>";

echo "<h2>Test countTotal():</h2>";
echo "Total: " . $model->countTotal() . "<br>";

echo "<h2>Test countToday():</h2>";
echo "Hari ini: " . $model->countToday() . "<br>";

echo "<h2>Test countThisMonth():</h2>";
echo "Bulan ini: " . $model->countThisMonth() . "<br>";
?>