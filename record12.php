<!DOCTYPE html>
<html>
<head>
<title>KSEB Bill</title>
<style>
.form-container { width: 350px; margin: 20px auto; padding: 20px; border: 1px solid #ccc; }
label { display: block; margin-bottom: 5px; }
input[type="text"], input[type="number"] { width: 90%; padding: 8px; margin-bottom: 10px; border: 1px solid #ccc; }
input[type="submit"] { background-color: #4CAF50; color: white; padding: 10px 15px; border: none; cursor: pointer; }
.bill-container { width: 500px; margin: 20px auto; padding: 15px; border: 1px solid #ccc; }
table { width: 100%; border-collapse: collapse; }
th, td { padding: 6px; text-align: left; border: 1px solid #ccc; }
.header { text-align: center; margin-bottom: 10px; }
.right-align { text-align: right; }
.center-align {text-align: center;}
</style>
</head>
<body>

<div class="form-container">
  <h2>KSEB Bill</h2>
  <form method="post" action="">
    <label for="name">Name:</label>
    <input type="text" name="name" id="name" required>
    <label for="consumerId">Consumer ID:</label>
    <input type="text" name="consumerId" id="consumerId" required>
    <label for="currentReading">Unit consumed:</label>
    <input type="number" name="currentReading" id="currentReading" required>
    <input type="submit" value="Generate">
  </form>
</div>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $consumerId = $_POST["consumerId"];
    $unitConsumed = $_POST["currentReading"];

    if ($unitConsumed <= 300) {
        $energyCharges = $unitConsumed * 6.40;
    } elseif ($unitConsumed <= 350) {
        $energyCharges = $unitConsumed * 7.25;
    } elseif ($unitConsumed <= 400) {
        $energyCharges = $unitConsumed * 7.60;
    } elseif ($unitConsumed <= 500) {
        $energyCharges = $unitConsumed * 7.90;
    } else {
        $energyCharges = $unitConsumed * 8.80;
    }

    $otherCharges = 60.00;
    $totalAmount = $energyCharges + $otherCharges;

    echo "<div class='bill-container'>
            <div class='header'>
                <h2>KSEB</h2>
                <h3>ELECTRICITY BILL</h3>
            </div>
            <table>
                <tr><td><strong>Consumer No:</strong> C#$consumerId</td></tr>
                <tr><td><strong>Name:</strong> $name</td></tr>
                <tr><td><strong>Due Date:</strong> " . date("d/m/Y", strtotime("+15 days")) . "</td></tr>
            </table>

            <table>
                <tr>
                    <th class='center-align'>Consumption</th>
                </tr>
                <tr>
                    <td class='center-align'>$unitConsumed</td>
                </tr>
            </table>

            <table>
                <tr><td><strong>Energy Charges:</strong></td><td class='right-align'>" . number_format($energyCharges, 2) . "</td></tr>
                <tr><td><strong>Other Charges:</strong></td><td class='right-align'>" . number_format($otherCharges, 2) . "</td></tr>
                <tr><td><strong>Total Payable:</strong></td><td class='right-align'>" . number_format($totalAmount, 2) . "</td></tr>
            </table>

        </div>";
}
?>

</body>
</html>
