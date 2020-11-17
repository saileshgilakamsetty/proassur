
<!-- SLIDER -->
<?php 
  //print_r($dataCollection);
  extract($dataCollection);
?>
  <section class="slidBanner">
    <div class="flexslider">
      <ul class="slides">
        <?php
        if(!empty(getWebsiteImageList($id))){
        //print_r(getWebsiteImageList($id));
        foreach (getWebsiteImageList($id) as $imgUrl) { ?>     
        <li>
          <img src="<?=$imgUrl?>" /> 
          <div class="sliderOverCont">
            <div class="container">
              <div class="row">
                <div class="col-xs-9">
                  <p class="subDate"><strong>Submission For this Month</strong>  <?=date("j M Y", strtotime($datetime))?></p>
                  <a href="#"><strong>Rank #1</strong></a>
                </div>
                <div class="col-xs-3">
                  <a class="slidHeart" href="javascript:AddToWishlist(<?=$id?>)"><i class="fas fa-heart"></i></a>
                </div>
                <div class="col-xs-12">
                    <div class="slidText">
                        <h2><?=$name?></h2>
                        <!-- <p>by <span><?=getUserName($user_id)?></span> from <?=$country?></p> -->
                        <p>by <span><?=getUserName($user_id)?></span> </p>
                    </div>
                </div>
                <div class="col-xs-12">
                    <div class="slidrBtns">
                        <a target="_blank" href="<?=$website_url?>">Visit Site</a>
                        <a href="javascript:VoteWebsite(<?=$id?>)">vote now</a>
                        <a href="javascript:void(0)"><?=getCategoryName($category)?></a> 
                    </div>
                </div>
              </div>
            </div>
          </div>
        </li> 
      <?php } }?>
      </ul>
    </div>
  </section>
<!-- SLIDER -->

<section class="detail_main">
<div class="container">
<div class="row">
<div class="col-sm-7 col-md-8">
<!-- <div class="WebsiteTitle">
<h2><?=$name?></h2>
</div> -->
<div class="discription">
<?=$description?>
</div>
<div class="comment">
<h2><?=getStaticContent('COMMENT')?></h2>
<ul>
<?php if(!empty($post_comment_list)) {
  foreach ($post_comment_list as $commentData) { ?>
<li>
<figure>

<?=getUserImage($commentData->user_id)?>

</figure>
<h4><?=getUserName($commentData->user_id)?></h4>
<p><?=$commentData->post_comment?></p>
</li> 

<?php } } ?>

</ul>
<div class="comment_box">
<form method="post" id="myPostComment">
<div id="postMsg"></div>
<input type="hidden" name="website_id" value="<?=$id?>">
<textarea name="post_comment" id="post_comment" cols="" rows="" placeholder="<?=getStaticContent('COMMENT')?>"></textarea>
<button type="submit">Submit</button>
</form>
</div>

</div>
</div>
<div class="col-sm-5 col-md-4">
<div class="webBox_2 top_rated">
<h2><?=getStaticContent('TOP_RATED')?></h2>
<?php if(!empty($topData)){
  foreach ($topData as $topMost) { ?>
  <figure>
    <div class="overLayer"> 
    <a class="wishList" href="javascript:AddToWishlist(<?=$topMost->id?>)"><i class="fas fa-heart"></i></a> 
    <a class="votNow" href="javascript:VoteWebsite(<?=$topMost->id?>)"><?=getStaticContent('VOTE_NOW')?></a> </div>
    <?=getWebsiteImage($topMost->id)?> 
    </figure>
   <div class="boxCont_2">
                <div class="col-12">
                  <h3><a href="<?=base_url('website/'.$topMost->slug)?>" title="<?=$topMost->name?>"><?php $title=$topMost->name; $str=substr($title, 0,38); $len=strlen($title); if($len>38){ $str.='...';} echo $str; ?> </a></h3>
                </div>
                <div class="col-6">
                  <p class="webRank_2"><a href="#"><?=getStaticContent('TOTAL_VOTE')?> : <?=getVote($topMost->id)?></a></p>
                  <!-- <p><?=$topMost->country?></p> -->
                </div>
                <div class="col-6">
                  <ul class="postTimer">
                    <li> <span><?=getStaticContent('POSTED')?></span>
                      <p><?=time_elapsed($topMost->datetime)?></p>
                    </li>
                  </ul>
                </div>
                
              </div>
  <?php } } ?>
</div>

        <div class="latestAdd detail_latestList">
          <h2><?=getStaticContent('LATEST_ADDED')?></h2>
          <ul>
           <?php 
            if(!empty($latestWebsiteList)){
              foreach ($latestWebsiteList as $latest) { ?>
               <li> <a href="<?=base_url('website/'.$latest->slug)?>" title="<?=$latest->name?>">
              <figure> <?=getWebsiteImage($latest->id)?></figure>
              <?php $title=$latest->name; $str=substr($title, 0,40); $len=strlen($title); if($len>40){ $str.='...';} echo $str; ?> <br>
               </a> </li>
              <!-- From <?=$latest->country?> </a> </li> -->
          <?php } }  ?>
          </ul>
        </div>
</div>
</div>
</div>
</section>

<section class="ourWinners">
  <div class="container">
      <div class="row">
          <div class="col-xs-12">
              <h3>Sites of the month  <span>Previous Winners</span></h3>
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
