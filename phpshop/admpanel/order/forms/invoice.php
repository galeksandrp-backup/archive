<?php
$_classPath = "../../../";
include($_classPath . "class/obj.class.php");
PHPShopObj::loadClass("base");
PHPShopObj::loadClass("order");
PHPShopObj::loadClass("system");
PHPShopObj::loadClass("inwords");
PHPShopObj::loadClass("delivery");
PHPShopObj::loadClass("date");
PHPShopObj::loadClass("valuta");

$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
$PHPShopBase->chekAdmin();

$PHPShopSystem = new PHPShopSystem();
$LoadItems['System'] = $PHPShopSystem->getArray();

$PHPShopOrder = new PHPShopOrderFunction($_GET['orderID']);

// ���������� ���������
$SysValue['bank'] = $LoadBanc = unserialize($LoadItems['System']['bank']);

$sql = "select * from " . $SysValue['base']['table_name1'] . " where id=" . intval($_GET['orderID']);
$n = 1;
@$result = mysqli_query($link_db, $sql);
$row = mysqli_fetch_array(@$result);
$id = $row['id'];
$datas = $row['datas'];
$ouid = $row['uid'];
$order = unserialize($row['orders']);
$status = unserialize($row['status']);
$nds = $LoadItems['System']['nds'];
$dis = $this_nds_summa = $sum = $num = null;
foreach ($order['Cart']['cart'] as $val) {
    $this_price = ($PHPShopOrder->returnSumma(number_format($val['price'], "2", ".", ""), $order['Person']['discount']));
    $this_nds = number_format($this_price * $nds / (100 + $nds), "2", ".", "");
    $this_price_bez_nds = ($this_price - $this_nds) * $val['num'];
    $this_price_c_nds = number_format($this_price * $val['num'], "2", ".", "");
    $this_nds_summa+=$this_nds * $val['num'];

    $dis.="
  <tr>
    <td >" . $val['name'] . "</td>
    <td align=\"center\">796</td>
    <td align=\"center\">" . $val['ed_izm'] . "</td>
    <td align=\"right\">" . $val['num'] . "</td>
    <td align=\"right\">" . $this_price . "</td>
    <td align=\"right\">" . $this_price_bez_nds . "</td>
    <td align=\"right\">--</td>
    <td align=\"right\">" . $LoadItems['System']['nds'] . "%</td>
    <td align=\"right\">" . $this_nds * $val['num'] . "</td>
    <td align=\"right\">" . $this_price_c_nds . "</td>
    <td align=\"center\">---</td>
    <td align=\"center\">---</td>
    <td align=\"center\">---</td>
  </tr>
  ";

    $total_summa = $row['sum'];

//����������� � ������������ ����
    $goodid = $val['id'];
    $goodnum = $val['num'];
    $wsql = 'select weight from ' . $SysValue['base']['table_name2'] . ' where id=\'' . $goodid . '\'';
    $wresult = mysqli_query($link_db, $wsql);
    $wrow = mysqli_fetch_array($wresult);
    $cweight = $wrow['weight'] * $goodnum;
    if (!$cweight) {
        $zeroweight = 1;
    } //���� �� ������� ����� ������� ���!
    $weight+=$cweight;


    $sum+=$val['price'] * $val['num'];
    $num+=$val['num'];
    $n++;
}
//�������� ��� �������, ���� ���� �� ���� ����� ��� ��� ����
if ($zeroweight) {
    $weight = 0;
}


$PHPShopDelivery = new PHPShopDelivery($order['Person']['dostavka_metod']);
$PHPShopDelivery->checkMod($order['Cart']['dostavka']);
$deliveryPrice = $PHPShopDelivery->getPrice($sum, $weight);

$summa_nds_dos = number_format($deliveryPrice * $nds / (100 + $nds), "2", ".", "");

$dis.="
  <tr>
    <td >�������� " . $PHPShopDelivery->getCity() . "</td>
    <td align=\"right\">----</td>
    <td align=\"center\">----</td>
    <td align=\"right\">1</td>
    <td align=\"right\">" . $deliveryPrice . "</td>
    <td align=\"right\">" . $deliveryPrice . "</td>
    <td align=\"right\">--</td>
    <td align=\"right\">" . $LoadItems['System']['nds'] . "%</td>
    <td align=\"right\">" . $summa_nds_dos . "</td>
    <td align=\"right\">" . $deliveryPrice . "</td>
    <td align=\"center\">---</td>
    <td align=\"center\">---</td>
    <td align=\"center\">---</td>
  </tr>
  ";

