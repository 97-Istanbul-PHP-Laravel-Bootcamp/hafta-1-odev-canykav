<?php
include __DIR__ . '/../../../functions.php';
if(isset($_POST['delete']))  {
	deleteProduct($db,$id);
	header("Location: /admin/products");
}
?>
<?php
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
        <div class="content-body"><!-- Basic Tables start -->
<!-- Striped rows start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Ürünler</h4>
				<a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
				<div class="heading-elements">
					<ul class="list-inline mb-0">
						<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
						<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
					</ul>
				</div>
			</div>
			<div class="card-content collapse show">

				<div class="table-responsive">
					<table class="table table-striped">
						<thead>
							<tr>
								<th scope="col">ID</th>
								<th scope="col">Ürün Adı</th>
								<th scope="col">Kategori</th>
								<th scope="col">Stok Miktarı</th>
								<th scope="col">Fiyat</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody style="line-height:30px">
						<?php $products = getProducts($db); 
                          foreach($products as $product) {  ?>
							<tr>
								<td><?php echo $product['id']; ?></td>
								<td><?php echo $product['name']; ?></td>
								<td>--</td>
								<td><?php echo $product['stock']; ?></td>
								<td><?php echo $product['price']; ?></td>
								<td>                         
                                <button type="button" class="btn btn-secondary btn-sm"><i class="la la-edit"></i></button>
								<button type="submit" name="delete" form="delete-form-<?php echo $product['id']; ?>" class="btn btn-danger btn-sm"><i class="la la-trash"></i></button></td>
								<form id="delete-form-<?php echo $product['id']; ?>" style="display:none;" action="/admin/products/delete/<?php echo $product['id']; ?>" method="post">
						 		 </form>
							</tr>

							<?php } ?>

						</tbody>
					</table>
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