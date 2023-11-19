<?php
include 'header.php';
// include '../connect.php';
if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
    foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
        $permission = $row['phanquyen'];
    }

    if ($permission == 1 || $permission == 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission to add a new news article
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content = $_POST['content'];

            // Upload and handle image if needed
            $imagePath = ""; // Set the default image path
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = "uploads/"; // Set the directory where you want to store uploaded images
                $uploadedFile = $uploadDir . basename($_FILES['image']['name']);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
                    $imagePath = $uploadedFile;
                } else {
                    echo "Failed to upload image.";
                }
            }

            // Insert the new news article into the database
            $query = "INSERT INTO tintuc (ten, mota, noidung, anh) VALUES ('$title', '$description', '$content', '$imagePath')";
            if (exSQL($query)) {
                header('location:news.php');
            } else {
                header('location:news.php');
            }
        }
?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title addfont">Thêm Tin Tức</h4>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="title">Tiêu Đề:</label>
                                        <input type="text" class="form-control" id="title" name="title" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô Tả:</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội Dung:</label>
                                        <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Ảnh:</label>
                                        <input type="file" class="form-control-file" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-success">Thêm Tin Tức</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php
    }
}

include 'footer.php';
?>