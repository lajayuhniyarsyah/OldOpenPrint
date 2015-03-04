<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>
<style type="text/css">
    table{
        /* border-top: 1px solid black;
        border-bottom: 1px solid black; */
    }
    .pages{
        height: 282mm;
        padding-top:18mm;
        padding-left:4mm;
        page-break-after: always;
    }
    .amount{
        margin-left:61%;
    }
    .lineFoot{
        padding-left: 74%;
    }
    .mrgBtm1{
        margin-bottom: 1%;
    }
    .sign{
        margin-top: 15mm;
        padding-left: 58%;
    }
    .sign .signName{
        margin-top: 86px;
        margin-left: 9%;
    }
    .cRows{
        vertical-align: top;
    }
    .contentLines{
        font-size: 11pt;
    }

    .xxx{
        position: absolute;
        margin-left: -118mm;
        margin-top: -1mm;
        font-weight: bold;
    }
    .fontAddr{
        font-size: 13px;
    }
    .choosePrinter{
        position: absolute;
        z-index: 9999;
        right: 0;
    }
    .wid1{
        width: 111px;
        padding-right: 10px;
        text-align: right;
    }
    .pkp{
        /*background: lime;*/
        height: 80px;
    }
    .pbkp{
        margin-top:10mm;margin-left:36mm;
    }
    .partnerStreet{
        height: 37px;
        vertical-align: middle;
    }
    .ptSupra{
        margin-bottom:1mm;padding-top:8px;
    }
    .tdPartner{
        height:129px;vertical-align:top;
    }
    .partnerName{
        margin-bottom:2mm;padding-top:4px;
    }
    .productDescTd{
        padding-right: 10px;
    }
    <?php
    if($printer=='sri'):
        echo '.pages{padding-top: 12mm;}';
    endif;

    ?>
    @media print{
        .xxx table, .xxx table tr, .xxx table tr td{
            border: 0px;
        }

        .choosePrinter{
            display: none;
        }
    }


</style>

<div class="choosePrinter">
    <form method="get" id="formSelectPrinter">
            <input type="hidden" value="<?=Url::to('account-invoice/print')?>" name="r" />
            <input type="hidden" value="<?=$model->id?>" name="id" />
            <input type="hidden" value="<?=Yii::$app->request->get('uid')?>" name="uid" />
        Print To : <select name="printer" onchange="jQuery('#formSelectPrinter').submit();">
            <option <?=($printer=='refa' ? 'selected ':null)?> value="refa">Refa</option>
            <option <?=($printer=='sri' ? 'selected ':null)?> value="sri">Sri</option>
        </select>
    </form>
</div>
<div id="pageContainer">
<div class="pages">
    <table style="width:190mm;height:100%;border-right:0px solid black;">
        <tr style="vertical-align:top;">
            <td>
                <table style="width:100%;" cellpadding="3" cellspacing="2">
                    <tr>
                        <td>
                            <div>Inv. <?=$model->kwitansi?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div style="margin-left:50mm;margin-top:2mm;"><?=$model->faktur_pajak_no?></div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="pkp" style="margin-top:7mm;margin-left:36mm;">
                                <div class="ptSupra">PT. SUPRABAKTI MANDIRI</div>
                                <div class="fontAddr" style="height:10mm;"><span>Jl. Danau Sunter Utara Blok. A No. 9 Tanjung Priok - Jakarta Utara 14350</span></div>
                                <div>01.327.742.1-038.000</div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="tdPartner">
                            <div class="pbkp">
                                <div class="partnerName" contenteditable="true">
                                    <?php
                                        $prtName = (isset($model->partner->parent) ? $model->partner->parent->name:$model->partner->name);
                                        $expPartnerName = explode(',',$prtName );
                                        if(is_array($expPartnerName) && isset($expPartnerName[1])){
                                            $partnerName = $expPartnerName[1].'.'.$expPartnerName[0];
                                        }else{
                                            $partnerName = $model->partner->name;
                                        }
                                        echo $partnerName;

                                    ?>
                                </div>
                                <div class="fontAddr partnerStreet" contenteditable="true">
                                    <span>
                                        <?= $model->partner->street; ?><?= '<br/>'.$model->partner->street2 ?> <?= $model->partner->city ?>, <?= (isset($model->partner->state->name) ? $model->partner->state->name:'').($model->partner->zip ? ' - '.$model->partner->zip:"") ?>
                                    </span>
                                </div>
                                <div>
                                    <span contenteditable="true"><?= ($model->partner->npwp ? $model->partner->npwp:'-'); ?></span>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <?php
                            $maxHeight = '103mm'; 
                            if($printer=='sri'){
                                $maxHeight = '105mm';
                            }
                        ?>
                        <td class="tdLines" style="height:<?=$maxHeight?>;vertical-align:top;">
                            <div class="contentArea">
                                <table class="contentLines" style="width:100%;margin-top:18mm;">
                                    
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="amount">
                                <div class="xxx">
                                    <table border="1px solid black">
                                        <tr>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                            <td style="width:18mm;" contenteditable="true">XXXXXX</td>
                                        </tr>
                                    </table>
                                </div>
                                    <?='<div style="float:left;width:auto;">'.$model->currency->name.'</div><div class="wid1">'.Yii::$app->numericLib->westStyle($total).'</div><div style="clear:both;"></div>';?>
                            </div>
                            <!-- <div style="height:11mm;">
                                <div>
                                    <?=$discount['desc']?>
                                </div>
                            </div> -->
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <div class="amount">
                                <table style="width:100%;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="width:61%;"><?='<div style="position:absolute;margin-left:-131px;">'.$discount['desc'].'</div><div style="width:auto;float:left;">'.($discount['amount'] != '' ? $model->currency->name:null).'</div><div class="wid1">'.($discount['amount'] != '' ? Yii::$app->numericLib->westStyle(-$discount['amount']):null).'</div>'?></td>
                                        <td style="text-align:right;">&nbsp;</td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>

                    <!-- EMPTY -->
                    <tr>
                        <td>
                            <div class="amount">
                                <table style="width:100%;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="width:61%;height:12px;"></td>
                                        <td style="text-align:right;"></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="amount">
                                <table style="width:100%;" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td style="width:61%;"><?='<div style="width:auto;float:left;">'.  $model->currency->name.'</div><div class="wid1">'.Yii::$app->numericLib->westStyle($model->amount_untaxed).'</div>'?></td>
                                        <td style="text-align:right;"><?=Yii::$app->numericLib->westStyle((round($model->amount_untaxed*$model->pajak)))?></td>
                                    </tr>
                                </table>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="amount" style="margin-top:-3px;">
                                <div style="width:auto;float:left;"><?= (isset($model->amount_tax) ? '<div style="float:left;width:auto;">'.$model->currency->name.'</div><div class="wid1">'.Yii::$app->numericLib->westStyle($model->amount_tax).'</div><div style="clear:both;"></div>':''); ?></div>
                                <div style="text-align:right;"><?=Yii::$app->numericLib->westStyle((round(($model->amount_untaxed*$model->pajak)*0.10)))?></div>
                                <div class="clear:both;"></div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="sign">
                                <div class="tgl">Jakarta <span style="margin-left:30%;"><?= Yii::$app->formatter->asDatetime($model->date_invoice, "php:d-m-Y"); ?></span></div>
                                <div class="signName"><?= strtoupper($model->approver0->partner->name); ?></div>
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <div class="rateInfo" style="margin-top:8px;">
                    <div>
                        <div style="width:37mm;float:left;margin-left:29mm;"><?=Yii::$app->numericLib->westStyle(floatval($model->pajak))?></div><div><?='1 '.$model->currency->name?></div>
                        <div style="clear:both;"></div>
                    </div>
                    <div>
                        <div style="float:left;margin-left:34mm;margin-top:3mm;"><?=$model->kmk?></div>
                        <div style="clear:both;"></div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>
