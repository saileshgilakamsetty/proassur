<?php ?>
<h2><?=getContentLanguageSelected('CLAIM_DETAILS',defaultSelectedLanguage())?></h2>
<table class="dashBrdTable" id="example">
    <thead>
        <tr>
            <th><?=getContentLanguageSelected('S_NO',defaultSelectedLanguage())?></th>
            <th><?=getContentLanguageSelected('POLICY_NUMBER',defaultSelectedLanguage())?></th>
            <th><?=getContentLanguageSelected('TOTAL_PREMIUM',defaultSelectedLanguage())?></th>
            <th><?=getContentLanguageSelected('TOTAL',defaultSelectedLanguage())?></th>
            <th><?=getContentLanguageSelected('DATE',defaultSelectedLanguage())?></th>
        </tr>
    </thead>
    <tbody>
        <?php
//        echo '<pre>';
//        print_r($result);
        $i = 1;
        foreach ($result as $key => $val) {
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $val->policy_number; ?></td>
                <td><?php echo $val->total_premium; ?></td>
                <td><?php echo $val->total; ?></td>
                <td><?php echo $val->created_at; ?></td>
            </tr>
            <?php
            $i++;
        }
        ?>

    </tbody>
</table>