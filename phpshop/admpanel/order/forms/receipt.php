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

function DoZero($price) {
    if (empty($price))
        return 0;
    else
        return $price;
}

// ���������� ���������
$SysValue['bank'] = unserialize($LoadItems['System']['bank']);

$sql = "select * from " . $SysValue['base']['table_name1'] . " where id=" . intval($_GET['orderID']);
$n = 1;
@$result = mysqli_query($link_db, $sql);
$row = mysqli_fetch_array(@$result);
$ouid = $row['uid'];
$order = unserialize($row['orders']);
$dis = $sum = $num = null;
if (is_array($order['Cart']['cart']))
    foreach ($order['Cart']['cart'] as $val) {

        if (!empty($val['parent_uid']))
            $val['uid'] = $val['parent_uid'];

        if (!empty($val['uid']))
            $val['name'].= ' (' . $val['uid'] . ')';

        $dis.="
  <tr class=tablerow>
		<td class=tablerow>" . $n . "</td>
		<td class=tablerow>" . $val['name'] . "</td>
		<td align=right class=tablerow nowrap>" . $PHPShopOrder->returnSumma($val['price'], 0) . "</td>
		<td align=right class=tablerow>" . $val['num'] . "</td>
		<td class=tableright>" . $PHPShopOrder->returnSumma($val['price'] * $val['num'], 0) . "</td>
	</tr>
  ";

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

$dis.="
  <tr class=tablerow>
		<td class=tablerow>" . $n . "</td>
		<td class=tablerow>�������� - " . $PHPShopDelivery->getCity() . "</td>
        <td align=right class=tablerow nowrap>" . DoZero($deliveryPrice) . "</td>
		<td align=right class=tablerow>1</td>
		<td class=tableright>" . DoZero($deliveryPrice) . "</td>
	</tr>
  ";
if ($LoadItems['System']['nds_enabled']) {
    $nds = $LoadItems['System']['nds'];
    $nds = number_format($sum * $nds / (100 + $nds), "2", ".", "");
}
$sum = number_format($sum, "2", ".", "");

$PERSON = $order['Person'];
if ($PERSON['discount'] > 0) {
    $discount = $PERSON['discount'] . '%';
} else {
    $discount = ($PERSON['tip_disc'] == 1 ? $PERSON['discount_promo'] . '%' : $PERSON['discount_promo']);
}

// ����� ��������� ����
$chek_num = substr(abs(crc32(uniqid(rand(), true))), 0, 5);
$LoadBanc = unserialize($LoadItems['System']['bank']);
?>
<!doctype html>
<head>
    <title>�������� ��� � <?php echo @$chek_num ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
    <link href="style.css" type=text/css rel=stylesheet>
    <script src="../../../lib/templates/print/js/html2pdf.bundle.min.js"></script>
</head>
<body>
    <div align="right" class="nonprint">
        <button onclick="html2pdf(document.getElementById('content'), {margin: 1, filename: '�������� ��� �<?php echo $ouid ?>.pdf', html2canvas: {dpi: 192, letterRendering: true}});">���������</button> 
        <button onclick="window.print();">�����������</button> 
        <hr><br><br>
    </div>
    <div id="content">
        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
                <TR>
                    <TH scope=row align=middle width="50%" rowSpan=3><img src="<?php echo $PHPShopSystem->getLogo(); ?>" alt="" border="0" style="max-width: 200px;height: auto;"></TH>
                    <TD align=right>
                        <BLOCKQUOTE>
                            <P>�������� ��� <SPAN class=style4><?php echo @$chek_num ?> �� <?php echo PHPShopDate::dataV(date("U"), "update") ?></SPAN> </P></BLOCKQUOTE></TD></TR>
                <TR>
                    <TD align=right>
                        <BLOCKQUOTE>
                            <P><SPAN class=style4><?php echo $LoadBanc['org_adres'] ?>, ������� <?php echo $LoadItems['System']['tel'] ?> </SPAN></P></BLOCKQUOTE></TD></TR>
                <TR>
                    <TD align=right>
                        <BLOCKQUOTE>
                            <P class=style4>���������: <?php echo $LoadItems['System']['company'] ?></P></BLOCKQUOTE></TD></TR></TBODY></TABLE>



        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
                <TR>
                    <TH scope=row align=middle width="50%">
            <P class=style4>����������: <?php if(!empty($row['fio'])) echo $row['fio']; else echo @$order['Person']['name_person']; ?></P></TH>
            <TH scope=row align=middle><b>����� �<?php echo $ouid ?> </b></TH></TR></TBODY></TABLE>



        <TABLE cellSpacing=0 cellPadding=0 width="100%" border=0><TBODY>
                <TR>
                    <TH class=style2 scope=row align=left>
            <BLOCKQUOTE>
                <P class=style4>���������� ������������ � ������� ��� ������ �� ����� ��� ���������!</P></BLOCKQUOTE></TH></TR>
            <TR>
                <TH class=style4 scope=row align=left>
            <BLOCKQUOTE>
                <P>���������� �������������� ����� ��������������� �� ������� ��� � ������������ ������ ����� ������ ��� �� ��������.</P></BLOCKQUOTE></TH></TR></TBODY></TABLE>

        <p><br></p>
        <table width=99% cellpadding=2 cellspacing=0 align=center>
            <tr class=tablerow>
                <td class=tablerow>�</td>
                <td width=50% class=tablerow>������������</td>
                <td class=tablerow>����</td>
                <td class=tablerow>����������</td>
                <td class=tableright>��������� (<?php echo $PHPShopOrder->default_valuta_code; ?>)</td>
            </tr>
            <?php
            echo @$dis;
            $my_total = $row['sum'];
            $my_nds = number_format($my_total * $LoadItems['System']['nds'] / (100 + $LoadItems['System']['nds']), "2", ".", "");
            ?>
            <tr>
                <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">������: <?php echo $discount ?></td>
            </tr>
            <tr>
                <td colspan=5 align=right style="border-top: 1px solid #000000;border-left: 1px solid #000000;border-right: 1px solid #000000;">�����:
                    <?php
                    echo $my_total;
                    if ($LoadItems['System']['nds_enabled']) {
                        echo "� �.�. ���: " . $my_nds;
                    }
                    ?>

                </td>
            </tr>

            <tr><td colspan=6 style="border: 0px; border-top: 1px solid #000000;">&nbsp;</td></tr>
        </table>
        <p><b>����� ������������ <?php echo ($num + 1) ?>, �� ����� <?php echo ($PHPShopOrder->returnSumma($sum, $order['Person']['discount']) + $deliveryPrice) . " " . $PHPShopOrder->default_valuta_code; ?>
                <br />
                <?php
                $iw = new inwords;
                $s = $iw->get($PHPShopOrder->returnSumma($sum, $order['Person']['discount']) + $deliveryPrice);
                $v = $PHPShopOrder->default_valuta_code;
                if (preg_match("/���/i", $v))
                    echo $s;
                ?>
            </b></p><br>
        <table>
            <tr>
                <td><b>��������:</b></td>
                <td><?php
                    if (!empty($LoadBanc['org_sig']))
                        echo '<img src="' . $LoadBanc['org_sig'] . '">';
                    else
                        echo '<u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>';
                    ?></td>
                <td width="150"></td>
                <td >
                    ����������� ������������ ������� �������������� � �������������� ��������� ������ ������������. ��� ���������� ���������������� ���������� ������ ����������� ������������ �������������� � ��������. 
                </td>
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
    </div>
</body>
</html>