<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $brand_name = mysqli_real_escape_string($conn, $_POST['brand_name']);
    $unit_of_measure = mysqli_real_escape_string($conn, $_POST['unit_of_measure']);
    $weight = mysqli_real_escape_string($conn, $_POST['weight']);
    $material_type = mysqli_real_escape_string($conn, $_POST['material_type']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image_name = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_size = $_FILES['image']['size'];
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        $allowed_extensions = ['jpg', 'jpeg', 'png'];
        if (in_array($image_ext, $allowed_extensions)) {
            $new_image_name = uniqid('product_', true) . '.' . $image_ext;
            
            $upload_dir = 'uploads/';
            
            if (move_uploaded_file($image_tmp_name, $upload_dir . $new_image_name)) {
                $sql = "INSERT INTO products (product_name, category, brand_name, description, unit_of_measure, weight, material_type, image) 
                        VALUES ('$product_name', '$category', '$brand_name', '$description', '$unit_of_measure', '$weight', '$material_type', '$new_image_name')";

                if (mysqli_query($conn, $sql)) {
                    echo "<script>alert('Product added successfully!'); window.location.href='product_list.php';</script>";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                }
            } else {
                echo "Error uploading the image.";
            }
        } else {
            echo "Invalid file type. Only JPG, JPEG, and PNG are allowed.";
        }
    } else {
        echo "Error: No image uploaded.";
    }
}

mysqli_close($conn); 
?>
