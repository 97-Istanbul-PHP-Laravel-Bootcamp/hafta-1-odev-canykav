<?php
include 'layout/header.php';
include 'layout/slider.php';
?>

	<section>
		<div class="container">
			<div class="row">
			<?php include 'layout/sidebar.php'; ?>	
				<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Öne Çıkanlar</h2>
						<?php $products = $db->query("SELECT * FROM products WHERE recommend=1");
						
						foreach($products as $product) {  ?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="<?php echo $product['image']; ?>" alt="" />
											<h2><?php echo $product['price']; ?> TL</h2>
											<p><?php echo $product['name']; ?></p>
											<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete Ekle</a>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2><?php echo $product['price']; ?> TL</h2>
												<p><a style="color:white;"href="/products/<?php echo $product['special_id']; ?>"><?php echo $product['name']; ?></p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete Ekle</a>
											</div>
										</div>
								</div>
							</div>
						</div>
						<?php } ?>
					
						
					</div><!--features_items-->
					
					<div class="category-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li class="active"><a href="#masaustu" data-toggle="tab">MASAÜSTÜ BİLGİSAYARLAR</a></li>
								<li><a href="#dizustu" data-toggle="tab">DİZÜSTÜ BİLGİSAYARLAR</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="masaustu" >
							<?php $mb_products = $db->query("SELECT products.*,categories.*, products.name as name FROM products LEFT JOIN product_categories ON (products.id=product_categories.product_id)  LEFT JOIN categories ON (product_categories.category_id=categories.id) WHERE categories.id = 2")->fetchAll(PDO::FETCH_ASSOC); 
							
							foreach($mb_products as $product) { ?> 
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
											<a href="/products/<?php echo $product['special_id']; ?>"> <img src="/<?php echo $product['image'] ?>" alt="" /></a>
												<h2><?php echo $product['price'] ?> TL</h2>
												<p><?php echo $product['name'] ?></p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete Ekle</a>
											</div>
											
										</div>
									</div>
								</div>
								<?php } ?>
								
							</div>
							
							<div class="tab-pane fade" id="dizustu" >

							<?php $du_products = $db->query("SELECT products.*,categories.*, products.name as name FROM products LEFT JOIN product_categories ON (products.id=product_categories.product_id)  LEFT JOIN categories ON (product_categories.category_id=categories.id) WHERE categories.id = 1")->fetchAll(PDO::FETCH_ASSOC); 
							
							foreach($du_products as $product) { ?> 
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
											<div class="productinfo text-center">
											<a href="/products/<?php echo $product['special_id']; ?>"> <img src="/<?php echo $product['image'] ?>" alt="" /></a>
												<h2><?php echo $product['price'] ?> TL</h2>
												<p><?php echo $product['name'] ?></p>
												<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Sepete Ekle</a>
											</div>
											
										</div>
									</div>
								</div>
								<?php } ?>
							</div>
							
							
							
					</div><!--/category-tab-->
										
				</div>
			</div>
		</div>
	</section>
	
<?php
include 'layout/footer.php';
?>