if ($LoadItems['System']['nds_enabled']) {
    $nds = $LoadItems['System']['nds'];
    $nds = number_format($sum * ($nds / (100 + $nds)), "2", ".", "");
}
$sum = number_format($sum, "2", ".", "");

$name_person = $order['Person']['name_person'];

if ($row['org_name'] or $order['Person']['org_name'])
    $org_name = $order['Person']['org_name'] . $row['org_name'];
else
    $org_name = $row['fio'];

$datas = PHPShopDate::dataV($datas, "false");

// ����� �������� ��� ������ ������ ������ � ������
if (!empty($order['Person']['dos_ot']) OR !empty($order['Person']['dos_do']))
    $dost_ot = " ��: " . $order['Person']['dos_ot'] . ", ��: " . $order['Person']['dos_do'];

if(!empty($row['fio']))
    $user = $row['fio'];
else
    $user = $order['Person']['name_person'];

// ��������� ����� �������� � ������ ������� ������� ������ � �������
if ($row['org_name'])
    $adr_info .= ", " . $row['org_name'];
elseif ($row['fio'] OR $order['Person']['name_person'])
    $adr_info .= ", " . $user;
if ($row['country'])
    $adr_info .= ", ������: " . $row['country'];
if ($row['state'])
    $adr_info .= ", ������/����: " . $row['state'];
if ($row['city'])
    $adr_info .= ", �����: " . $row['city'];
if ($row['index'])
    $adr_info .= ", ������: " . $row['index'];
if ($row['street'] OR $order['Person']['adr_name'])
    $adr_info .= ", �����: " . $row['street'] . $order['Person']['adr_name'];
if ($row['house'])
    $adr_info .= ", ���: " . $row['house'];
if ($row['porch'])
    $adr_info .= ", �������: " . $row['porch'];
if ($row['door_phone'])
    $adr_info .= ", ��� ��������: " . $row['door_phone'];
if ($row['flat'])
    $adr_info .= ", ��������: " . $row['flat'];

$adr_info = substr($adr_info, 2);


