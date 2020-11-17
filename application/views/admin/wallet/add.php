<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="header-icon">
            <i class="pe-7s-note2"></i>
        </div>
        <div class="header-title">
            <h1><?= getContentLanguageSelected('WALLET_MANAGEMENT', defaultSelectedLanguage()) ?> </h1>
            <small><?= getContentLanguageSelected('WALLET_MANAGEMENT', defaultSelectedLanguage()) ?></small>
            <ol class="breadcrumb hidden-xs">
                <li><a href="<?= base_url('admin/dashboard'); ?>"><i class="pe-7s-home"></i> <?= getContentLanguageSelected('HOME', defaultSelectedLanguage()) ?></a></li>
                <li class="active"><?= getContentLanguageSelected('WALLET_MANAGEMENT', defaultSelectedLanguage()) ?></li>
            </ol>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- Form controls -->
            <div class="col-sm-12">


                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= base_url('admin/wallet') ?>"> <i class="fa fa-list"></i>  <?= getContentLanguageSelected('WALLET_LIST', defaultSelectedLanguage()) ?></a>  
                        </div>
                    </div>
                    <?php // print_r($result); die; ?>
                    <div class="panel-body">
                        <!--<form  method="post" enctype="multipart/form-data">-->
                        <?php
                        $action = isset($result->id) ? 'admin/wallet/add/' . $result->id : 'admin/wallet/add';
                        echo form_open_multipart($action);
                        ?>
                        <div class="col-sm-6" >
                            <div class="form-group">
                                <label><?= getContentLanguageSelected('PARTNER_NAME', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                                <?php
                                $selected = isset($result->user_id) ? $result->user_id : $this->input->post('user_id');

                                $user_id = array('' => '---Select --');
                                $user = getPartner($result->user_id);//                               
                                foreach ($user as $val){
                                    $user_id[$val->id] = $val->name;
                                }
                                echo form_dropdown('user_id', $user_id, $selected, array('class' => 'form-control', 'required' => TRUE));
                                ?>
                                <?= form_error('user_id'); ?>
                            </div>

                            <div class="form-group">
                                <label><?= getContentLanguageSelected('WALLET_AMOUNT', defaultSelectedLanguage()) ?><span class="required">*</span></label>
                                <input type="text" name="amount" class="form-control" placeholder="Enter Wallet Amount" value="<?php echo isset($result->amount) ? set_value("amount", $result->amount) : set_value("amount"); ?>">
                                <?= form_error('amount'); ?>
                            </div>
                        </div> 

                        <div class="col-sm-10" >                                               
                            <div class="reset-button">
                                <button class="btn btn-success"><?= getContentLanguageSelected('SAVE', defaultSelectedLanguage()) ?></button>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div>

