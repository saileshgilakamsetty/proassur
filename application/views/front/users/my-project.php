<section class="projectList">
<div class="container">
<div class="row">
<?php $success= $this->session->flashdata('message'); 
               if(!empty($success)) { ?>
            <div class="panel panel-success">
               <div class="panel-heading">
                  <?php echo $this->session->flashdata('message'); ?>
               </div>
            </div>
            <?php } ?>

<div class="col-sm-9 col-md-8">
<a class="webPost" href="<?=base_url('post-website')?>"><?=getStaticContent('POST_WEBSITE')?></a>
<table class="table table-striped table-bordered table-responsive custab">
    <thead>
        <tr>
            <th align="left" valign="middle"><?=getStaticContent('WEBSITE_NAME')?></th>
            <th align="left" valign="middle"><?=getStaticContent('CATEGORIES')?></th>
            <th align="left" valign="middle"><?=getStaticContent('STATUS')?></th>
            <th align="center" valign="middle" width="15%"><?=getStaticContent('ACTION')?></th>
        </tr>
    </thead>
    <tbody>
        <?php if(!empty($myProjects)){ 
            foreach ($myProjects as $projectData) { ?>
            <tr>
                <td align="left" valign="middle"><?=isset($projectData->name)?$projectData->name:""?></td>
                <td align="left" valign="middle"><?=isset($projectData->category)?getCategoryName($projectData->category):""?></td>
                <td align="left" valign="middle">
                    <?php 
                        $status= $projectData->status;
                        if($status==0){ ?>
                            <span  class="btn-danger btn-xs"><?=getStaticContent('INACTIVE')?></span>
                        <?php } else { ?>
                            <span  class="btn-success btn-xs"><?=getStaticContent('ACTIVE')?></span>
                        <?php } ?>
                </td>
                <td align="center" valign="middle" class="editBtn">
                <a target="_blank" href="<?=base_url('website/'.$projectData->slug)?>"><i class="fas fa-eye"></i></a>
                <a href="<?=base_url('website/edit/'.$projectData->id)?>"><i class="fas fa-pencil-alt"></i></a>
                <a href="<?=base_url('websites/delete/'.$projectData->id)?>"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php } } else { ?>  
              <tr>
                <td colspan="4" align="center">
                  <h4>No result found!!</h4>
                </td>
              </tr>          
            <?php }  ?>            
            </tbody>
    </table>
    <div class="paginate">
        <?=$pagination?>
          
          <div class="clearfix"></div>
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
          <h2><?=getStaticContent('LATEST_ADDED')?></h2>
          <ul>
           <?php 
            if(!empty($latestWebsiteList)){
              foreach ($latestWebsiteList as $latest) { ?>
               <li> <a href="<?=base_url('website/'.$latest->slug)?>" title="<?=$latest->name?>">
              <figure> <?=getWebsiteImage($latest->id)?></figure>
              <?php $title=$latest->name; $str=substr($title, 0,40); $len=strlen($title); if($len>40){ $str.='...';} echo $str; ?> <br>
              <!-- From <?=$latest->country?> </a> </li> -->
              </a> </li>
          <?php } }  ?>
          </ul>
        </div>
</div>
</div>
</div>
</section>


