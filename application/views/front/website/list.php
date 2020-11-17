<div class="main_bmenu">
  <div class="container">
    <ol class="breadcrumb">
      <li><a href="<?=base_url()?>"><?=getStaticContent('HOME')?></a></li>
      <li class="active"><?=getStaticContent('SITE_OF_THE_MONTH')?></li>
    </ol>
  </div>
</div>
<div class="mainFilter">
  <form method="get" id="websitelist">
  <div class="container">
    <div class="row">
      <div class="col-sm-4 col-md-3">
       <input type="button" id="catBtn" value="Filters" class="hidden-sm hidden-md hidden-lg"/>
        <div id="categoRies">
        <div class="categories">
          <h2><?=getStaticContent('CATEGORIES')?></h2>
          <ul>
          <?php 
            $category=$this->input->get('category');
            if(empty($category)) {
              $category=array();
            }
            if(!empty($categorylist)){
              foreach ($categorylist as $catData) { ?>
               <li>
                <label>
                  <input type="checkbox" onchange="javascript:website_sortlisting(this.value);" name="category[]" id="category" value="<?=$catData->id?>" <?php if(in_array($catData->id, $category)) { echo 'checked'; } ?>> 
                  <?=$catData->name?>
                </label>
              </li>
          <?php } }  ?>
          </ul>
        </div>
<!--         <div class="categories">
          <h2><?=getStaticContent('COLORS')?></h2>
          <ul>
           <?php 
            $color=$this->input->get('color');
            if(empty($color)) {
              $color=array();
            }
            if(!empty($colorlist)){
              foreach ($colorlist as $colorData) { ?>
               <li>
                <label>
                  <input type="checkbox" onchange="javascript:website_sortlisting(this.value);" name="color[]" id="color" value="<?=$colorData->id?>" <?php if(in_array($colorData->id, $color)) { echo 'checked'; } ?>> 
                  <?=$colorData->name?>
                </label>
              </li>
          <?php } }  ?>
            
          </ul>
        </div> -->
<!--         <div class="categories">
          <h2><?=getStaticContent('COUNTRY')?></h2>
          <ul>
           <?php 
            $country=$this->input->get('country');
            if(empty($country)) {
              $country=array();
            }
            
            if(!empty($countrylist)){
              foreach ($countrylist as $countryName) { ?>
               <li>
                <label>
                  <input type="checkbox" onchange="javascript:website_sortlisting(this.value);" name="country[]" id="country" value="<?=$countryName?>" <?php if(in_array($countryName, $country)) { echo 'checked'; } ?>> 
                  <?=$countryName?>
                </label>
              </li>
          <?php } }  ?>
            
          </ul>
        </div> -->
        <div class="latestAdd">
          <h2><?=getStaticContent('LATEST_ADDED')?></h2>
          <ul>
           <?php 
            if(!empty($latestWebsiteList)){
              foreach ($latestWebsiteList as $latest) { ?>
               <li> <a href="<?=base_url('website/'.$latest->slug)?>" title="<?=$latest->name?>">
              <figure> <?=getWebsiteImage($latest->id)?></figure>
              <?php $title=$latest->name; $str=substr($title, 0,23); $len=strlen($title); if($len>23){ $str.='...';} echo $str; ?> <br>
              <!-- From <?=$latest->country?> </a> </li> -->
               </a> </li>
          <?php } }  ?>
            
            
          </ul>
        </div>
        </div>
      </div>
      <div class="col-sm-8 col-md-9 paddLess">
      <?php $n=1; if(!empty($sliderData)){ 
          foreach ($sliderData as $slider) { ?>
        <div class="rank_Top"> <?=getWebsiteImage($slider->id)?>
          <div class="inner_sliderOverCont">
            <div class="row">
              <div class="col-xs-9"> <a href="#"><strong>Rank #1</strong></a> </div>
              <div class="col-xs-3"> <a class="slidHeart" href="javascript:AddToWishlist(<?=$slider->id?>)"><i class="fas fa-heart"></i></a> </div>
              <div class="col-xs-12">
                <div class="slidText_inner">
                  <h2><?=$slider->name?></h2>
                  <!-- <p>by <span><?=getUserName($slider->user_id)?></span> from <?=$slider->country?></p> -->
                  <p>by <span><?=getUserName($slider->user_id)?></span> </p>
                </div>
              </div>
              <div class="col-xs-12">
                <div class="slidrBtns_inner"> 
                <a target="_blank" href="<?=$slider->website_url?>"><?=getStaticContent('VISIT_SITE')?></a>
                <a href="javascript:VoteWebsite(<?=$slider->id?>)"><?=getStaticContent('VOTE_NOW')?></a> </div>
              </div>
            </div>
          </div>
        </div>
        <?php } } ?>
        <div class="sortBy">
          <label><?=getStaticContent('SORT_BY')?></label>
          <?php $sortby=$this->input->get('sortby'); ?>
          <select name="sortby" onchange="javascript:website_sortlisting(this.value);">
            <option value=""><?=getStaticContent('DATE')?></option>
            <option value="month" <?php if($sortby=='month') echo 'selected'; ?>><?=getStaticContent('MONTH')?></option>
            <option value="year" <?php if($sortby=='year') echo 'selected'; ?>><?=getStaticContent('YEAR')?></option>
          </select>
          <span>Showing <?=$startresult?><?=$endresult?><?=$totalResult?></span> 
          <?php 
          $userID=$this->session->userdata('user_id');
          if(empty($userID)){ ?> 
            <a href="#"  data-toggle="modal" data-target="#loginModel"><?=getStaticContent('POST_WEBSITE')?></a> 
          <?php } else { ?>
            <a href="<?=base_url('post-website')?>" ><?=getStaticContent('POST_WEBSITE')?></a> 
          <?php } ?>
          </div>
        <div class="row websiteListBox">
        <?php if(!empty($websiteData)){ 
          foreach ($websiteData as $dataItem) { ?>
         
          <div class="col-sm-6 col-md-4">
            <div class="webBox_2">
              <figure>
                <div class="overLayer"> <a class="wishList" href="javascript:AddToWishlist(<?=$dataItem->id?>)"><i class="fas fa-heart"></i></a> 
                <a class="votNow" href="javascript:VoteWebsite(<?=$dataItem->id?>)"><?=getStaticContent('VOTE_NOW')?></a> 
                </div>
                <?=getWebsiteImage($dataItem->id)?>
                <!-- <img src="<?=base_url('assets/front/images/web1.png')?>" class="img-responsive"> --> 
              </figure>
              <div class="boxCont_2">
                <div class="col-12">
                  <h3><a href="<?=base_url('website/'.$dataItem->slug)?>" title="<?=$dataItem->name?>"><?php $title=$dataItem->name; $str=substr($title, 0,28); $len=strlen($title); if($len>28){ $str.='...';} echo $str; ?> </a></h3>
                </div>
                <div class="col-6">
                  <p class="webRank"><a href="#">Total Vote : <?=getVote($dataItem->id)?></a></p>
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
          <div class="text-center" style="margin-top:50px;"><h4>Result Not Found !!</h4></div>
          <?php  } ?>
          
        <div class="paginate">
        <?=$pagination?>
          
          <div class="clearfix"></div>
        </div>
      </div>
    </div>
  </div>
</div>
</form>
</div>