// ������� ����� ��������� ����
$chek_num = substr(abs(crc32(uniqid(rand(), true))), 0, 5);
$LoadBanc = unserialize($LoadItems['System']['bank']);
?>
<!doctype html>
<head>
    <title>���� - ������� �<?php echo @$ouid ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link href="style.css" type=text/css rel=stylesheet>
    <script src="../../../lib/templates/print/js/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div align="right" class="nonprint">
        <button onclick="html2pdf(document.getElementById('content'), {margin: 1, filename: '����-������� �<?php echo $ouid ?>.pdf', html2canvas: {dpi: 192, letterRendering: true}, jsPDF: {orientation: 'landscape'}});">���������</button> 
        <button onclick="window.print();">�����������</button> 
        <hr>
    </div>
    <div id="content">
        <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
                <td valign="top" align="right">
                    <?php
                    $GetIsoValutaOrder = $PHPShopOrder->default_valuta_code;
                    if (preg_match("/���/", $GetIsoValutaOrder)) {
                        echo '
	<div>
���������� � 1<br>
� ������������� ������������� ���������� ���������<br>
�� 26 ������� 2011 �. � 1137 
 </div>
';
                    }
                    ?>
                </td>
            </tr>
            <tr>
                <td valign="top" id="d2">����-������� �<input title="��������" value="<?php echo @$ouid ?> �� <?php echo PHPShopDate::get($row['datas']) ?> �."> <br>
                    ����������� � --  �� --</td>
            </tr>
            <tr>
                <td valign="top" >��������: <?php echo $LoadItems['System']['company'] ?><br />					
                    �����: <?php echo $LoadBanc['org_adres'] ?>, <?php echo $LoadItems['System']['tel'] ?> <br />							
                    ����������������� ����� �������� (���) <?php echo $LoadBanc['org_inn'] ?>\<?php echo $LoadBanc['org_kpp'] ?> <br />							
                    ���������������� � ��� �����: �� ��	<br />						
                    ��������������� � ��� �����:  <?php echo @$adr_info ?>	<br />						
                    � ��������-���������� ���������       <br />							
                    ����������: <?php echo $org_name ?>	<br />						
                    �����:<?php echo @$adr_info ?> <br />							
                    ����������������� ����� ���������� (���) <?php echo @$order['Person']['org_inn'] . $row['org_inn'] ?>/ ��� <?php echo @$order['Person']['org_kpp'] . $row['org_kpp'] ?> <br />							
                </td>
            </tr>
            <tr>
                <td valign="top" >
                    <table style="margin-top:10px;" bordercolor="#000000"  border="1" cellspacing="0" cellpadding="0">




                        <tr>
                            <td width="200" align="center" rowspan="2">������������ ������ (�������� ����������� 
                                �����, ��������� �����), �������������� �����</td>
                            <td  align="center" colspan="2">������� ���������</td>
                            <td  align="center" rowspan="2">����-
                                ������ 
                                (�����)</td>
                            <td  align="center"  rowspan="2">���� (�����) �� ������� ���������</td>
                            <td  align="center"  rowspan="2">��������� ������� (�����, �����),
                                �������������
                                ���� ��� ������
                                �����</td>
                            <td  align="center" rowspan="2" >� ��� ����� ����� ������</td>
                            <td  align="center"  rowspan="2">��������� ������</td>
                            <td  align="center" rowspan="2" >����� ������, ������������� ����������</td>
                            <td  align="center"  rowspan="2">��������� ������� (�����, �����), ������������� ���� � ������� �����</td>
                            <td  align="center"  colspan="2">������<br>
                                ������������� ������</td>
                            <td  align="center"  rowspan="2">����� ���������� ����������</td>
                        </tr>
                        <tr>
                            <td align="center">���</td>
                            <td align="center">�������� �����������
                                (������������)</td>
                            <td align="center">�������� ���</td>
                            <td align="center">������� ������������</td>

                        </tr>
                        <tr>
                        <tr>
                            <td align="center">1</td>
                            <td align="center">2</td>
                            <td align="center">2�</td>
                            <td align="center">3</td>
                            <td align="center">4</td>
                            <td align="center">5</td>
                            <td align="center">6</td>
                            <td align="center">7</td>
                            <td align="center">8</td>
                            <td align="center">9</td>
                            <td align="center">10</td>
                            <td align="center">10a</td>
                            <td align="center">11</td>
                        </tr>
                        <?php echo $dis; ?>

                        <tr>
                            <td colspan="8"><b>����� � ������</b></td>

                            <td align="right"><?php echo $this_nds_summa + $summa_nds_dos; ?></td>
                            <td align="right"><?php echo $row['sum']; ?></td>
                            <td colspan="3">&nbsp;</td>

                        </tr>

                    </table>
                </td>
            </tr>
            <tr>
                <td valign="top" >&nbsp;</td>


            </tr>
            <tr>
                <td valign="top" >&nbsp;</td>


            </tr>
            <tr>
                <td valign="top" ><table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="50%">
                                <table  border="0" cellspacing="3" cellpadding="0">
                                    <tr>
                                        <td>������������ �����������<br>
                                            ��� ���� �������������� ����</td>
                                        <td><?php
                                            if (!empty($LoadBanc['org_sig']))
                                                echo '<img src="' . $LoadBanc['org_sig'] . '">';
                                            else
                                                echo '<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>';
                                            ?></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <?php
                                            if (!empty($LoadBanc['org_stamp']))
                                                echo '<img src="' . $LoadBanc['org_stamp'] . '">';
                                            else
                                                echo '<div style="padding:50px;border-bottom: 1px solid #000000;border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;" align="center">�.�.</div>';
                                            ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td width="50%" valign="top" align="right">
                                <table  border="0" cellspacing="3" cellpadding="0">
                                    <tr>
                                        <td>������� ���������<br>
                                            ��� ���� �������������� ����</td>
                                        <td><?php
                                            if (!empty($LoadBanc['org_sig_buh']))
                                                echo '<img src="' . $LoadBanc['org_sig_buh'] . '">';
                                            else
                                                echo '<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>';
                                            ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <!--
            <tr>
                <td valign="top" >
                    <p><br></p>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="70%">
                                <table  border="0" cellspacing="3" cellpadding="0">
                                    <tr>
                                        <td>�������������� ���������������</td>                                
                                        <td>____________________</td>
                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                        <td>____________________</td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td id="center">(�������)</td>
                                        <td></td>
                                        <td id="center" >(�.�.�.)</td>
                                    </tr>
                                </table>
                            </td>
                            <td width="10%"></td>
                            <td width="20%" valign="top" align="right">
                                <table  border="0" cellspacing="3" cellpadding="0">
                                    <tr>
                                        <td>______________________________________________</td>
                                    <tr>                             
                                        <td id="center">(��������� ������������� � ��������������� ����������� ��������������� ���������������)</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>-->
        </table>
    </div>
</body>
</html>