<?php include '../database.php'; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Products - Construction</title>
  <link rel="stylesheet" href="../css/product_user.css?v=1.0">
</head>

<header>
    <?php include "header.php";?>
  </header>
  

  <body>
  <div class="main-container">
    <div class="filter-sidebar">
      <h2>Filter Products</h2>
      <form method="GET" class="filter-form">
        <input type="text" name="search" placeholder="Search products..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">

        <h3>Categories</h3>
        <?php
        $selectedCategories = $_GET['categories'] ?? [];
        $catQuery = mysqli_query($conn, "SELECT DISTINCT category FROM products");
        while ($cat = mysqli_fetch_assoc($catQuery)) {
          $checked = in_array($cat['category'], $selectedCategories) ? 'checked' : '';
          echo '<div class="checkbox-group">';
          echo "<input type='checkbox' name='categories[]' value='{$cat['category']}' id='cat_{$cat['category']}' $checked>";
          echo "<label for='cat_{$cat['category']}'>{$cat['category']}</label>";
          echo '</div>';
        }
        ?>
        <button type="submit">Apply Filters</button>
      </form>
    </div>

    <div class="product-grid">
      <?php
      $search = $_GET['search'] ?? '';
      $categories = $_GET['categories'] ?? [];

      $query = "SELECT * FROM products WHERE 1";
      if ($search) {
        $search = mysqli_real_escape_string($conn, $search);
        $query .= " AND product_name LIKE '%$search%'";
      }
      if (!empty($categories)) {
        $escaped = array_map(function($cat) use ($conn) {
          return "'" . mysqli_real_escape_string($conn, $cat) . "'";
        }, $categories);
        $catList = implode(',', $escaped);
        $query .= " AND category IN ($catList)";
      }

      $result = mysqli_query($conn, $query);

      if (mysqli_num_rows($result) === 0) {
        echo "<p class='no-results'>No products found.</p>";
      }

      while ($row = mysqli_fetch_assoc($result)) :
        $description = htmlspecialchars($row['description']);
        $short_description = (strlen($description) > 90) ? substr($description, 0, 90) . '...' : $description;
      ?>
        <a href="../user/product_details.php?id=<?= $row['product_id'] ?>" class="product-card-link">
          <div class="product-card">
            <img src="../image/<?=htmlspecialchars($row['image']) ?>" alt="<?= htmlspecialchars($row['product_name']) ?>">
            <div class="product-info">
              <h4><?= htmlspecialchars($row['product_name']) ?></h4>
              <p class="category"><?= htmlspecialchars($row['category']) ?></p>
              <p><?= $short_description ?></p>
            </div>
          </div>
        </a>
      <?php endwhile; ?>
    </div>
  </div>
</body>

<?php
include 'footer.php';
?>

</html>

