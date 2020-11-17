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
                            <a class="btn btn-primary" href="<?= base_url('admin/wallet') ?>"> <i class="fa fa-list"></i>  <?= getContentLanguageSelected('WALLET_LIST', defaultSelectedLanguage()) ?></a>  
                        </div>
                    </div>

                    <div class="panel-body">
                        <?php //print_r($result); ?>
                        <table class="table" id="example">
                            <thead>
                                <tr>
                                    <th><?= getContentLanguageSelected('S_NO', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('SUMMARY', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('AMOUNT', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('USER', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('DATE', defaultSelectedLanguage()) ?></th>
                                    <th><?= getContentLanguageSelected('STATUS', defaultSelectedLanguage()) ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                foreach ($result as $val) {
                                    ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo $val->summary; ?></td>
                                        <td><?php echo $val->amount; ?></td>                                        
                                        <td><?php echo $val->name; ?></td>
                                        <td><?php echo $val->created_at; ?></td>
                                        <td><?php echo ($val->status=='1' ? '<span class="btn btn-danger btn-xs">Dredit</span>' :'<span class="btn btn-primary btn-xs">Credit</span>'); ?></td>
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
//    $('#example').dataTable({
////        "pageLength": 50,
//        "bSort": false,
//    });
</script>
