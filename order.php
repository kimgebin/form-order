<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Form Order PBN</title>
  <style>
    body { font-family: Arial, sans-serif; padding: 20px; max-width: 600px; margin: auto; background: #f9f9f9; }
    h2 { color: #333; }
    label { display: block; margin-top: 10px; }
    input, select { width: 100%; padding: 8px; margin-top: 5px; }
    .total { margin-top: 15px; font-weight: bold; font-size: 1.2em; }
    .payment-info { margin-top: 20px; padding: 15px; background: #e1f5fe; border-left: 5px solid #03a9f4; }
  </style>
</head>
<body>

<h2>Form Order PBN</h2>
<form method="post">
  <label>Brand:</label>
  <input type="text" name="brand" required>

  <label>Nomor WhatsApp / Telegram:</label>
  <input type="text" name="contact" required>

  <label>URL 1:</label>
  <input type="url" name="url1" required>

  <label>URL 2:</label>
  <input type="url" name="url2">

  <label>URL 3:</label>
  <input type="url" name="url3">

  <label>Paket:</label>
  <select name="paket" required>
    <option value="post">Post</option>
    <option value="sticky">Sticky</option>
    <option value="blogroll">Blogroll</option>
  </select>

  <label>Jumlah PBN:</label>
  <select name="jumlah" id="jumlah" required>
    <?php for ($i = 25; $i <= 2000; $i += 25) {
      echo "<option value='$i'>$i</option>";
    } ?>
  </select>

  <label>Harga per PBN (Rp):</label>
  <input type="number" name="harga" id="harga" required>

  <label>Durasi:</label>
  <select name="durasi" required>
    <option value="1 bulan">1 Bulan</option>
    <option value="3 bulan">3 Bulan</option>
    <option value="permanent">Permanent</option>
  </select>

  <div class="total" id="total-harga">Total: Rp 0</div>

  <button type="submit">Submit Order</button>
</form>

<div class="payment-info">
  <strong>Transfer Pembayaran ke:</strong><br>
  BCA a.n. <strong>NOVIANA</strong><br>
  No. Rekening: <strong>8005036671</strong>
</div>

<script>
  const jumlah = document.getElementById('jumlah');
  const harga = document.getElementById('harga');
  const total = document.getElementById('total-harga');

  function updateTotal() {
    const jml = parseInt(jumlah.value);
    const hrg = parseInt(harga.value);
    if (!isNaN(jml) && !isNaN(hrg)) {
      const totalHarga = jml * hrg;
      total.innerText = `Total: Rp ${totalHarga.toLocaleString('id-ID')}`;
    }
  }

  jumlah.onchange = updateTotal;
  harga.oninput = updateTotal;
</script>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  echo "<hr><h3>Data Order:</h3>";
  echo "<ul>";
  foreach ($_POST as $key => $value) {
    echo "<li><strong>" . ucfirst($key) . "</strong>: " . htmlspecialchars($value) . "</li>";
  }
  $totalHarga = intval($_POST['jumlah']) * intval($_POST['harga']);
  echo "<li><strong>Total Harga</strong>: Rp " . number_format($totalHarga, 0, ',', '.') . "</li>";
  echo "</ul>";
}
?>

</body>
</html>
