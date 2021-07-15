<?php
include __DIR__ . '/../../../functions.php';
include "admin/layout/header.php";

if(isset($_POST['product']) ) { 
        $str = '1234567890abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPUQRSTUVWXYZ';
        $special_id = substr(str_shuffle($str), 0, 5);

        if(isset($_POST['name'])){
            $name = $_POST['name'];
        } else {
            $name = null;
        }
        if(isset($_POST['description'])){
            $description = $_POST['description'];
        }else {
            $description = null;
        }
        if(isset($_POST['stock'])){
            $stock = $_POST['stock'];
        }else {
            $stock = null;
        }
        if(isset($_POST['recommend'])){
            $recommend = $_POST['recommend'];
        }else {
            $recommend = 0;
        }
        if(isset($_POST['price'])){
            $price = $_POST['price'];
        }else {
            $stock = null;
        }
        if(isset($_POST['weight'])){
            $weight = $_POST['weight'];
        }else {
            $weight = null;
        }
        if(isset($_POST['category'])){
            $category = $_POST['category'];
        }else {
            $category = null;
        }
   
                    // File name
                    $filename = $_FILES['image']['name'];
           
                    // Location
                    $target_file = 'upload/'.$filename;
                   
                    // file extension
                    $file_extension = pathinfo(
                        $target_file, PATHINFO_EXTENSION);
                          
                    $file_extension = strtolower($file_extension);
                   
                    // Valid image extension
                    $valid_extension = array("png","jpeg","jpg");
                   
                    if(in_array($file_extension, $valid_extension)) {
               
                        // Upload file
                        if(move_uploaded_file(
                            $_FILES['image']['tmp_name'],
                            $target_file)
                        ) {
                        }
                    }

    $query = $db->prepare("INSERT INTO products SET  special_id = ?, name= ?, description= ?, image= ?, price= ?, weight= ?, stock= ?, recommend=?"); 
    $res = $query->execute(array($special_id,$name,$description,$target_file,$price,$weight,$stock,$recommend));

    if(isset($_POST['category'])) {
            $categ_query = $db->prepare("INSERT INTO product_categories SET  product_id = ?, category_id= ?"); 
            $categ_query->execute(array($db->lastInsertId(),$_POST['category']));
    }
}
?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title mt-2">Ürünler</h3>
          </div>
        </div>
        <div class="content-body">

<div class="row match-height">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Yeni Ürün</h4>
            </div>
            <div class="card-block">
                <div class="card-body">
                <form action="/admin/products/new" method="post" enctype="multipart/form-data">
                    <h5 class="mt-2">Ürün Adı</h5>
                    <fieldset class="form-group">
                          <input type="text" class="form-control" name="name" id="basicInput" >
                    </fieldset>
                    <h5 class="mt-2">Açıklama</h5>
                      <fieldset class="form-group">
                          <textarea name="description" class="form-control" rows="3"></textarea>
                      </fieldset>
                    <h5 class="mt-2">Ürün Resmi</h5>
                    <fieldset class="form-group">
                                <input type="file" name="image">
                        </fieldset>
                    <h5 class="mt-2">Fiyat</h5>
                    <fieldset class="form-group">
                          <input type="number" min="1" step="any" class="form-control" name="price">
                    </fieldset>
                    <h5 class="mt-2">Ağırlık</h5>
                    <fieldset class="form-group">
                        <input type="number" min="1" step="any" class="form-control" name="weight">
                    </fieldset>
                    <h5 class="mt-2">Stok Adeti</h5>
                    <fieldset class="form-group">
                          <input type="number" step="any" class="form-control" name="stock">
                    </fieldset>
                    <h5 class="mt-2">Kategori</h5>
                      <fieldset class="form-group">
                          <select class="form-control" name="category">
                          <?php $categories = getCategories($db); 
                          foreach($categories as $category) {  ?>
                              <option value="<?php echo $category['id']; ?>"><?php echo $category['name']; ?></option>
                           <?php } ?>
                          </select>
                      </fieldset>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="recommend" value="1">
                        <label class="form-check-label" for="defaultCheck1">
                            Öne Çıkar
                        </label>
                    </div>
                    <div class="form-group">
                            <button type="submit" name="product" class="btn mb-1 btn-secondary btn-block mt-2">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
      </div>
    </div>
<?php
include "admin/layout/footer.php";
?>