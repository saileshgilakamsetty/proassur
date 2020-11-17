<style>
  .breadcrumb{ max-width: none !important; }
  </style>

<div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
      <div class="header-icon">
         <i class="pe-7s-note2"></i>
      </div>
      <div class="header-title">
         <h1><?=getContentLanguageSelected('VEHICLE_POLICIES',defaultSelectedLanguage())?></h1>
         <small><?=getContentLanguageSelected('VEHICLE_POLICIES_EDIT',defaultSelectedLanguage())?></small>
         <ol class="breadcrumb hidden-xs">
            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
            <li><a href="<?=base_url('admin/vehicle/vehicle-policies');?>"> <?=getContentLanguageSelected('VEHICLE_POLICIES',defaultSelectedLanguage())?></a></li>
            <li class="active"><?=getContentLanguageSelected('VEHICLE_POLICIES_EDIT',defaultSelectedLanguage())?></li>
         </ol>
      </div>
   </section>
   <!-- Main content -->
   <section class="content">
      <div class="row">
         <!-- Form controls -->
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
                  <div class="row">
                     <div class="col-md-12">
                        <form  method="post" enctype="multipart/form-data">
                           <div class="col-md-6" >

                              <div class="form-group">
                                 <label><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <input type="text" class="form-control" id="policy_number" name="policy_number" placeholder="Policy Number" value="<?=set_value('policy_number',isset($policy_number)?$policy_number:''); ?>">
                                 <?=form_error('policy_number'); ?>
                              </div>

                              <!-- <div class="form-group">
                                 <label><?=getContentLanguageSelected('CAPITAL_INSURED',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <?php
                                    $capital_insured = $proffesional_multirisk_detail->capital_insured;
                                 ?>
                                 <input type="text" class="form-control" id="capital_insured" name="capital_insured" placeholder="Capital Insured" value="<?=set_value('capital_insured',isset($capital_insured)?$capital_insured:''); ?>">
                                 <?=form_error('capital_insured'); ?>
                              </div> -->

                              <div class="form-group">
                                 <label><?=getContentLanguageSelected('WARRANTIES',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <?php $data = 'class="form-control multiselect"';
                                    echo form_multiselect('optional_warranties_vehicle[]',getMultipleOptionalWarranties($company_id,$branch_id,$risque_id,'Select Waranties'),set_value("optional_warranties_vehicle[]",$selected_warranties),$data);?>
                                 <?=form_error('optional_warranties_vehicle[0]'); ?>
                              </div>

                              <div class="form-group">
                                 <label><?=getContentLanguageSelected('FRANCHISES',defaultSelectedLanguage())?><span class="required">*</span></label>
                                 <?php $data = 'class="form-control multiselect"';
                                    echo form_multiselect('optional_franchises_vehicle[]',getMultipleOptionalFranchises($company_id,$branch_id,'Select Franchises'),set_value("optional_franchises_vehicle[]",$selected_franchises),$data);?>
                                 <?=form_error('optional_franchises_vehicle[0]'); ?>
                              </div>



                              <div class="table-responsive">
                                 <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                       <tr>  
                                          <th><?=getContentLanguageSelected('OPTIONS',defaultSelectedLanguage())?></th>
                                          <th><?=getContentLanguageSelected('AMOUNT',defaultSelectedLanguage())?></th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <?php if(!empty($transported_person_insurance)){ 
                                       foreach ($transported_person_insurance as $value) { ?>
                                          <tr >
                                             <td>
                                             <input type="radio" name="selected_option_transport_person" vehicle_detail_id="<?=$vehicle_detail_id?>" id="selected_option_transport_person_<?=$value->id?>" value="<?=$value->id?>" <?= ($value->id == $selected_vehicle_trans_insurance->vehicle_trans_person_insurance_id)?'checked':'';?>>
                                             <?=$value->title?></td>
                                             <td><?=$value->amount_to_pay?></td>
                                          </tr>
                                       <?php }} ?>                      
                                    </tbody>
                                 </table>
                              </div>
                           </div>
                        <?php if(!empty($fleetData)){ ?>
                           <div class="col-md-6 text-right">
                              <a class="btn btn-primary" href="<?=base_url('admin/vehicle/addMoreVehicle/'.$policy_number.'/'.$vehicle_detail_id);?>"><i class="fa fa-plus"></i> <?=getContentLanguageSelected('ADD_MORE_VEHICLE',defaultSelectedLanguage())?></a>
                           </div>
                        <?php } ?>
                           <div class="col-md-12" >
                              <div class="reset-button">
                                 <button class="btn btn-success" onclick="return confirm('If you update this policy without changing your policy number, your old data will be lost. Do You want to Update This Policy? ')"><?=getContentLanguageSelected('SAVE',defaultSelectedLanguage())?></button>
                              </div>
                           </div>
                        </form>
                     </div>
                  </div>

               <?php if(!empty($otherVehicleDetailData)){ ?>
                  <hr/>
                  <h3><?=getContentLanguageSelected('OTHER_VEHICLE_DETAILS',defaultSelectedLanguage())?></h3>
                  <div class="row">
                     <div class="col-md-12">
                        <div class="table-responsive">
                           <table id="example3" class="table table-bordered table-hover">
                              <thead>
                                 <tr>  
                                    <th><?=getContentLanguageSelected('VEHICLE_REGISTRATION_NUMBER',defaultSelectedLanguage())?></th>
                                    <th><?=getContentLanguageSelected('CHASIS_NUMBER',defaultSelectedLanguage())?></th>
                                    <th><?=getContentLanguageSelected('REGISTERATION_DATE',defaultSelectedLanguage())?></th>
                                 </tr>
                              </thead>
                              <tbody>
                                 <?php foreach ($otherVehicleDetailData as $value) { ?>
                                    <tr >
                                       <td><?=$value->registeration_number;?></td>
                                       <td><?=$value->chasis_number;?></td>
                                       <td><?=$value->insurance_registeration_date;?></td>
                                    </tr>
                                 <?php } ?>                      
                              </tbody>
                           </table>
                        </div>
                     </div>
                  </div>
               <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </section>
   <!-- /.content -->
</div>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<style type="text/css">
   .inlineinput div {
    display: inline;
}
</style>