<section class="detail_main">
<div class="container">
<div class="row">
<?php 
$success= $this->session->flashdata('message'); 
               if(!empty($success)) { ?>
            <div class="panel panel-success">
               <div class="panel-heading">
                  <?php echo $this->session->flashdata('message'); ?>
               </div>
            </div>
            <?php } ?>

<div class="col-sm-9 col-md-8">

<div class="postWebsite">
<h2><?=getStaticContent('EDIT_WEBSITE')?> : <?=isset($dataCollection->name)?$dataCollection->name:""?></h2>
<form  method="post" enctype="multipart/form-data" >                

   <div class="col-md-6" >

      <div class="form-group">
         <label>Websites Name<span class="required">*</span></label>
         <input type="text" class=" form-control input " id="name" name="name" value="<?=set_value('name', isset($dataCollection->name)?$dataCollection->name:""); ?>" />
         <?=form_error('name'); ?>
      </div>
      <div class="form-group">
         <label for="category">Category<span class="required">*</span></label>
         <?php $data = 'class="form-control"';
            echo form_dropdown('category',$categoryCollection,set_value('category', isset($dataCollection->category)?$dataCollection->category:""),$data);?>
         <?=form_error('category'); ?>
      </div>
      <div class="form-group">
         <label for="location">Address<span class="required">*</span></label>
         <input type="text"   class="form-control" id="site_location" name="site_location" value="<?=set_value('site_location', isset($dataCollection->address)?$dataCollection->address:""); ?>" autocomplete="off" >
         <?=form_error('site_location'); ?>
      </div>
      <div class="form-group">
         <label for="location">Country<span class="required">*</span></label>
          <input type="text" name="country" id="country" class="form-control" placeholder="Country"  value="<?=set_value('country', isset($dataCollection->country)?$dataCollection->country:""); ?>" >
               <?=form_error('country'); ?>
      </div>

   </div>
   
   <div class="col-sm-6">
  
      <div class="form-group">
         <label for="websites_type">Website Url<span class="required">*</span></label>
        <input type="text" class=" form-control input " id="website_url" name="website_url" value="<?=set_value('website_url', isset($dataCollection->website_url)?$dataCollection->website_url:""); ?>" />
         <?=form_error('website_url'); ?>
      </div>
      <div class="form-group">
         <label for="color">Color<span class="required">*</span></label>
         <?php $data = 'class="form-control"';
            echo form_dropdown('color',$colorCollection,set_value('color', isset($dataCollection->color)?$dataCollection->color:""),$data);?>
         <?=form_error('color'); ?>
      </div>
      <div class="form-group">
         <label for="location">State<span class="required">*</span></label>
          <input type="text" name="state" id="administrative_area_level_1" class="form-control" placeholder="State" value="<?=set_value('state', isset($dataCollection->state)?$dataCollection->state:""); ?>" >
               <?=form_error('state'); ?>
      </div>
     
       
   </div>

               


               <input type="hidden" name="city" class="form-control" placeholder="City" value="<?=(isset($dataCollection->city))?$dataCollection->city:'';?>" id="locality">
               <?=form_error('city'); ?>


               <input type="hidden" name="postal_code" class="form-control" placeholder="Zip Code" value="<?=(isset($dataCollection->postal_code))?$dataCollection->postal_code:'';?>" id="postal_code">
               <?=form_error('postal_code'); ?>

   <div id="address">
      <input type="hidden" id="street_number" disabled="true">
      <input type="hidden" id="route" disabled="true">                
      <input type="hidden" id="latitude" name="latitude" value="<?=(isset($dataCollection->latitude))?$dataCollection->latitude:'';?>">     
      <input type="hidden" id="longitude" name="longitude" value="<?=(isset($dataCollection->longitude))?$dataCollection->longitude:'';?>">    
   </div>

   
   <div class="col-sm-12">

      <div class="form-group">
         <label>Description<span class="required">*</span></label>
         <textarea class="form-control" name="description" placeholder="Description" id="description"  rows="10"><?=set_value('description', isset($dataCollection->description)?$dataCollection->description:""); ?></textarea>
         <?=form_error('description'); ?>
      </div>

   </div>
   <div style="height:0px;clear: both;"></div>               
   <div id="imgMsg"></div>
   <input type="hidden" name="save_img" value="" id="save_img">
                 
   <div class="col-md-3"  id="blah_container">
     <?=getWebsiteImage($dataCollection->id)?>
   </div>
   <div style="height: 20px;clear: both;"></div>
   <div class="col-md-12">
      <div class="control-group">
         
         <div class="upload-btn-wrapper">
           <button class="btn btn-info">Upload Website Images</button>
           <input type="file"  id="image_up" name="image[]" multiple="false" onchange="checkPhoto(this)"/>
         </div>
         
      </div>
   </div>
   <div style="height: 20px;clear: both;"></div>
   <div class="col-md-12" >

      <div class="reset-button">
         <button class="btn btn-success">Update</button>
      </div>
   </div>
</form>
</div>
</div>
<div class="col-sm-5 col-md-4">
<?php if(!empty($topData)){ ?>
  <div class="webBox_2 top_rated">
<h2><?=getStaticContent('TOP_RATED')?></h2>
<?php  foreach ($topData as $topMost) { ?>
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
                  <p><?=$topMost->country?></p>
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
          <h2>Latest Added</h2>
          <ul>
           <?php 
            if(!empty($latestWebsiteList)){
              foreach ($latestWebsiteList as $latest) { ?>
               <li> <a href="<?=base_url('website/'.$latest->slug)?>" title="<?=$latest->name?>">
              <figure> <?=getWebsiteImage($latest->id)?></figure>
              <?php $title=$latest->name; $str=substr($title, 0,40); $len=strlen($title); if($len>40){ $str.='...';} echo $str; ?> <br>
              From <?=$latest->country?> </a> </li>
          <?php } }  ?>
          </ul>
        </div>
</div>
</div>
</div>
</section>