<?php
include 'database.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = $_POST['product_name'];
    $category = $_POST['category'];
    $brand_name = $_POST['brand_name'];
    $unit_of_measure = $_POST['unit_of_measure'];
    $weight = $_POST['weight'];
    $material_type = $_POST['material_type'];
    $description = $_POST['description'];

    function uploadImage($fileKey, $folder = 'image') {
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]['error'] == 0) {
            // Ensure the folder exists
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }

            $image_name = $_FILES[$fileKey]['name'];
            $image_temp = $_FILES[$fileKey]['tmp_name'];
            $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
            $image_name_new = uniqid() . '.' . $image_ext;
            $image_path = $folder . '/' . $image_name_new;

            if (move_uploaded_file($image_temp, $image_path)) {
                return $image_name_new;
            }
        }
        return ''; // Return empty string if upload fails or no file selected
    }

    // Upload images (optional)
    $image1 = uploadImage('image1');
    $image2 = uploadImage('image2');
    $image3 = uploadImage('image3');

    // Use prepared statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO products 
        (product_name, category, brand_name, description, unit_of_measure, weight, material_type, image, image2, image3) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "ssssssssss", 
        $product_name, 
        $category, 
        $brand_name, 
        $description, 
        $unit_of_measure, 
        $weight, 
        $material_type, 
        $image1, 
        $image2, 
        $image3
    );

    if ($stmt->execute()) {
        echo "<script>alert('Product added successfully!'); window.location.href='product_admin.php';</script>";
    } else {
        echo "Database error: " . $stmt->error;
    }

    $stmt->close();
}

$result = mysqli_query($conn, "SELECT * FROM products");

include 'sidebar_admin.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
  
  <meta charset="UTF-8">
  <title>Product Management</title>
  <link rel="stylesheet" href="css/product_admin.css?=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
 
</head>
<body>

<div class="container mt-5">
<div class="container-fluid py-4 px-5">
  <div class="row">
    <!-- Filter Panel -->
    <div class="col-lg-3 col-md-4 mb-4">
      <div class="filter-panel p-4 rounded bg-white shadow-sm h-100">
        <h5 class="text-dark mb-4">Filter Products</h5>
        <form method="GET">
          <!-- Search -->
          <div class="mb-4">
            <input type="text" name="search" class="form-control" placeholder="Search by name" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
          </div>

          <!-- Categories as Checkboxes -->
          <div class="mb-4">
            <label class="form-label">Category</label>
            <?php
              $categoriesQuery = "SELECT DISTINCT category FROM products";
              $categoriesResult = mysqli_query($conn, $categoriesQuery);
              while ($categoryRow = mysqli_fetch_assoc($categoriesResult)) {
                $cat = $categoryRow['category'];
                $isChecked = (isset($_GET['category']) && is_array($_GET['category']) && in_array($cat, $_GET['category'])) ? 'checked' : '';
                echo "<div class='form-check'>
                        <input class='form-check-input' type='checkbox' name='category[]' value='{$cat}' id='cat_$cat' $isChecked>
                        <label class='form-check-label' for='cat_$cat'>$cat</label>
                      </div>";
              }
            ?>
          </div>

          <button type="submit" class="btn btn-outline-primary w-100">Apply Filter</button>
        </form>
      </div>
    </div>

    <!-- Product List Panel -->
    <div class="col-lg-9 col-md-8">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="text-dark">Product List</h4>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#addProductModal">+ Add Product</button>
      </div>

      <div class="table-responsive table-container">
        <table class="table table-hover align-middle text-center">
          <thead class="table-dark">
            <tr>
              <th>#ID</th>
              <th>Name</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Description</th>
              <th>Unit</th>
              <th>Weight</th>
              <th>Material</th>
              <th>Image</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
              $search = $_GET['search'] ?? '';
              $categoryFilter = $_GET['category'] ?? [];

              $query = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
              if (!empty($categoryFilter)) {
                $catList = implode("','", array_map('mysqli_real_escape_string', array_fill(0, count($categoryFilter), $conn), $categoryFilter));
                $query .= " AND category IN ('$catList')";
              }
              $result = mysqli_query($conn, $query);

              while ($row = mysqli_fetch_assoc($result)):
            ?>
              <tr>
                <td><strong><?= $row['product_id'] ?></strong></td>
                <td><?= htmlspecialchars($row['product_name']) ?></td>
                <td><?= htmlspecialchars($row['category']) ?></td>
                <td><?= htmlspecialchars($row['brand_name']) ?></td>
                <td style="max-width: 200px;"><?= htmlspecialchars($row['description']) ?></td>
                <td><?= htmlspecialchars($row['unit_of_measure']) ?></td>
                <td><?= $row['weight'] ?></td>
                <td><?= htmlspecialchars($row['material_type']) ?></td>
                <td>
                  <img src="image/<?= htmlspecialchars($row['image']) ?>" alt="Product Image" class="product-image">
                </td>
                
                <td>
              <!-- Edit Link with Icon -->
              <a href="#" class="text-primary me-2 edit-icon" data-bs-toggle="modal" data-bs-target="#editProductModal<?= $row['product_id'] ?>" title="Edit">
                <i class="bi bi-pencil-square"></i>
              </a>

              <!-- Delete Link with Icon -->
              <a href="delete_product.php?id=<?= $row['product_id'] ?>" class="text-danger delete-icon" title="Delete" onclick="return confirm('Are you sure you want to delete this product?');">
                <i class="bi bi-trash-fill"></i>
              </a>
            </td>
            </tr>


       <!-- Edit Modal -->
