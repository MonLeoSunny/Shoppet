<?php
include 'header.php';

if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
    foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
        $permission = $row['phanquyen'];
    }

    if ($permission == 1 || $permission == 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Handle form submission to update a news article
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $content = $_POST['content'];

            // Check if a new image is uploaded
            $imagePath = $_POST['current_image']; // Use the existing image path by default
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = "uploads/"; // Set the directory where you want to store uploaded images
                $uploadedFile = $uploadDir . basename($_FILES['image']['name']);

                if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
                    $imagePath = $uploadedFile;
                } else {
                    echo "Failed to upload image.";
                }
            }

            // Include your database connection code here (e.g., connect.php)
            // Replace 'your_database_connection_code.php' with the actual file name and code
            include 'connect.php';

            // Update the news article in the database
            $query = "UPDATE tintuc SET ten='$title', mota='$description', noidung='$content', anh='$imagePath' WHERE id=$id";
            if (exSQL($query)) {
                echo "News article updated successfully!";
            } else {
                echo "Error updating news article.";
            }
        }

        // Fetch the news article details for editing
        if (isset($_GET['id'])) {
            $newsId = $_GET['id'];

            // Include your database connection code here (e.g., connect.php)
            // Replace 'your_database_connection_code.php' with the actual file name and code
            include 'connect.php';

            // Create a new PDO connection
            try {
                $conn = new PDO("mysql:host=localhost;dbname=your_database_name", "your_username", "your_password");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Prepare a SQL statement using a parameterized query
                $stmt = $conn->prepare("SELECT * FROM tintuc WHERE id=:id");
                $stmt->bindParam(':id', $newsId, PDO::PARAM_INT);

                // Execute the prepared statement
                $stmt->execute();

                // Fetch the news article data as an associative array
                $news = $stmt->fetch(PDO::FETCH_ASSOC);

                // Check if a news article was found
                if ($news) {
                    // You can access the news article data here
                    // For example, to display the title:
                    $newsTitle = $news['ten'];
                } else {
                    echo "News article not found.";
                    exit;
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
                exit;
            }
        } else {
            echo "Invalid request.";
            exit;
        }
?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title addfont">Chỉnh Sửa Tin Tức</h4>
                                <form method="post" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="<?= $news['id'] ?>">
                                    <input type="hidden" name="current_image" value="<?= $news['anh'] ?>">
                                    <div class="form-group">
                                        <label for="title">Tiêu Đề:</label>
                                        <input type="text" class="form-control" id="title" name="title" value="<?= $news['ten'] ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Mô Tả:</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" required><?= $news['mota'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="content">Nội Dung:</label>
                                        <textarea class="form-control" id="content" name="content" rows="5" required><?= $news['noidung'] ?></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Ảnh:</label>
                                        <input type="file" class="form-control-file" id="image" name="image">
                                    </div>
                                    <button type="submit" class="btn btn-success">Cập Nhật Tin Tức</button>
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