<?php

function setcell_div_hook($obj,$arg) {

    $div=null;
    $panel=array('panel_l','panel_r','panel_l','panel_r','panel_l');

    foreach($arg as $key=>$val) {
        if(!empty($val)) {
            $div.='<div class="'.$panel[$key].'">'.$key.'</div>';
        }
    }

    return $div;
}

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>
 * @param array $obj ������
 * @param array $arg ������ ������
 * @return string
 */
function setcell_hook($obj,$arg) {

    $li=null;
    $panel=array('panel_l','panel_r','panel_l','panel_r');

    foreach($arg as $key=>$val) {
        if(!empty($val)) {
            $li.='<li class="'.$panel[$key].'">'.$val.'</li>';
        }
    }

    return $li;
}

/**
 * ��������� ������� ������� ����� �������� c <td> �� <li>, ���������� ������ � <ul>
 * @return string
 */
function compile_hook($obj) {
    $ul='<ul>'.$obj->product_grid.'</ul>';
    $obj->product_grid=null;
    return $ul;
}

/**
 * ��������� ����� ������������� �������, ����� ������� = 3
 */
function odnotip_hook($obj,$row,$rout) {
    if($rout=='START') {
        $obj->odnotip_setka_num=3;
        //$obj->template_odnotip='main_product_forma_3';
        $obj->line=true;
    }
}

/**
 * ��������� ������ ������������ � �������� � <li> �� <div> + ��������
 */
function cid_category_hook($obj,$dataArray,$rout) {

    $dis=null;
    if($rout=='END') {
        if(is_array($dataArray))
            foreach($dataArray as $row) {
                $content=PHPShopText::a($obj->path.'/CID_'.$row['id'].'.html',$row['name']);
                $content.=PHPShopText::p($row['content']);
                $dis.=PHPShopText::div($content,$align="left",$style='float:left;padding:10px');
            }

        // ������������ ���������� ������ ���������
        $obj->set('catalogList',$dis);

        // C�������������� �������
        cid_category_add_spec_hook($obj,$dataArray);
    }
}

/**
 * ���������� � ������ ��������� ��������������� ������� � 3 ������, ����� 3
 */
function cid_category_add_spec_hook($obj,$row) {
    global $PHPShopProductIconElements;

    // ��������� ����� ��������
    if(is_array($row))
        foreach($row as $val)
            $cat[]=$val['id'];
    $rand=rand(0,count($cat)-1);

    // ���������� ������� ������ ���������������
    $PHPShopProductIconElements->template='main_product_forma_3';
    $spec=$PHPShopProductIconElements->specMainIcon(false,$cat[$rand],3,3,true);
    $spec=PHPShopText::div(PHPShopText::p($spec),$align="left",$style='float:none;padding:10px');

    // ��������� � ���������� ������ ��������� ����� ���������������
    $obj->set('catalogList',$spec,true);
}

function cid_product_sorttemplate_hook($obj,$row,$rout){
    if($rout == 'START'){
        $obj->sort_template = 'sorttemplatehook';
    }
}

/**
 * ������ ������ �������������
 * @param array $value ������ �������� $value[]=array('��� ����� 1',123,'selected');
 * @param int $n integer
 * @param string $title �������� ��������������
 * @param array $vendor ������ �������� ������������� ������
 * @return string 
 */
function sorttemplatehook($value, $n, $title, $vendor) {
    $disp = null;

    if (is_array($value)) {
        foreach ($value as $p) {
            if (is_array($vendor[$n])) {
                foreach ($vendor[$n] as $value) {

                    if ($value == $p[1])
                        $text = PHPShopText::b($p[0]);
                    else
                        $text = $p[0];

                    $disp.=PHPShopText::br() . PHPShopText::a('?v[' . $n . ']=' . $p[1], $text, $p[0], $color = false, $size = false, $target = false, $class = false);
                }
            }else {
                if ($vendor[$n] == $p[1])
                    $text = PHPShopText::b($p[0]);
                else
                    $text = $p[0];

                $disp.=PHPShopText::br() . PHPShopText::a('?v[' . $n . ']=' . $p[1], $text, $p[0], $color = false, $size = false, $target = false, $class = false);
            }
        }
    }
    return $disp;
}

$addHandler=array
        (
        'odnotip'=>'odnotip_hook',
        '#setCell'=>'setcell_div_hook',
        '#compile'=>'compile_hook',
        'CID_Category'=>'cid_category_add_spec_hook',
        '#CID_Product'=>'cid_product_sorttemplate_hook'

);

?>