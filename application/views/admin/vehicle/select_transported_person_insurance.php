<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php //print_r($dataCollection); ?>

                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                   <div class="header-title">
                      <h1><?=getContentLanguageSelected('INSURE_TRANSPORTED_PERSON',defaultSelectedLanguage())?></h1>
                      <small><?=getContentLanguageSelected('INSURE_TRANSPORTED_PERSON',defaultSelectedLanguage())?></small>
                      <ol class="breadcrumb hidden-xs">
                         <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                         <li class="active"><?=getContentLanguageSelected('INSURE_TRANSPORTED_PERSON',defaultSelectedLanguage())?></li>
                      </ol>
                   </div>

                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                      <form  method="post" enctype="multipart/form-data">
                     <div class="col-md-12" >
                           <?=form_error('value_selected_travel_insure'); ?>

                     <input type="hidden" id="value_selected_travel_insure" name="value_selected_travel_insure" value="">
                        <div class="control-group">
                           <label><?=getContentLanguageSelected('INSURE_TRANSPORTED_PERSONS_YOU_WANT',defaultSelectedLanguage())?>?<span class="required">*</span></label><br>
                           <label class="cus_radio">
                              <input type="radio" vehicle_detail_id="<?=$vehicle_detail_id?>" name="insure_transported_person" value="1" checked="checked"><?=getContentLanguageSelected('YES',defaultSelectedLanguage())?>
                           </label>
                           <label class="cus_radio">
                              <input type="radio" vehicle_detail_id="<?=$vehicle_detail_id?>" name="insure_transported_person" value="0" ><?=getContentLanguageSelected('NO',defaultSelectedLanguage())?>
                           </label>
                           <?=form_error('insure_transported_person'); ?>
                        </div>
                     </div>  
                        <div class="col-sm-12">


                        <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                        <?php } ?>
                            <div class="panel panel-bd">

                        <div class="panel-body">      
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>  
                                        <th><?=getContentLanguageSelected('OPTIONS',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></th>
                                    </tr>
                                </thead>
                                <tbody>
                          <?php if(!empty($options)){ 
                          foreach ($options as $value) { ?>
                          <tr >
                                   <td>
                                   <input type="radio" name="selected_option_transport_person" vehicle_detail_id="<?=$vehicle_detail_id?>" id="selected_option_transport_person_<?=$value->id?>" value="<?=$value->id?>">
                                   <?=$value->title?></td>
                                   <td><?=$value->amount_to_pay?></td>

                            </tr>
                            <?php }} ?>
                            
</tbody>
</table>
</div>
                     <div class="col-md-12" >
                        <div class="reset-button">
                           <button class="btn btn-success"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                        </div>
                     </div>
<!-- <div class="page-nation text-right">
    <?=$pagination?>
</div> -->
</div>
</div>
</div>
</form>
</div>
</section> <!-- /.content -->
</div>