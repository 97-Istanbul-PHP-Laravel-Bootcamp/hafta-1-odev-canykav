<?php
include __DIR__ . '/../../../functions.php';

if(isset($_POST['category']) ) { 
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
 
    $query = $db->prepare("INSERT INTO categories SET  name= ?, description= ?"); 
    $res = $query->execute(array($name,$description));
    header("Location: /admin/categories");
}

include "admin/layout/header.php";

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
                <h4 class="card-title">Yeni Kategori</h4>
            </div>
            <div class="card-block">
                <div class="card-body">
                <form action="/admin/categories/new" method="post" enctype="multipart/form-data">
                    <h5 class="mt-2">Kategori Adı</h5>
                    <fieldset class="form-group">
                          <input type="text" class="form-control" name="name">
                    </fieldset>
                    <h5 class="mt-2">Açıklama</h5>
                      <fieldset class="form-group">
                          <textarea name="description" class="form-control" rows="3"></textarea>
                      </fieldset>

                    <div class="form-group">
                            <button type="submit" name="category" class="btn mb-1 btn-secondary btn-block mt-2">Kaydet</button>
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