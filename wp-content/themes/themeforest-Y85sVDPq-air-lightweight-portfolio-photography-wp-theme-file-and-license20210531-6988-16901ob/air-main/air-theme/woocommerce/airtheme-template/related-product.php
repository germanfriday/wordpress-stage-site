<section class="main-list-item product-item related-product" >
    <div class="inside">
    
        <?php //** Do Woocommerce before shop loop item
		//do_action('woocommerce_before_shop_loop_item'); ?>
        
        <a href="<?php the_permalink(); ?>">
        
            <?php //** Do Woocommerce before shop loop item title
			do_action('woocommerce_before_shop_loop_item_title'); ?>

        </a>    
        
            <div class="product-caption">
                
                <div class="product-caption-inn middle-ux">
                <a href="<?php the_permalink(); ?>" class="prouduct-item-a"><h3 class="product-caption-title"><?php the_title(); ?></h3></a>
                <?php //** Do Woocommerce after shop loop item title
				do_action('woocommerce_after_shop_loop_item_title'); ?>

                <?php //** Do Woocommerce after shop loop item
                do_action('woocommerce_after_shop_loop_item'); ?>
                </div>

            </div><!--End product-caption-->
        
    </div><!--End inside-->	
</section>