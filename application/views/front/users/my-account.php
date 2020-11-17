
<div class="profileMain">
  <div class="container">
    <div class="row">
      <div class="col-sm-5 col-md-4">
        <figure class="user_profile_img">
        <?=getUserImage(($dataCollection->id)?$dataCollection->id:"")?>
        
        </figure>
      </div>
      <div class="col-sm-7 col-md-8">
        <div class="rightSide">
          <div class="aboutMe">
            <h2><?=getStaticContent('ABOUT_ME')?></h2>
            <p><?=isset($dataCollection->about_me)?$dataCollection->about_me:""?></p>
          </div>
          <div class="aboutDetail">
            <div class="headingTitle">
              <h3><?=isset($dataCollection->first_name)?$dataCollection->first_name:""?> <?=isset($dataCollection->last_name)?$dataCollection->last_name:""?></h3>
              <a href="#"><i class="fas fa-map-marker-alt"></i> <?=isset($dataCollection->country)?$dataCollection->country:""?></a>
              <a href="<?=base_url('update-profile')?>" class="edit_profile"><?=getStaticContent('EDIT_PROFILE')?></a>
              </div>
            <ul class="meDetail">
              <li>
                <h4>Email:</h4>
                <p><?=isset($dataCollection->email)?$dataCollection->email:""?></p>
              </li>
              <li>
                <h4>Phone:</h4>
                <p><?=isset($dataCollection->mobile)?$dataCollection->mobile:""?></p>
              </li>
             <!--  <li>
                <h4>Gender:</h4>
                <p><?=isset($dataCollection->gender)?$dataCollection->gender:""?></p>
              </li> -->
              <li>
                <h4>Address:</h4>
                <p><?=isset($dataCollection->address)?$dataCollection->address:""?></p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="ourProject">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="title"><?=getStaticContent('MY_RECENT_PROJECTS')?></h2>
      </div>
      
      
      <?php if(!empty($myProjects)){ 
            // print_r($ourWinners);
          foreach ($myProjects as $projectItem) { ?>
            <div class="col-sm-6 col-md-4">
              <div class="winBox">
                  <figure>
                        <a class="winLike" href="javascript:AddToWishlist(<?=$projectItem->id?>)"><i class="fas fa-heart"></i></a>
                        <a href="<?=base_url('website/'.$projectItem->slug)?>" ><?=getWebsiteImage($projectItem->id)?></a>
                      
                    </figure>
                    <div class="boxCont">
                      <h3><a href="#"><a href="<?=base_url('website/'.$projectItem->slug)?>" title="<?=$projectItem->name?>"><?php $title=$projectItem->name; $str=substr($title, 0,38); $len=strlen($title); if($len>38){ $str.='...';} echo $str; ?> </a></a></h3>
                      <div class="col-6">
                          <!-- <p>From <?=$projectItem->country?></p> -->
                        </div>
                        <div class="col-6">
                          <ul class="soMonth">
                              <li><?=getCategoryName($projectItem->category)?></li>
                                <li><?=date("F", strtotime($projectItem->datetime))?></li>
                            </ul>
                        </div>
                       <!--  <div class="byMade"><span><?php $str=getUserName($projectItem->user_id); echo substr($str,0,1);?></span> BY <strong><?=getUserName($projectItem->user_id)?></strong></div> -->
                    </div>
                </div>
            </div>
            <?php } } ?>
      
    </div>
  </div>
</section>
<section class="ourWinners">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="title"><?=getStaticContent('MY_WINNING_WEBSITE')?></h2>
      </div>
      
     
      <?php if(!empty($ourWinners)){ 
             $i=0;
             $user_id = $this->session->userdata('user_id');
          foreach ($ourWinners as $WinnersItem) { 
            $wid=$WinnersItem['user_id'];
            if($user_id==$wid) { ?>
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
                       <!--  <div class="byMade"><span><?php $str=getUserName($WinnersItem['user_id']); echo substr($str,0,1);?></span> BY <strong><?=getUserName($WinnersItem['user_id'])?></strong></div> -->
                    </div>
                </div>
            </div>
            <?php 

            $i++; 
            if($i==3) { 
            break;
            }
            } 
            
            } } ?>
      
    </div>
  </div>
</section>