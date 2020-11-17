<section class="submitMonths">
	<div class="container">
    	<div class="row">

        <?php if(!empty($wishlistData)){ 
            //print_r($wishlistData);
        foreach ($wishlistData as $dataItem) { ?>
         
          <div class="col-sm-4 col-md-3">
            <div class="webBox">
              <figure>
                <div class="overLayer">  <a title="remove from wishList" class="wishList" href="javascript:removeToWishlist(<?=$dataItem->id?>)"><i class="fas fa-trash"></i></a>  
                <a class="votNow" href="javascript:VoteWebsite(<?=$dataItem->id?>)"><?=getStaticContent('VOTE_NOW')?></a> 
                </div>
                <?=getWebsiteImage($dataItem->id)?>
                
              </figure>
              <div class="boxCont">
                <div class="col-12">
                  <h3><a href="<?=base_url('website/'.$dataItem->slug)?>" title="<?=$dataItem->name?>"><?php $title=$dataItem->name; $str=substr($title, 0,25); $len=strlen($title); if($len>25){ $str.='...';} echo $str; ?> </a></h3>
                </div>
                <div class="col-6">
                  <p class="webRank"><a href="#"><?=getStaticContent('TOTAL_VOTE')?> : <?=getVote($dataItem->id)?></a></p>
                  <!-- <p><?=$dataItem->country?></p> -->
                </div>
                <div class="col-6">
                  <ul class="postTimer">
                    <li> <span>Posted</span>
                      <p><?=time_elapsed($dataItem->datetime)?></p>
                    </li>
                    
                  </ul>
                </div>
                
              </div>
            </div>
          </div>
          <?php } } else { ?>
          <div class="text-center" style="min-height: 300px;"><h4>Result Not Found !!</h4></div>
          <?php  } ?>
        	
            
          
            
            
            
            
        </div>
    </div>
</section>