<?php 
include '../database.php'; 

$product_id = $_POST['product_id'];

$product_name     = $_POST['product_name'];
$category         = $_POST['category'];
$brand_name       = $_POST['brand_name'];
$unit             = $_POST['unit'];
$weight           = $_POST['weight'];
$material         = $_POST['material'];
$description      = $_POST['description'];

$query = "SELECT image, image2, image3 FROM products WHERE product_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$stmt->bind_result($old_image, $old_image2, $old_image3);
$stmt->fetch();
$stmt->close();

function handleImageUpload($field_name, $old_filename) {
    $upload_folder = 'image/'; 
    
    if (isset($_FILES[$field_name]) && $_FILES[$field_name]['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES[$field_name]['name']);
        $target_path = $upload_folder . $filename;

        if (move_uploaded_file($_FILES[$field_name]['tmp_name'], $target_path)) {
            return $filename; 
        }
    }
    return $old_filename; 
}

$image  = handleImageUpload('image', $old_image);
$image2 = handleImageUpload('image2', $old_image2);
$image3 = handleImageUpload('image3', $old_image3);

$update = "UPDATE products SET 
  product_name = ?, 
  category = ?, 
  brand_name = ?, 
  unit_of_measure = ?, 
  weight = ?, 
  material_type = ?, 
  description = ?, 
  image = ?, 
  image2 = ?, 
  image3 = ? 
WHERE product_id = ?";

$stmt = $conn->prepare($update);
$stmt->bind_param("ssssssssssi", 
  $product_name, $category, $brand_name, $unit, $weight, 
  $material, $description, $image, $image2, $image3, $product_id
);

if ($stmt->execute()) {
    echo "<script>alert('Product updated successfully!'); window.location.href='product_admin.php';</script>";
} else {
    echo "<script>alert('Failed to update product.'); history.back();</script>";
}

$stmt->close();
$conn->close();
?>