<div class="modal fade" id="editProductModal<?= $row['product_id'] ?>" tabindex="-1" aria-labelledby="editProductModalLabel<?= $row['product_id'] ?>" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="update_product.php" method="POST" enctype="multipart/form-data">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editProductModalLabel<?= $row['product_id'] ?>">Update Product</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">
          <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Product Name</label>
              <input type="text" name="product_name" class="form-control" value="<?= htmlspecialchars($row['product_name']) ?>" required>
            </div>

            <div class="col-md-6">
              <label class="form-label">Category</label>
              <input type="text" name="category" class="form-control" value="<?= htmlspecialchars($row['category']) ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Brand Name</label>
              <input type="text" name="brand_name" class="form-control" value="<?= htmlspecialchars($row['brand_name']) ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Unit of Measure</label>
              <input type="text" name="unit" class="form-control" value="<?= htmlspecialchars($row['unit_of_measure']) ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Weight</label>
              <input type="text" name="weight" class="form-control" value="<?= htmlspecialchars($row['weight']) ?>">
            </div>

            <div class="col-md-6">
              <label class="form-label">Material Type</label>
              <input type="text" name="material" class="form-control" value="<?= htmlspecialchars($row['material_type']) ?>">
            </div>

            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea name="description" rows="3" class="form-control"><?= htmlspecialchars($row['description']) ?></textarea>
            </div>

              <!-- Main Photo -->
            <div class="col-md-4">
              <label class="form-label">Main Photo</label>
              <?php if (!empty($row['image'])): ?>
                <div class="mb-2">
                  <img src="image/<?= htmlspecialchars($row['image']) ?>" alt="Main Photo" class="img-thumbnail" style="max-height: 100px;">
                </div>
              <?php endif; ?>
              <input type="file" name="image" class="form-control">
            </div>

            <!-- Alternate Angle -->
            <div class="col-md-4">
              <label class="form-label">Alternate Angle</label>
              <?php if (!empty($row['image2'])): ?>
                <div class="mb-2">
                  <img src="image/<?= htmlspecialchars($row['image2']) ?>" alt="Alternate Angle" class="img-thumbnail" style="max-height: 100px;">
                </div>
              <?php endif; ?>
              <input type="file" name="image2" class="form-control">
            </div>

            <!-- Close-up or Another View -->
            <div class="col-md-4">
              <label class="form-label">Close-up or Another View</label>
              <?php if (!empty($row['image3'])): ?>
                <div class="mb-2">
                  <img src="image/<?= htmlspecialchars($row['image3']) ?>" alt="Close-up" class="img-thumbnail" style="max-height: 100px;">
                </div>
              <?php endif; ?>
              <input type="file" name="image3" class="form-control">
            </div>

          </div>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Update Product</button>
        </div>
      </div>
    </form>
  </div>
</div>

            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>



    <!-- Add Product Modal -->
    <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <form class="modal-content" action="product_admin.php" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title text-dark">Add New Product</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body row g-3">
            <div class="col-md-6">
              <label>Product Name</label>
              <input type="text" name="product_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Category</label>
              <input type="text" name="category" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Brand Name</label>
              <input type="text" name="brand_name" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Unit of Measure</label>
              <input type="text" name="unit_of_measure" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Weight</label>
              <input type="text" name="weight" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label>Material Type</label>
              <input type="text" name="material_type" class="form-control" required>
            </div>
            <div class="col-md-12">
              <label>Description</label>
              <textarea name="description" class="form-control" rows="2" required></textarea>
            </div>
            <div class="col-md-12">
              <label>Main Photo</label>
              <input type="file" name="image1" class="form-control mb-2" required>
              <label>Alternate angle</label>
              <input type="file" name="image2" class="form-control mb-2" >
              <label>Close-up or another view</label>
              <input type="file" name="image3" class="form-control" >
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-outline-success">Save Product</button>
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </div>
</body>
</html>

<style>
  
</style>