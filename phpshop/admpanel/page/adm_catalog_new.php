<?php

PHPShopObj::loadClass("page");

$TitlePage = __('����� ��������� �������');
$PHPShopOrm = new PHPShopOrm($GLOBALS['SysValue']['base']['page_categories']);

// ���������� ������ ���������
function treegenerator($array, $i, $parent) {
    global $tree_array;
    $del = '&brvbar;&nbsp;&nbsp;&nbsp;&nbsp;';
    $tree = $tree_select = $check = false;
    $del = str_repeat($del, $i);
    if (!empty($array['sub']) and is_array($array['sub'])) {
        foreach ($array['sub'] as $k => $v) {

            $check = treegenerator(@$tree_array[$k], $i + 1, $k);

            if (!empty($_GET['cat']) and $k == $_GET['cat'])
                $selected = 'selected';
            else
                $selected = null;

            if (empty($check['select'])) {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
                $i = 1;
            } else {
                $tree_select.='<option value="' . $k . '" ' . $selected . '>' . $del . $v . '</option>';
            }

            $tree.='<tr class="treegrid-' . $k . ' treegrid-parent-' . $parent . ' data-tree">
		<td><a href="?path=page.catalog&id=' . $k . '">' . $v . '</a></td>
                    </tr>';

            $tree_select.=$check['select'];
            $tree.=$check['tree'];
        }
    }

    return array('select' => $tree_select, 'tree' => $tree);
}

/**
 * ����� �������� ���� ��������������
 */
function actionStart() {
    global $PHPShopGUI, $PHPShopModules, $TitlePage, $PHPShopSystem;

    // ������ �������� ����
    $PHPShopGUI->field_col = 2;
    $PHPShopGUI->addJSFiles('./js/jquery.treegrid.js', './js/bootstrap-datetimepicker.min.js','./page/gui/page.gui.js');

    // ��������� ������
    $data = array();
    $data['num'] = 1;
    $data = $PHPShopGUI->valid($data,'name','servers','menu','icon','title','description','keywords','content','parent_to');

    $PHPShopGUI->setActionPanel($TitlePage, false, array('������� � �������������', '��������� � �������'));

    // ������������
    $Tab_info = $PHPShopGUI->setField("��������", $PHPShopGUI->setInputArg(array('name' => 'name_new', 'type' => 'text.requared', 'value' => $data['name'])));


    $PHPShopCategoryArray = new PHPShopPageCategoryArray();
    $CategoryArray = $PHPShopCategoryArray->getArray();

    $CategoryArray[0]['name'] = '- ' . __('�������� �������') . ' -';
    $tree_array = array();

    $PHPShopCategoryArrayKey = $PHPShopCategoryArray->getKey('parent_to.id', true);
    if (is_array($PHPShopCategoryArrayKey))
        foreach ($PHPShopCategoryArrayKey as $k => $v) {
            foreach ($v as $cat) {
                $tree_array[$k]['sub'][$cat] = $CategoryArray[$cat]['name'];
            }
            $tree_array[$k]['name'] = @$CategoryArray[$k]['name'];
            $tree_array[$k]['id'] = $k;
            if (!empty($data['parent_to']) and $k == $data['parent_to'])
                $tree_array[$k]['selected'] = true;
        }

    $GLOBALS['tree_array'] = &$tree_array;
    $_GET['parent_to'] = $data['parent_to'];

    $tree_select = '<select class="selectpicker show-menu-arrow hidden-edit" data-container=""  data-style="btn btn-default btn-sm" name="parent_to_new" data-width="100%"><option value="0">' . $CategoryArray[0]['name'] . '</option>';
    $tree = '<table class="table table-hover">';
    if ($k == $data['parent_to'])
        $selected = 'selected';
    if (is_array($tree_array[0]['sub']))
        foreach ($tree_array[0]['sub'] as $k => $v) {
            $check = treegenerator(@$tree_array[$k], 1, $k);

            $tree.='<tr class="treegrid-' . $k . ' data-tree">
		<td><a href="?path=page.catalog&id=' . $k . '">' . $v . '</a></td>
                    </tr>';

            if ($k == $_GET['cat'])
                $selected = 'selected';
            else
                $selected = null;
            
            $tree_select.='<option value="' . $k . '"  ' . $selected . '>' . $v . '</option>';

            $tree_select.=$check['select'];
            $tree.=$check['tree'];
        }
    $tree_select.='</select>';
    $tree.='</table>
        <script>
    var cat="' . intval($_GET['cat']) . '";
    </script>';

    // ����� ��������
    //$Tab_info.= $PHPShopGUI->setField("����������", $tree_select);

    $Tab_info.=$PHPShopGUI->setField("���������", $PHPShopGUI->setInputText(false, 'num_new', $data['num'], '100'));
    
    $Tab_info.=$PHPShopGUI->setField("�������", $PHPShopGUI->loadLib('tab_multibase', $data, 'catalog/'));
    $Tab_info .= $PHPShopGUI->setField("����� ������", $PHPShopGUI->setCheckbox('menu_new', 1, '������� ����', $data['menu']));

    $Tab1 = $PHPShopGUI->setCollapse('����������', $Tab_info);
    
        // ������
    $Tab_icon = $PHPShopGUI->setField("�����������", $PHPShopGUI->setIcon($data['icon'], "icon_new", false));
    $Tab1 .= $PHPShopGUI->setCollapse('������', $Tab_icon);

    // SEO
    $Tab_seo = $PHPShopGUI->setField("Title", $PHPShopGUI->setTextarea("title_new", $data['title']));
    $Tab_seo .= $PHPShopGUI->setField("Description", $PHPShopGUI->setTextarea("description_new", $data['description']));
    $Tab_seo .= $PHPShopGUI->setField("Keywords", $PHPShopGUI->setTextarea("keywords_new", $data['keywords']));
    $Tab1 .= $PHPShopGUI->setCollapse('SEO / ����-������', $Tab_seo);

    // ��������
    $PHPShopGUI->setEditor($PHPShopSystem->getSerilizeParam("admoption.editor"));
    $editor = new Editor('content_new');
    $editor->Height = '550';
    $editor->ToolbarSet = 'Normal';
    $editor->Value = $data['content'];
    $Tab2 = $editor->AddGUI();

    // ������ ������ �� ��������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $data);

    // ����� ����� ��������
    $PHPShopGUI->setTab(array("��������", $Tab1), array("��������", $Tab2));

    // ����� �������
    $sidebarleft[] = array('title' => '���������', 'content' => $tree, 'title-icon' => '<span class="glyphicon glyphicon-plus addNewElement" data-toggle="tooltip" data-placement="top" title="' . __('�������� �������') . '"></span>');
    $PHPShopGUI->setSidebarLeft($sidebarleft, 3);
    $PHPShopGUI->sidebarLeftCell = 3;

    // ����� ������ ��������� � ����� � �����
    $ContentFooter = $PHPShopGUI->setInput("submit", "saveID", "��", "right", 70, "", "but", "actionInsert.page.create");

    // �����
    $PHPShopGUI->setFooter($ContentFooter);
    return true;
}

