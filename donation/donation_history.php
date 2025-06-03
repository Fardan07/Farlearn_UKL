<?php
include 'db.php'; 

$query = "SELECT name, amount FROM donations ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Riwayat Donasi Di FarLearn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f0f8f5;
            padding: 20px;
        }
        h2 {
            text-align: center;
            color: #2e8b57;
        }
        table {
            width: 60%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        th, td {
            padding: 12px 16px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #2e8b57;
            color: white;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <h2>Riwayat Donasi Di FarLearn</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Jumlah Donasi (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                <tr>
                    <td><?= htmlspecialchars($row['name']) ?></td>
                    <td>Rp <?= number_format($row['amount'], 0, ',', '.') ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
