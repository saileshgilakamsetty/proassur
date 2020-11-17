<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <?php //print_r($dataCollection); ?>
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-box1"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('BONUS_&_REDUCTIONS',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('BONUS_&_REDUCTIONS',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('BONUS_&_REDUCTIONS',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <form  method="post" enctype="multipart/form-data">
            <?=form_error('value_selected_bounus_option'); ?>
               <input type="hidden" name="value_selected_bounus_option" id="value_selected_bounus_option" value="">
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
                                 <th><?=getContentLanguageSelected('YEAR',defaultSelectedLanguage())?></th>
                                 <th><?=getContentLanguageSelected('DISCOUNT',defaultSelectedLanguage())?></th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php if(!empty($discount_year)){ 
                                 foreach ($discount_year as $value) { ?>
                              <tr >
                                 <td>
                                    <input type="radio" name="selected_bounus_option" vehicle_detail_id="<?=$vehicle_detail_id?>" id="selected_bounus_option_<?=$value->id?>" value="<?=$value->id?>">
                                    <?=$value->year?> Year
                                 </td>
                                 <td><?=$value->discount?></td>
                              </tr>
                              <?php }} ?>
                           </tbody>
                        </table>
                        <div class="col-md-8">
                           <label><?=getContentLanguageSelected('FLEET_OPTION',defaultSelectedLanguage())?></label>
                              <label class="radio-inline"><input type="radio" name="fleet_option" vehicle_detail_id="<?=$vehicle_detail_id?>" value="1">Yes </label>
                              <label class="radio-inline"><input type="radio" name="fleet_option" vehicle_detail_id="<?=$vehicle_detail_id?>" checked="checked" value="2">No</label>
                           <div id="fleet_percent_show" class="hide">
                              <label><?=getContentLanguageSelected('FLEET_PERCENTAGE',defaultSelectedLanguage())?></label>
                              <input type="number" name="fleet_percentage" id="fleet_percentage" value="" />
                           </div>
                        </div>
                        <p>&nbsp;</p>
                        <div class="col-md-6">
                           <div class="control-group">
                              <label><?=getContentLanguageSelected('INSURANCE_COMPANY_CERTIFICATE',defaultSelectedLanguage())?></label>
                              <input type="file"  name="image" id="image"/>
                           </div>
                        </div>
                     </div>

                     <div class="clearfix"></div>
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
   </section>
   <!-- /.content -->
</div>