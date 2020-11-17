<style type="text/css">
.pdfWaterMark{background:url(<?=base_url()?>/assets/admin/images/favicon.png) no-repeat center center; background-size:100%; display:table; height:100%; width:100%;}
</style>

<div class="pdfWaterMark">
  <section class="content">
    <div class="row">
      <?php 
      if(!empty($question_ids)){ 
        $i = 0;
        foreach ($question_ids as $data) { $i++; ?>
          <div class="col-md-12" >
            <p>Question <?=$i?> : <?=getQuestionName($data,'tbl_questionnaries')?>
              <span class="required">*</span>
            </p>
            <hr>
            <br>
            <hr>
          </div>
          <?php
        }
      } ?>
    </div>
  </section>
</div>