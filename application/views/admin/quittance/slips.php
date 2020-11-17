<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-box1"></i>
        </div>
        <div class="header-title">
             
            <h1><?=getContentLanguageSelected('SLIPS',defaultSelectedLanguage())?></h1>
            <small><?=getContentLanguageSelected('SLIPS_LIST',defaultSelectedLanguage())?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?=base_url('admin/dashboard');?>"><i class="pe-7s-home"></i> <?=getContentLanguageSelected('HOME',defaultSelectedLanguage())?></a></li>
                <li class="active"><?=getContentLanguageSelected('SLIPS',defaultSelectedLanguage())?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">

            <div class="col-sm-12">
                
                <!-- <input type="hidden" id="current_link" name="current_link" value="<?=$current_link?>"> -->
                <div class="panel panel-bd">
                    <?php $success= $this->session->flashdata('message'); 
                        if(!empty($success)) { ?>
                        <div class="panel panel-success">
                          <div class="panel-heading">
                            <?php echo $this->session->flashdata('message'); ?>
                          </div>
                        </div>
                    <?php } ?>
                    <div class="panel-body">
                        <h3></h3>   
						<div class="table-responsive">
							<table id="example2" class="table table-bordered table-hover">
							    <thead>
							        <tr>
							            <th><?=getContentLanguageSelected('CHEQUE',defaultSelectedLanguage())?></th>
							            <th><?=getContentLanguageSelected('SLIP_NAME',defaultSelectedLanguage())?></th>
					                    <th><?=getContentLanguageSelected('TOTAL_POLICIES',defaultSelectedLanguage())?></th>
					                    <th><?=getContentLanguageSelected('ACTION',defaultSelectedLanguage())?></th>
							        </tr>
							    </thead>       
							    <tbody>
							    	<?php
							    		if(!empty($dataCollection)) { 
							    			foreach ($dataCollection as $key => $value) { ?>
							    				<tr>
							    					<td><img class="img-responsive" src="<?php echo base_url($value['cheque_path']);?>" width="150" height="100"></td>
							    					<td><?= $value['slip_name']?></td>
							    					<td><?= count($value['policy_numbers'])?></td>
							    					<td>
							    						<a href="<?=base_url('admin/quittance/view_slip?slip_name='.$value['slip_name'])?>" target="_blank" class="label-default label label-warning" data-toggle="tooltip" data-placement="left" title="View Slip "><i class="fa fa-edit" aria-hidden="true"></i></a>
                                    					<a href="<?=base_url('admin/quittance/download_file?file='.$value['cheque_path'])?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Download Cheque"><i class="fa fa-download" aria-hidden="true"></i></a>
							    						<a href="<?=base_url('admin/quittance/downloadSlipReport?slip_name='.$value['slip_name'])?>" target="_blank" class="label-default label label-warning" data-toggle="tooltip" data-placement="right" title="Download Slip Report"><i class="fa fa-download" aria-hidden="true"></i></a>
							    						<a onclick="return confirm('Sure you want to delete')" href="<?=base_url('admin/quittance/delete_slip/'.$value['id'])?>" class="label-default label label-danger" data-toggle="tooltip" data-placement="right" title="Delete Slip"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
							    					</td>
							    				</tr>
							    				<?php
							    			}
							    		}
							    	?>
							    </tbody>                 
							</table>
						</div>
						<div class="page-nation text-right">
							<?=$pagination?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section> <!-- /.content -->
</div>




