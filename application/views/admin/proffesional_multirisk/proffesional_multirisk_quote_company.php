<div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <?php //print_r($dataCollection); ?>

                <section class="content-header">
                    <div class="header-icon">
                        <i class="pe-7s-box1"></i>
                    </div>
                    <div class="header-title">
                        
                        <h1><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></h1>
                        <small><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></small>
                        <ol class="breadcrumb hidden-xs">
                            <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                            <li class="active"><?=getContentLanguageSelected('PROFFESIONAL_MULTI_RISK_QUOTE',defaultSelectedLanguage())?></li>
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
                        <h3><?=getContentLanguageSelected('LIST_OF_COMPANIES_FOR_SELECTED_ACTIVITY',defaultSelectedLanguage())?></h3>
                        <div class="panel-body">      
                          <div class="table-responsive">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>  
                                       <th><?=getContentLanguageSelected('COMPANY_NAME',defaultSelectedLanguage())?></th>
                                    </tr>
                                </thead>
                                <tbody>
                           <?php if(!empty($company_id_array)){ 
                          
                              foreach ($company_id_array as $company_id) { 
                              ?>
                              <tr  class="select_proffesional_multirisk_company_option" proffesional_multirisk_quote_id="<?=$proffesional_multirisk_quote_id?>" value="<?=$company_id?>" >
                                 <td><?=getCompanyName($company_id)?></td>
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