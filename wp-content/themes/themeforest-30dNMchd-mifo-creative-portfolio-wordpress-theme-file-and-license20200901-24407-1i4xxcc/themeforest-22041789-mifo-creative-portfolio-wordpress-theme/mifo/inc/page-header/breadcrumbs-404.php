<?php
    global $rs_option;   
?>
<div class="rs-breadcrumbs  porfolio-details">
    <div class="rs-breadcrumbs-inner">  
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="breadcrumbs-inner">
                        <h1 class="page-title"><?php
                        if(!empty($rs_option['title_404'])){
                            echo esc_html($rs_option['title_404']);
                        }
                        else{
                            esc_html_e( '404.', 'mifo' ); }
                        ?></h1>

                        <?php if(function_exists('bcn_display')) {
                                bcn_display();
                            }
                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
</div>