</div>
<?php
$this->registerJs('
    var currPage = 1;
    var rateSymbol = "'.$model->currency->name.'";
    // save page template to var
    var tmpl = \'<div style="height:2mm;">&nbsp;</div>\'+jQuery(\'div#pageContainer\').html();
    var poNo = "'.$model->name.'";
    // add id to container
    jQuery(\'div.pages\').attr(\'id\',\'page\'+currPage);
    jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
    jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);
    

    // data to render
    //var lines = '.\yii\helpers\Json::encode($model->accountInvoiceLines).';
    var lines = '.\yii\helpers\Json::encode($lines).';
    var maxLinesHeight = jQuery(\'.tdLines:last\').height();
    

    var currRow = 0;

    console.log(maxLinesHeight);

    function prepareRow(rowNo,data)
    {
        return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:6%;\">"+data.no+"</td><td contenteditable=\"true\" style=\"width:56%;padding-right:10px;\">"+data.name+"</td><td><div style=\"float:left;width:13mm;\">"+rateSymbol+"</div><div style=\"width:106px;text-align:right;\">"+data.price_subtotal+"</div><div style=\"clear:both;\"></div></td><td>&nbsp;</td></tr>";
    }

    function prepareNoteRow(rowNo,data)
    {
        return "<tr class=\'cRows rows"+rowNo+"\'><td style=\"width:6%;\">&nbsp;</td><td contenteditable=\"true\" style=\"width:56%\">"+data.name+"</td><td><div style=\"float:left;width:13mm;\">&nbsp;</div><div>&nbsp;</div><div style=\"clear:both;\"></div></td><td>&nbsp;</td></tr>";
    }
    var rowPage = 0;
    jQuery.each(lines,function(key,line){
        var getRow = prepareRow(currRow,line);
        if(key==0)
        {
            jQuery(\'table#lines\'+currPage).html(getRow);
        }
        else
        {
            jQuery(\'table#lines\'+currPage+\' tr:last\').after(getRow);
        }
        rowPage = rowPage+1;

        var currLineHeight = jQuery(\'#tdLine\'+currPage).height();
        if(currLineHeight>maxLinesHeight){
            // remove last row
            jQuery(\'table#lines\'+currPage+\' tr:last\').remove();
            // add new page container
            jQuery(\'div#page\'+currPage).after(tmpl);
            currPage = currPage+1;
            console.log(currPage);
            // add id to new div
            jQuery(\'div.pages:last\').attr(\'id\',\'page\'+currPage);
            jQuery(\'table.contentLines:last\').attr(\'id\',\'lines\'+currPage);
            jQuery(\'table tr td.tdLines:last\').attr(\'id\',\'tdLine\'+currPage);

            jQuery(\'table#lines\'+currPage).html(getRow);
            currLineHeight = jQuery(\'#tdLine\'+currPage).height();
            // console.log(tmpl);
            
        }

        console.log(\'Rendering Page \'+currPage+\' Row \'+currRow+\' Height => \'+currLineHeight);
        currRow=currRow+1;
    });
    
    var noteRow = prepareNoteRow(currRow,{name:\'PO No : \'+poNo});
    jQuery(\'table#lines\'+currPage+\' tr:last\').after(noteRow);
    // end loop
');
?>