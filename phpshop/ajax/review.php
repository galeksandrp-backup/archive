<?php

session_start();

$_classPath = "../";
include_once($_classPath . "class/obj.class.php");
include_once($_classPath . "inc/elements.inc.php");
include_once($_classPath . "class/mail.class.php");
include_once($_classPath . "core/users.core.php");
PHPShopObj::loadClass(['base', 'system', 'security', 'valuta', 'lang', 'security', 'product', 'parser', 'user']);

// ����������� � ��
$PHPShopBase = new PHPShopBase($_classPath . "inc/config.ini");
// �������, ������ ��� ���������� � ������ ������ �������.
$PHPShopSystem = new PHPShopSystem();
$PHPShopValutaArray = new PHPShopValutaArray();
$PHPShopNav = new PHPShopNav();
$PHPShopRecaptchaElement = new PHPShopRecaptchaElement();
$PHPShopLang = new PHPShopLang(['locale'=>$_SESSION['lang'],'path'=>'shop']);
if($PHPShopSystem->ifSerilizeParam('admoption.recaptcha_enabled')) {
    $PHPShopRecaptchaElement->recaptcha = true;
}
$ajaxReview = new AjaxReview();

try {
    $ajaxReview->write($_REQUEST['mail']);
    $_RESULT = [
        'message' => PHPShopString::win_utf8(__("�������! ��� ����������� ����� �������� ����� ����������� ���������.")),
        'success' => true
    ];
} catch (\Exception $exception) {
    $_RESULT = [
        'message'   => PHPShopString::win_utf8($exception->getMessage()),
        'success' => false
    ];
}

echo json_encode($_RESULT);

class AjaxReview
{
    public function write($email)
    {
        if($this->security()) {
            $PHPShopUsers = new PHPShopUsers();
            $userId = $PHPShopUsers->add_user_from_order($email);

            $_POST['name_new'] = PHPShopString::utf8_win1251(strip_tags($_POST['name_new']));
            $_POST['name_new'] = PHPShopSecurity::TotalClean($_POST['name_new'], 4);
            $message = PHPShopString::utf8_win1251(strip_tags($_REQUEST['message']));
            $message = PHPShopSecurity::TotalClean($message, 2);
            $myRate = abs(intval($_REQUEST['rate']));

            if (!$myRate)
                $myRate = 0;
            elseif ($myRate > 5)
                $myRate = 5;
            
            if (!empty($message)) {
                $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['comment']);
                $PHPShopOrm->insert([
                    'datas_new'     => time(),
                    'name_new'      => $_POST['name_new'],
                    'parent_id_new' => (int) $_REQUEST['productId'],
                    'content_new'   => $message,
                    'user_id_new'   => $userId,
                    'enabled_new'   => 0,
                    'rate_new'      => $myRate
                ]);

                // ��� ������
                $PHPShopProduct = new PHPShopProduct((int) $_REQUEST['productId']);
                $name = $PHPShopProduct->getName();

                // ������ ��������������
                $GLOBALS['SysValue']['other']['commentData'] = PHPShopDate::dataV(false, false);
                $GLOBALS['SysValue']['other']['commentUserName'] = $_POST['name_new'];
                $GLOBALS['SysValue']['other']['commentMessage'] = $message;
                $GLOBALS['SysValue']['other']['commentProdName'] = $name;

                // ���������� ������
                $message = PHPShopParser::file("../lib/templates/comment/mail.tpl", true);
                $system = new PHPShopSystem();
                $zag = __("�������� ����� � ������")." $name / " . $GLOBALS['SysValue']['other']['commentData'];

                $adminMail = $system->getValue('adminmail2');
                new PHPShopMail($adminMail, $adminMail, $zag, $message,false,false,['replyto' => $email]);
                //writeLangFile();
                $this->lead();
            }
        } else {
            throw new Exception(__("������ �����, ��������� ������� ����� �����"));
        }
    }
    
    /**
     * ���������� ����
     */
    private function lead() {
        
        $product = $this->getProductData((int) $_REQUEST['productId']);
        
        $PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['notes']);
        $content = "http://" . $_SERVER['SERVER_NAME'] . "/shop/UID_" . $product['id'] . ".html\n".PHPShopString::utf8_win1251($_POST['message']);
        $insert = array('date_new' => time(), 'message_new' => __('�����������').' '.PHPShopString::utf8_win1251($product['title']), 'name_new' => $_POST['name_new'], 'mail_new' => $_POST['mail'], 'tel_new' => '', 'content_new' => __('����������� � ������').' '.PHPShopSecurity::TotalClean($content));
        $PHPShopOrm->insert($insert);
    }

    public function getProductData($productId) {
        $product = new PHPShopProduct($productId);

        return [
            'id' => $productId,
            'link' => sprintf('/shop/UID_%s.html', $productId),
            'title' => PHPShopString::win_utf8($product->getName()),
            'image' => sprintf('<a href="/shop/UID_%s.html" title="%s">
                                   <img class="one-image-slider" src="%s" alt="%s" title="%s"/>
                                </a>', $productId, PHPShopString::win_utf8($product->getName()), $product->getImage(), PHPShopString::win_utf8($product->getName()), PHPShopString::win_utf8($product->getName()))
        ];
    }

    private function security() {
        global $PHPShopRecaptchaElement;

        return $PHPShopRecaptchaElement->security(['url' => false, 'captcha' => true, 'referer' => true]);
    }
}
?>