<?php


// ������ ����
function setLog($data=false,$nameHandler=false) {
    global $PHPShopGUI;
    $PHPShopOrm= new PHPShopOrm('phpshop_modules_admlog_log');

    // ��� ��������
    if(!$nameHandler) {
        if(!empty($_POST['editID'])) {
            if($_POST['actionList']['editID'] == 'actionInsert') $nameHandler = '��������';
            else $nameHandler = '��������������';
        }
        elseif(!empty($_REQUEST['delID'])) $nameHandler = '��������';
    } else $PHPShopGUI->title = '������ �������';

    // ���������
    $titleSearch=array('name_new','title_new','login_new','link_new','info_new');
    foreach($_POST as $key=>$val) {
        if(in_array($key, $titleSearch)) {
            $titleName = $_POST[$key];
            break;
        }
    }

    $log=array(
            'date_new'=>date('U'),
            'user_new'=>$_SESSION['logPHPSHOP'],
            'ip_new'=>$_SERVER['REMOTE_ADDR'],
            'file_new'=>$_SERVER["SCRIPT_NAME"],
            'title_new'=>$PHPShopGUI->title.' -> '.$nameHandler.' - > '.$titleName,
            'content_new'=>serialize($_REQUEST)
    );

    $PHPShopOrm->insert($log);
}


// ��������� �������� � �������
$addHandler=array(
        'actionStart'=>false,
        'actionDelete'=>'setLog',
        'actionUpdate'=>'setLog',
        'actionInsert'=>'setLog'
);
?>