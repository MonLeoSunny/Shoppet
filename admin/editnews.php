<?php
include 'header.php'; // Include the header section
// Include your database connection code here

// Check if the user is logged in and has the required permissions
if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
    foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
        $permission = $row['phanquyen'];
    }

    if ($permission == 1 || $permission == 0) {
        // Check if the 'id' parameter is provided in the URL
        if (isset($_GET['id'])) {
            $articleId = $_GET['id'];

            // Retrieve the existing news article data from the database based on its ID
            $query = "SELECT * FROM tintuc WHERE id = $articleId";
            foreach (selectAll($query) as $item) {
                $article = $item;
            };

            // Check if the article exists
            if ($article) {
                // Handle form submission to update the news article
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    // Retrieve and validate the updated article data
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

                    // Update the article data in the database
                    $updateQuery = "UPDATE tintuc SET ten='$title', mota='$description', noidung='$content', anh='$imagePath' WHERE id = $articleId";

                    if (exSQL($updateQuery)) {
                        // Redirect to the news list page after successful update
                        header('location:news.php');
                    } else {
                        // Handle update error, display a message, or take appropriate action
                        echo "Error updating the news article.";
                    }
                }
?>
                <!-- HTML form to edit the news article -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-12 grid-margin">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title addfont">Chỉnh Sửa Tin Tức</h4>
                                        <form method="post" action="" enctype="multipart/form-data">
                                            <div class="form-group">
                                                <label for="title">Tiêu Đề:</label>
                                                <input type="text" class="form-control" id="title" name="title" value="<?= $article['ten'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Mô Tả:</label>
                                                <textarea class="form-control" id="description" name="description" rows="3" required><?= $article['mota'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="content">Nội Dung:</label>
                                                <textarea class="form-control" id="content" name="content" rows="5" required><?= $article['noidung'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="image">Ảnh:</label>
                                                <input type="file" class="form-control-file" id="image" name="image">
                                            </div>
                                            <button type="submit" class="btn btn-success">Lưu Tin Tức</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php
            } else {
                echo "Article not found."; // Handle the case where the article with the given ID doesn't exist
            }
        } else {
            echo "Missing article ID."; // Handle the case where the 'id' parameter is not provided in the URL
        }
    } else {
        echo "Permission denied."; // Handle the case where the user doesn't have the required permissions
    }
}
include 'footer.php'; // Include the footer section
?>