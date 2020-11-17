<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php //print_r($dataCollection); ?>

    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
            
            <h1><?=getContentLanguageSelected('CREDIT_INSURANCE_COMPANY_LIST',defaultSelectedLanguage())?></h1>
            <small><?=getContentLanguageSelected('CREDIT_INSURANCE_COMPANY_LIST',defaultSelectedLanguage())?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                <li class="active"><?=getContentLanguageSelected('CREDIT_INSURANCE_COMPANY_LIST',defaultSelectedLanguage())?></li>
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
                                            <th><?=getContentLanguageSelected('COMPANY_NAME',defaultSelectedLanguage())?></th>
                                            <th><?=getContentLanguageSelected('INSURANCE_RATE',defaultSelectedLanguage())?></th>
                                            <!-- <th>Action</th> -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if(!empty($dataCollection)){
                                            foreach ($dataCollection as $data) { 
                                            ?>
                                            <tr  class="select_company__credit" credit_tarification_id="<?=$data['id']?>" credit_detail_id="<?=$credit_detail_id?>" credit_insurance_rate = "<?=$data['insurance_rate']?>" value="<?=$data['company_id']?>" >
                                            <td><?=getCompanyName($data['company_id'])?></td>
                                            <td><?=$data['insurance_rate']?></td>
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
        </div>
    </section> <!-- /.content -->
</div>