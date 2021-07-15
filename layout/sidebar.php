<div class="col-sm-3">
            <div class="left-sidebar">
                <h2>Kategoriler</h2>
                <div class="panel-group category-products" id="accordian"><!--category-productsr-->
                    <?php $categories = $db->query("SELECT * FROM categories");
                    
                    foreach($categories as $category) {  ?>
                        <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a href="/categories/<?php echo $category['id'];?>"><?php echo $category['name']; ?></a></h4>
                        </div>
                    </div>
                    <?php } ?>
                 
                </div><!--/category-productsr-->
                            
                <div class="shipping text-center"><!--shipping-->
                    <img src="/images/home/shipping.jpg" alt="" />
                </div><!--/shipping-->
                
            </div>
        </div>