<?php

function addYandexcartCPA($data) {
    global $PHPShopGUI;

    $PHPShopGUI->addJSFiles('../modules/yandexcart/admpanel/gui/yandexcart.gui.js');

    $Tab3 = $PHPShopGUI->setField("������ (Fee)", $PHPShopGUI->setInputText(null, 'fee_new', $data['fee'], 100), 1, '1% �������� ������������� �������� 100');

    $Tab3.=$PHPShopGUI->setField(__('CPA ������'), $PHPShopGUI->setRadio('cpa_new', 1, __('��������'), $data['cpa']) . $PHPShopGUI->setRadio('cpa_new', 2, __('���������'), $data['cpa'], false, 'text-muted'));

    $Tab3.=$PHPShopGUI->setField(__('�������� �������������'), $PHPShopGUI->setRadio('manufacturer_warranty_new', 1, __('��������'), $data['manufacturer_warranty']) . $PHPShopGUI->setRadio('manufacturer_warranty_new', 2, __('���������'), $data['manufacturer_warranty'], false, 'text-muted'), 1, '��� <manufacturer_warranty>');

    $Tab3.= $PHPShopGUI->setField("�����������", $PHPShopGUI->setInputText(null, 'sales_notes_new', $data['sales_notes'], 300), 1, '��� <sales_notes>');

    $Tab3.= $PHPShopGUI->setField("������ ������������", $PHPShopGUI->setInputText(null, 'country_of_origin_new', $data['country_of_origin'], 300), 1, '��� <country_of_origin>');

    $Tab3.=$PHPShopGUI->setField(__('����� ��� ��������'), $PHPShopGUI->setRadio('adult_new', 1, __('��������'), $data['adult']) . $PHPShopGUI->setRadio('adult_new', 2, __('���������'), $data['adult'], false, 'text-muted'), 1, '��� <adult>');

    $Tab3.=$PHPShopGUI->setField(__('���������� ��������'), $PHPShopGUI->setRadio('delivery_new', 1, __('��������'), $data['delivery']) . $PHPShopGUI->setRadio('delivery_new', 2, __('���������'), $data['delivery'], false, 'text-muted'), 1, '��� <delivery>');

    $Tab3.=$PHPShopGUI->setField(__('���������'), $PHPShopGUI->setRadio('pickup_new', 1, __('��������'), $data['pickup']) . $PHPShopGUI->setRadio('pickup_new', 2, __('���������'), $data['pickup'], false, 'text-muted'), 1, '��� <pickup>');

    $Tab3.=$PHPShopGUI->setField(__('������� � ��������� ��������'), $PHPShopGUI->setRadio('store_new', 1, __('��������'), $data['store']) . $PHPShopGUI->setRadio('store_new', 2, __('���������'), $data['store'], false, 'text-muted'), 1, '��� <store>');


    $PHPShopGUI->addTab(array("������.�����", $Tab3, true));
}

$addHandler = array(
    'actionStart' => 'addYandexcartCPA',
    'actionDelete' => false,
    'actionUpdate' => false
);
?>