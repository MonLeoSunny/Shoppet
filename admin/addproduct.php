<?php
include 'header.php';
// include '../connect.php';
if (isset($_COOKIE["user"])) {
  $user = $_COOKIE["user"];
  foreach (selectAll("SELECT * FROM taikhoan WHERE taikhoan='$user'") as $row) {
    $permission = $row['phanquyen'];
  }
  if ($permission == 1 || $permission == 0) {
    if (isset($_POST['them'])) {
      $ten = $_POST["ten"];
      $id_danhmuc = $_POST["danhmuc"];
      $nhasanxuat = $_POST["nhacungcap"];
      $loaimoi = $_POST["loaimoi"];
      $nguyenlieu = $_POST["nguyenlieu"];
      $thuonghieu = $_POST["thuonghieu"];
      $baohanh = $_POST["baohanh"];
      $xuatxu = $_POST["xuatxu"];
      $bonho = $_POST["bonho"];
      $gia = $_POST["gia"];
      $anh1 = $_FILES['anh1']['name'];
      $tmp1 = $_FILES['anh1']['tmp_name'];
      $type1 = $_FILES['anh1']['type'];
      $anh2 = $_FILES['anh2']['name'];
      $tmp2 = $_FILES['anh2']['tmp_name'];
      $type2 = $_FILES['anh2']['type'];
      $anh3 = $_FILES['anh3']['name'];
      $tmp3 = $_FILES['anh3']['tmp_name'];
      $type3 = $_FILES['anh3']['type'];
      $chitiet = $_POST["chitiet"];
      $mota = $_POST["mota"];
      $dir = '../img/product/';
      move_uploaded_file($tmp1, $dir . $anh1);
      move_uploaded_file($tmp2, $dir . $anh2);
      move_uploaded_file($tmp3, $dir . $anh3);

      selectAll("INSERT INTO sanpham VALUES(NULL,$id_danhmuc,'$ten','$nhacungcap','$loaimoi','$nguyenlieu','$thuonghieu',$baohanh,$xuatxu,'$bonho',$gia,'$anh1','$anh2','$anh3','$chitiet','$mota',0,1)");
      header('location:product.php');
    }
?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row ">
          <div class="col-12 grid-margin">
            <div class="card">
              <div class="card-body">
                <h4 class="card-title">Thêm Sản Phẩm</h4>
                <form class="forms-sample" action="" method="post" enctype="multipart/form-data">

                  <div class="form-group">
                    <label for="exampleInputName1">Tên Sản Phẩm</label>
                    <input type="text" name="ten" required class="form-control text-light" placeholder="Nhập tên sản phẩm">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Giá</label>
                    <input type="number" name="gia" required class="form-control text-light" placeholder="Nhập giá bán">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail3">Danh mục</label>
                    <select required name="danhmuc" id="input" class="form-control text-light">
                      <?php
                      foreach (selectAll("SELECT * FROM danhmuc ") as $item) {
                      ?>
                        <option value="<?= $item['id_dm'] ?>"><?= $item['danhmuc'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail3">Nhà cung cấp</label>
                    <select required name="nhacungcap" id="input" class="form-control text-light">
                      <?php
                      foreach (selectAll("SELECT * FROM nhacungcap ") as $item) {
                      ?>
                        <option value="<?= $item['id'] ?>"><?= $item['ten'] ?></option>
                      <?php
                      }
                      ?>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Loại Mới / Cũ</label>
                    <input type="text" name="loaimoi" required class="form-control text-light" placeholder="Nhập ...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Nguyên liệu</label>
                    <input type="text" name="nguyenlieu" required class="form-control text-light" placeholder="Nhập ...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Thương hiệu</label>
                    <input type="text" name="thuonghieu" required class="form-control text-light" placeholder="Nhập ...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Bảo hành</label>
                    <input type="text" name="baohanh" required class="form-control text-light" placeholder="Nhập ...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Xuất xứ</label>
                    <input type="text" name="xuatxu" required class="form-control text-light" placeholder="Nhập ...">
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName1">Thông tin khác</label>
                    <input type="text" name="bonho" required class="form-control text-light" placeholder="Nhập ...">
                  </div>



                  <div class="form-group">
                    <label>Ảnh Sản Phẩm</label>
                    <input type="file" name="anh1" class="form-control">
                    <input type="file" name="anh2" class="form-control">
                    <input type="file" name="anh3" class="form-control">
                  </div>

                  <div class="form-group">
                    <label for="exampleTextarea1">Mô Tả Ngắn</label>
                    <textarea type="text" name="mota" required class="form-control text-light" rows="3" style="line-height: 2" placeholder="Nhập mô tả ngắn gọn"></textarea>
                  </div>

                  <div class="form-group">
                    <label for="exampleTextarea1">Chi Tiết</label>
                    <textarea type="text" name="chitiet" required class="form-control text-light" style="line-height: 2" rows="6" placeholder="Nhập chi tiết"></textarea>
                  </div>

                  <button type="submit" name="them" class="btn btn-primary mr-2">Thêm sản phẩm</button>
                  <a class="btn btn-dark" href="product.php">Hủy</a>
                </form>
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