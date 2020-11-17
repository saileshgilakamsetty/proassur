<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php //print_r($dataCollection); ?>

                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                    <div class="header-title">
                        
                        <h1><?=getContentLanguageSelected('VEHICLE_COMPANY_LIST',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('VEHICLE_COMPANY_LIST',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('VEHICLE_COMPANY_LIST',defaultSelectedLanguage())?></li>
                        </ol>
                    </div>
                </section>
                <!-- Main content -->
                <section class="content">
                    <div class="row">

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
                                <div class="panel-heading">

                        <div class="panel-body">      
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>  
                                        <th><?=getContentLanguageSelected('COMPANY',defaultSelectedLanguage())?></th>
                                        <th><?=getContentLanguageSelected('ESTIMATION',defaultSelectedLanguage())?></th>
                                        <!-- <th>Action</th> -->
                                    </tr>
                                </thead>
                                <tbody>
                          <?php if(!empty($dataCollection)){ 
                          foreach ($dataCollection as $data) { 
                           ?>
                          <tr  class="select_company_option" company_vehicle_quote_id="<?=$data['id']?>" value="<?=$data['company_id']?>" vehicle_basic_info_id = "<?= $vehicle_basic_info_id;?>" usage="<?= $vehicle_basic_info->usage?>" risque_id="<?= $vehicle_basic_info->risque?>" immatriculation = "<?= $vehicle_basic_info->immatriclulation?>">
                                   <td><?=getCompanyName($data['company_id'])?></td>
                                   <td><?=$data['amount']?></td>
                            </tr>
                            <?php }} ?>
                            
</tbody>
</table>
</div>
<div class="page-nation text-right">
    <!--<?=$pagination?> -->
</div>
</div>
</div>
</div>
</div>
</section> <!-- /.content -->
</div>