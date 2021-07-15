<?php
include __DIR__ . '/../../../functions.php';
include "admin/layout/header.php";
?>
<?php
if(isset($_POST['delete']))  {
	deleteCategory($db,$id);
}
?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-wrapper-before"></div>
        <div class="content-header row">
          <div class="content-header-left col-md-4 col-12 mb-2">
            <h3 class="content-header-title mt-2">Kategoriler</h3>
          </div>
        </div>
        <div class="content-body"><!-- Basic Tables start -->
<!-- Striped rows start -->
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Kategoriler</h4>
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
								<th scope="col">Kategori Adı</th>
								<th scope="col">Açıklama</th>
								<th scope="col"></th>
							</tr>
						</thead>
						<tbody style="line-height:30px">
						<?php $categories = getCategories($db); 
                          foreach($categories as $category) {  ?>
							<tr>
								<th scope="row"><?php echo $category['id']; ?></th>
								<td><?php echo $category['name']; ?></td>
								<td><?php echo $category['description']; ?></td>
								<td>                         
                                <button type="button" class="btn btn-secondary btn-sm"><i class="la la-edit"></i></button>
								<button type="submit" name="delete" form="delete-form-<?php echo $category['id']; ?>" class="btn btn-danger btn-sm"><i class="la la-trash"></i></button>
								<form id="delete-form-<?php echo $category['id']; ?>" style="display:none;" action="/admin/categories/delete/<?php echo $category['id']; ?>" method="post">
						 		 </form>
							</td>
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