// ���������� ����������� 
function iconAdd() {
    global $PHPShopSystem;

    // ����� ����������
    $path = $GLOBALS['SysValue']['dir']['dir'] . '/UserFiles/Image/' . $PHPShopSystem->getSerilizeParam('admoption.image_result_path');

    // �������� �� ������������
    if (!empty($_FILES['file']['name'])) {
        $_FILES['file']['ext'] = PHPShopSecurity::getExt($_FILES['file']['name']);
        $_FILES['file']['name'] = PHPShopString::toLatin(str_replace('.' . $_FILES['file']['ext'], '', PHPShopString::utf8_win1251($_FILES['file']['name']))) . '.' . $_FILES['file']['ext'];
        if (in_array($_FILES['file']['ext'], array('gif', 'png', 'jpg', 'jpeg', 'svg'))) {
            if (move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'])) {
                $file = $GLOBALS['dir']['dir'] . $path . $_FILES['file']['name'];
            }
        }
    }

    // ������ ���� �� URL
    elseif (!empty($_POST['furl'])) {
        $file = $_POST['icon_new'];
    }

    // ������ ���� �� ��������� ���������
    elseif (!empty($_POST['icon_new'])) {
        $file = $_POST['icon_new'];
    }

    if (empty($file))
        $file = '';

    return $file;
}

/**
 * ����� ������
 * @return bool 
 */
function actionInsert() {
    global $PHPShopModules, $PHPShopOrm;

    // �������� ������
    $PHPShopModules->setAdmHandler(__FILE__, __FUNCTION__, $_POST);

    // ����������
    $_POST['servers_new'] = "";
    if (is_array($_POST['servers']))
        foreach ($_POST['servers'] as $v)
            if ($v != 'null' and !strstr($v, ','))
                $_POST['servers_new'].="i" . $v . "i";
            
    $_POST['icon_new'] = iconAdd();

    $action = $PHPShopOrm->insert($_POST);

    if ($_POST['saveID'] == '������� � �������������')
        header('Location: ?path=page.catalog&id=' . $action);
    else
        header('Location: ?path=page.catalog&cat=' . $_POST['category_new']);

    return $action;
}

// ��������� �������
$PHPShopGUI->getAction();

// ����� ����� ��� ������
$PHPShopGUI->setLoader($_POST['editID'], 'actionStart');
?>