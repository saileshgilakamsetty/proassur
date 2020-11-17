

<section class="ourWinners">
	<div class="container">
    	<div class="row">
        	<div class="col-xs-12">
            	<h2 class="title"><?=getStaticContent('OUR_WINNERS')?></h2>
            </div>
        <?php if(!empty($ourWinners)){ 
            // print_r($ourWinners);
          foreach ($ourWinners as $WinnersItem) { ?>
            <div class="col-sm-6 col-md-4">
            	<div class="winBox">
                	<figure>
                        <a class="winLike" href="javascript:AddToWishlist(<?=$WinnersItem['id']?>)"><i class="fas fa-heart"></i></a>
                        <a href="<?=base_url('website/'.$WinnersItem['slug'])?>" ><?=getWebsiteImage($WinnersItem['id'])?></a>
                    	
                    </figure>
                    <div class="boxCont">
                    	<h3><a href="#"><a href="<?=base_url('website/'.$WinnersItem['slug'])?>" title="<?=$WinnersItem['name']?>"><?php $title=$WinnersItem['name']; $str=substr($title, 0,38); $len=strlen($title); if($len>38){ $str.='...';} echo $str; ?> </a></a></h3>
                    	<div class="col-6">
                        	<!-- <p>From <?=$WinnersItem['country']?></p> -->
                        </div>
                        <div class="col-6">
                        	<ul class="soMonth">
                            	<li><?=getCategoryName($WinnersItem['category'])?></li>
                                <li><?=date("F", strtotime($WinnersItem['datetime']))?></li>
                            </ul>
                        </div>
                        <div class="byMade"><span><?php $str=getUserName($WinnersItem['user_id']); echo substr($str,0,1);?></span> BY <strong><?=getUserName($WinnersItem['user_id'])?></strong></div>
                    </div>
                </div>
            </div>
            <?php } } ?>
            
           
            
            
            
        </div>
    </div>
</section>





