<?php
/**
 * ������ ���������� ��������
 * @param array $data ������ ������
 * @return string 
 */
function tab_multibase($val,$size) {
    global $PHPShopGUI;
    
    $value=array();
    $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['servers']);
    $data = $PHPShopOrm->select(array('*'), array('enabled'=>"='1'"), array('order' => 'id'), array('limit' => 1000));
    
    if(empty($size))
    $size = 300;

    $data[1000] = array('host'=>'������� ����', 'id'=>1000);
    $server = preg_split('/i/', $val['servers'], -1, PREG_SPLIT_NO_EMPTY);
    if (is_array($data)) {
        foreach ($data as $row) {
            $sel=false;
            if (is_array($server))
                foreach ($server as $v) {
                    if ($row['id'] == $v)
                        $sel = "selected";
                }
            $value[] = array($row['host'], $row['id'], $sel);
        }
        return  $PHPShopGUI->setSelect('servers[]', $value, $size, true, false, false, '300', false,true);
    }
    else return $PHPShopGUI->setHelp('��� �������������� ������. <a href="?path=system.servers&action=new">������� �������</a>.');
    
}

?>