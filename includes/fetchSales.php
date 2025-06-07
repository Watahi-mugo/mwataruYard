<?php
     require_once "connect.php";

$stmt = $connect->query("SELECT * FROM sales ORDER BY sale_date DESC");
$sales = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($sales) > 0) {
    foreach ($sales as $sale) {
        echo "<tr>
                <td>" . htmlspecialchars($sale['id']) . "</td>
                <td>" . htmlspecialchars($sale['feet']) . "</td>
                <td>" . htmlspecialchars($sale['type']) . "</td>
                <td>" . htmlspecialchars($sale['dimensions']) . "</td>
                <td>" . htmlspecialchars($sale['price']) . "</td>
                <td>" . htmlspecialchars($sale['sale_date']) . "</td>
              </tr>";
    }
} else {
    echo "<tr><td colspan='6' class='text-center py-4 text-gray-500'>No sales found.</td></tr>";
}

