<!DOCTYPE html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
<HEAD>
<TITLE>@pageTitl@</TITLE>
<META http-equiv="Content-Type" content="text-html; charset=windows-1251">
<META name="description" content="@pageDesc@">
<META name="keywords" content="@pageKeyw@">
<META name="copyright" content="@pageReg@">
<META name="engine-copyright" content="PHPSHOP.RU, @pageProduct@">
<META name="domen-copyright" content="@pageDomen@">
<META content="General" name="rating">
<META name="ROBOTS" content="ALL">
<LINK rel="shortcut icon" href="favicon.ico" type="image/x-icon">
<LINK rel="icon" href="favicon.ico" type="image/x-icon">
<LINK href="@pageCss@" type="text/css" rel="stylesheet">
<SCRIPT language="JavaScript" type="text/javascript" src="java/phpshop.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript" src="phpshop/lib/Subsys/JsHttpRequest/Js.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript" src="@php echo $GLOBALS['SysValue']['dir']['templates'].chr(47).$_SESSION['skin'].chr(47); php@javascript/js.js"></SCRIPT>
<SCRIPT language="JavaScript" type="text/javascript" src="java/swfobject.js"></SCRIPT>
</HEAD>
<BODY onLoad="default_load('false','false');NavActive('index');LoadPath('@ShopDir@');"  class="bod">
<div class="black_overlay" id="fade"></div>
<div id="mainblock">
  <div id="top">
    <div id="top2">
      <div id="ico_basket"><a href="/order/" class="ordabs" ></a> � ����� ������� <span> <span id="num">@num@</span> ����� �� <span id="sum">@sum@</span>@productValutaName@.</span> <span id="order" style="display:@orderEnabled@; "><a href="/order/" >�������� �����?</a></span> </div>
      <div id="ico_compare"><a href="/compare/" class="ordabs" ></a> <span><a href="/compare/" title="�������� ������">�������� ������ (<span id="numcompare">@numcompare@</span> ��.)</a></span> </div>
      @usersDisp@ </div>
    <div id="top3">
      <div id="logo">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center" height="112"><a title="@name@" href="/"><img src="@logo@" alt="@name@"></a></td>
          </tr>
        </table>
      </div>
      <div id="curency">@valutaDisp@</div>
      <div class="topMenu">
        <div id="topmpad">
          <table align="right"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top"><div class="topMenuSpan" id="index" >
                  <div class="m_act1"></div>
                  <a href="/" title="�������">�������</a>
                  <div class="m_act2"></div>
                </div></td>
              @topMenu@ </tr>
          </table>
        </div>
      </div>
    </div>
    <div id="top_cat"> <span class="bb1">&nbsp;</span>
      <div class="bb2">
        <div id="catb" class="topCat">
          <table width="780" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td>@leftCatal@</td>
            </tr>
          </table>
        </div>
        <div id="searchb">
          <form method="post" name="forma_search" action="/search/" onSubmit="return SearchChek()">
            <input name="words" class="searchf" maxLength="30" value="�����..." onFocus="this.value=''">
          </form>
        </div>
      </div>
      <div class="bb3"></div>
    </div>
  </div>
  <div id="top_banner"> <span class="bb1">&nbsp;</span>
    <div class="bb22">
      <div id="banner"> @showcase@ </div>
    </div>
    <div class="bb3"> </div>
  </div>
  <div id="mid">
    <div id="mid1"> @skinSelect@
      <div class="leftCat">
        <div class="lb">
          <div class="lb1">&nbsp;</div>
          <div class="lb2" style="padding:15px 0px;">
            <!--
                     ������ ������ ���� ��������
                                -->
            @php
            $replace=array("podCatTiTOut"=>"TiTOut","podCatTiTOver"=>"TiTOver","divCatId"=>"divCatIdBot","onMouseOver"=>"onMouseOut");
            echo $GLOBALS['PHPShopShopCatalogElement']->leftCatal($replace);
            php@
            <script type="text/javascript">
                                    <!--
                                    catalogAktiv('divCatId@thisCat@');
                                    catalogAktiv('divCatIdBot@thisCat@');
                                    -->
                                </script>
          </div>
          <div class="lb3"></div>
        </div>
      </div>
      <div class="lb">
        <div class="lb1">&nbsp;</div>
        <div class="lb2" >
          <div style="padding:15px 0px 0px;">
            <div class="divNavigationA"><a href="/price/" title="�����-����">�����-����</a></div>
            <div class="divNavigationA"><a href="/news/" title="�������">�������</a></div>
            <div class="divNavigationA"><a href="/gbook/" title="������">������</a></div>
            <div class="divNavigationA"><a href="/links/" title="�������� ������">�������� ������</a></div>
            <div class="divNavigationA"><a href="/map/" title="����� �����">����� �����</a></div>
            <div class="divNavigationA"><a href="/forma/" title="����� �����">����� �����</a></div>
          </div>
        </div>
        <div class="lb3"></div>
      </div>
      <div class="lb">
        <div class="lb1">&nbsp;</div>
        <div class="lb2">
          <div style="padding:15px 0px 0px;" > @pageCatal@ </div>
        </div>
        <div class="lb3"></div>
      </div>
      @leftMenu@
      @calendar@
      @cloud@ </div>
    <div id="mid2">
      <div class="mb">
        <div class="mb1">&nbsp;</div>
        <div class="mb2">
          <script type="text/javascript" src="java/highslide/highslide-p.js"></script>
          <link rel="stylesheet" type="text/css" href="java/highslide/highslide.css"/>
          <script type="text/javascript">
                                hs.registerOverlay({html: '<div class="closebutton" onclick="return hs.close(this)" title="�������"></div>',position: 'top right',fade: 2});
                                hs.graphicsDir = 'java/highslide/graphics/';
                                hs.wrapperClassName = 'borderless';
                            </script>
          <div id="psrell">
            <h2>����������� �����������</h2>
            <a href="/spec/">��� �����������</a></div>
          <div style="overflow:hidden">@specMain@</div>
        </div>
        <div class="mb3"></div>
      </div>
      <div class="mb">
        <div class="mb1">&nbsp;</div>
        <div class="mb2">
          <h2>@mainContentTitle@</h2>
          <div id="maincont"> @mainContent@</div>
        </div>
        <div class="mb3"></div>
      </div>
      <div class="mb">
        <div class="mb1">&nbsp;</div>
        <div class="mb2">
          <h2>������ ��������</h2>
          <div style="overflow:hidden"> @nowBuy@</div>
        </div>
        <div class="mb3"></div>
      </div>
      @banersDisp@ </div>
    <div id="mid3">
      <div id="phone">
        <div id="ph1">@telNum@</div>
        <div id="mail3"><a href="mailto:@adminMail@">@adminMail@</a></div>
      </div>
      @oprosDisp@ @rightMenu@
      <div id="newsb">
        <div class="newsTitle">������� <a href="/rss/">RSS</a></div>
        @miniNews@</div>
    </div>
  </div>
