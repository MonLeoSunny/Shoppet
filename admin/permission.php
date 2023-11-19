<?php
include 'header.php';
if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
    foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
        $permission = $row['phanquyen'];
    }

    if ($permission == 1 || $permission == 0) {
?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-12 grid-margin">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title addfont">Quản lí quyền</h4>
                                <div class="mb-3">
                                    <a type="button" class="btn btn-success btn-fw" href="addpermission.php">Thêm quyền</a>
                                    <a type="button" class="btn btn-success btn-fw" href="userpermission.php">Danh sách phân quyền</a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="addfont" style="width: 20px">ID</th>
                                                <th class="addfont" style="width: 400px">Tên</th>
                                                <th class="addfont">Ngày khởi tạo</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stt = 1;
                                            $item_per_page = !empty($_GET['per_page']) ? $_GET['per_page'] : 8;
                                            $current_page = !empty($_GET['page']) ? $_GET['page'] : 1;

                                            $baseQuery = "SELECT * FROM quyen";
                                            $numrow = rowCount($baseQuery);
                                            $totalpage = ceil($numrow / $item_per_page);
                                            $offset = ($current_page - 1) * $item_per_page;
                                            foreach (selectAll("$baseQuery LIMIT $item_per_page OFFSET $offset") as $row) {
                                            ?>
                                                <tr class="addfont">
                                                    <td><?= $row['id'] ?></td>
                                                    <td><?= $row['ten'] ?></td>
                                                    <td><?= $row['created_at'] ?></td>
                                                </tr>
                                            <?php
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <div class="col-lg-12">
                                        <div class="pageination">
                                            <nav aria-label="Page navigation example">
                                                <ul class="pagination justify-content-center">
                                                    <?php for ($num = 1; $num <= $totalpage; $num++) { ?>
                                                        <?php
                                                        if ($num != $current_page) {
                                                        ?>
                                                            <?php if ($num > $current_page - 3 && $num < $current_page + 3) { ?>
                                                                <li class="page-item"><a class="btn btn-outline-secondary" href="?per_page=<?= $item_per_page ?>&page=<?= $num ?>"><?= $num ?></a>
                                                                </li>
                                                            <?php } ?>
                                                        <?php
                                                        } else {
                                                        ?>
                                                            <strong class="page-item"><a class="btn btn-outline-secondary"><?= $num ?></a>
                                                            </strong>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                            </nav>
                                        </div>
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