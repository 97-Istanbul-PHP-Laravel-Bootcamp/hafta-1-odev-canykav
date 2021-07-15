<?php
include 'layout/header.php';

$stmt = $db->prepare("SELECT * FROM products WHERE special_id=:id");
$stmt->execute(['id' => $id]); 
$product = $stmt->fetch();

?>


<section>
		<div class="container">
			<div class="row">
			<?php include 'layout/sidebar.php'; ?>
			
				<div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<img src="/<?php echo $product['image']; ?>" alt="" />
							</div>


						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
								<h2><?php echo $product['name']; ?></h2>
								<img src="/images/product-details/rating.png" alt="" />
								<span>
									<span><?php echo $product['price']; ?> TL</span>
									<label>Adet:</label>
									<input type="number" value="1" max="<?php echo $product['stock']; ?>"/>
									<button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Sepete Ekle
									</button>
								</span>
								<p><b>Stok:</b> <?php echo $product['stock']; ?></p>
								<p><b>Marka:</b> E-SHOPPER</p>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">ÜRÜN AÇIKLAMASI</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade active in" id="details" >
							<?php echo $product['description']; ?>
							</div>
							
							
						</div>
					</div><!--/category-tab-->
					
				
				</div>
			</div>
		</div>
	</section>
    <?php
include 'layout/footer.php';
?>