<section class="detail_main">
<div class="container">
<div class="row">
<?php if(!empty($pageData)) { ?> 
<?php extract($pageData); ?>
<?php if(!empty($featured_img)) { ?>
<div class="col-xs-12">
<div class="pageTitle"><h3><?=$name?></h3> <figure class="proLogo"><img src="<?=base_url($featured_img)?>" class="img-responsive img-thumbnail"></figure></div>
<div class="pageDiscription">
<?=$description?>
</div>
</div>
<!-- <div class="col-sm-12 col-md-4"><figure class="spaceTop"><img src="<?=base_url($featured_img)?>" class="img-responsive img-thumbnail"></figure></div> -->
<?php } else { ?>
<div class="col-sm-12 col-md-12">
<div class="pageTitle"><h3><?=$name?></h3></div>
<div class="pageDiscription">
<?=$description?>
</div>
</div>
<?php } ?>
<?php } else { ?>
<div class="pageNotFound"><h3><?=getStaticContent('PAGE_NOT_FOUND')?></h3></div>
<?php } ?>

</div>
</div>
</section>


