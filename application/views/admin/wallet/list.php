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
            <?php if ($this->session->flashdata('success')) { ?>
                <div class="alert alert-success alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success!</strong> <?php echo $this->session->flashdata('success'); ?>
                </div>
            <?php } ?>

            <?php if ($this->session->flashdata('error')) { ?>
                <div class="alert alert-danger alert-dismissible">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
                </div>
            <?php } ?>
            <!-- Form controls -->
            <div class="col-sm-12">
                <div class="panel panel-bd">
                    <div class="panel-heading">
                        <div class="btn-group"> 
                            <a class="btn btn-primary" href="<?= base_url('admin/wallet/add') ?>"> <i class="fa fa-list"></i>  <?= getContentLanguageSelected('ADD_WALLET', defaultSelectedLanguage()) ?></a>  
                        </div>
                    </div>


                    <div class="panel-body">
                        <?php //print_r($result); ?>
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th><?= getContentLanguageSelected('S_NO', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('USER', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('DATE', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('ACTION', defaultSelectedLanguage()) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($result as $val) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val->amount; ?></td>
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo $val->created_at; ?></td>
                                        <td><?php echo ($val->status==0 ? '<span class="btn btn-primary btn-xs">Active</span>' : '<span class="btn btn-danger btn-xs">In-Active</span>'); ?></td>
                                        <td>
                                            <a href="<?php echo base_url('admin/wallet/edit/') . $val->id; ?>" class="btn btn-primary btn-xs" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                            <a href="<?php echo base_url('admin/wallet/delete/') . $val->id; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" title="Delete" onclick="return confirm('Are you sure delete this item?')"><i class="fa fa-trash-o"></i></a>
                                            <a href="<?php echo base_url('admin/wallet/history/') . $val->id; ?>" class="btn btn-warning btn-xs" data-toggle="tooltip" title="Wallet History"><i class="fa fa-credit-card-alt"></i></a>

                                        </td>

                                    </tr>
                                    <?php
                                    $i++;
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section> <!-- /.content -->
</div>


<script type="text/javascript">
    $('#example').dataTable({
//        "pageLength": 50,
        "bSort": false,
    });
</script>
