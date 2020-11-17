<?php
/* Question Controller
 * Author: Arvind Kumar Singh
 * Date: 11-12-2019
 */

?>

<div class="container-fluid">
    <div class="mainTitle">
        <h1><?=getContentLanguageSelected('INSURANCE_SETTINGS',defaultSelectedLanguage())?></h1>
    </div>
    <!---->
    <div class="selectArea">
        <div class="row">
            <aside class="col-sm-5">
                <select>
                    <option value=""><?=getContentLanguageSelected('SELECT_BRANCH',defaultSelectedLanguage())?> </option>
                    <option value="">Branch1</option>
                    <option value="">Branch2</option>
                </select>
            </aside>
            <aside class="col-sm-7">
                <a href=""> <button><?=getContentLanguageSelected('ADD_QUESTION',defaultSelectedLanguage())?></button></a>
            </aside>
        </div>
    </div>
    <!---->
    <div class="table-responsive">
        <table class="dashBrdTable">
            <thead>
                <tr>
                    <th><?=getContentLanguageSelected('S_NO',defaultSelectedLanguage())?></th>
                    <th><?=getContentLanguageSelected('QUESTION',defaultSelectedLanguage())?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Lorem Ipsum Dolor</td>


                </tr>

            </tbody>

        </table>
    </div>
</div>