</div>
<div style="clear:both"></div>
<div id="footer">
  <div id="footer2">
    <div class="foot3">&nbsp;</div>
    <div class="foot4">
      <div class="topMenu">
        <table align="center"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><div class="topMenuSpan" id="index" >
                <div class="m_act1"></div>
                <a href="/" title="�������">�������</a>
                <div class="m_act2"></div>
              </div></td>
            @topMenu@ </tr>
        </table>
      </div>
    </div>
  </div>
</div>
<div style="clear:both"></div>
<div id="cartwindow" style="position:absolute;left:0px;top:0px;bottom:0px;right:0px;visibility:hidden;">
  <table width="100%" height="100%">
    <tr>
      <td width="40" vAlign=center><img src="images/shop/i_commercemanager_med.gif" alt="" width="32" height="32" border="0" align="absmiddle"> </td>
      <td><b>��������...</b><br>
        ����� �������� � �������</td>
    </tr>
  </table>
</div>
<div id="comparewindow" style="position:absolute;left:0px;top:0px;bottom:0px;right:0px;visibility:hidden;">
  <table width="100%" height="100%">
    <tr>
      <td width="40" vAlign=center><img src="images/shop/i_compare_med.gif" alt="" width="32" height="32" border="0" align="absmiddle"> </td>
      <td><b>��������...</b><br>
        ����� �������� � ���������</td>
    </tr>
  </table>
</div>