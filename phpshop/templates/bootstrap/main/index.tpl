<!DOCTYPE html>
<html lang="@lang@">
    <head>
        <meta charset="@charset@">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@pageTitl@</title>
        <meta name="description" content="@pageDesc@">
        <meta name="keywords" content="@pageKeyw@">
        <meta name="copyright" content="@pageReg@">
        <link rel="apple-touch-icon" href="@icon@">
        <link rel="icon" href="@icon@" type="image/x-icon">
        <link rel="mask-icon" href="@icon@" >

        <!-- OpenGraph -->
        <meta property="og:title" content="@ogTitle@">
        <meta property="og:image" content="http://@serverName@@ogImage@">
        <meta property="og:url" content="http://@ogUrl@">
        <meta property="og:type" content="website">
        <meta property="og:description" content="@ogDescription@">

        <!-- Preload -->
        <link rel="preload" href="@pathTemplate@css/@bootstrap_theme@.css" as="style">
        <link rel="preload" href="@pathTemplateMin@/style.css" as="style">
        <link rel="preload" href="@pathTemplate@css/font-awesome.min.css"  as="font" type="font/woff2" crossorigin>
        <link rel="preload" href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap&subset=cyrillic,cyrillic-ext"  as="font" type="font/woff2" crossorigin>

        <!-- Bootstrap -->
        <link id="bootstrap_theme" data-name="@php echo $_SESSION['skin']; php@" href="@pathTemplateMin@css/@bootstrap_theme@.css" rel="stylesheet">

    <body id="body" data-dir="@ShopDir@" data-path="@php echo $GLOBALS['PHPShopNav']->objNav['path']; php@" data-id="@php echo $GLOBALS['PHPShopNav']->objNav['id']; php@" data-token="@dadataToken@">

        <!-- Template -->
        <link href="//fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap&subset=cyrillic,cyrillic-ext" rel="stylesheet">
        <link href="@pathTemplateMin@/style.css" type="text/css" rel="stylesheet">


        <!-- Header -->
        <header class="container ">
            <!-- ������-������� -->
            <div class="@php __hide('sticker_top'); php@">
                <div class="top-banner @php __hide('sticker_close','cookie'); php@">
                    <div class="sticker-text">@sticker_top@</div>
                    <span class="close sticker-close">x</span>
                </div>
            </div>
            <!-- /������-������� -->
            <div class="row">
                <div class="col-md-12 hidden-xs">
                    <ul class="nav nav-pills pull-right">
                        @usersDisp@
                        <li class="@hideSite@" role="presentation">@wishlist@</li>
                        <li class="@hideSite@" role="presentation"><a href="/compare/"><span class="glyphicon glyphicon-eye-open"></span> {��������} (<span id="numcompare">@numcompare@</span>)</a></li>
                    </ul>
                </div>
            </div>

            <div class="row vertical-align">
                <div class="col-md-3 col-sm-3 col-xs-12 text-center @php __hide('logo'); php@">
                    <div class="logo">
                        <a href="/"><img src="@logo@" alt=""></a>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12 col-sm-9">
                    <div class="row">
                        <div class="col-md-7 col-sm-5  col-xs-12"><div class="header-tel"><a class="header-phone" href="tel:@telNumMobile@"> @telNumMobile@</a> <br> <a class="header-phone" href="tel:@telNum2@"> @telNum2@</a> </div> @returncall@</div>
                        <div class="col-md-5 col-sm-7  hidden-xs"><form action="/search/" role="search" method="get">
                                <div class="input-group">
                                    <input name="words" maxlength="50" id="search" class="form-control" placeholder="{������}.." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!--<div class="col-md-3">@valutaDisp@</div>-->
                    </div>    
                </div>
                <div class="visible-xs col-xs-12 text-center">@sticker_social@</div>
            </div>
        </header>
        <!--/ Header -->

        <!-- Fixed navbar -->
        <nav class="navbar navbar-default" id="navigation">
            <div class="container">
                <div class="navbar-header">

                    <form action="/search/" role="search" method="get" class="visible-xs col-xs-9 mobile-search">
                        <div class="input-group">
                            <input name="words" maxlength="50" id="search-mobile" class="form-control" placeholder="{������}.." required="" type="search" data-trigger="manual" data-container="body" data-toggle="popover" data-placement="bottom" data-html="true"  data-content="">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </form>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div id="navbar" class="navbar-collapse collapse">
                    <div class=" header-menu-wrapper col-md-9 col-sm-9">
                        <div class="row">
                            <ul class="nav navbar-nav main-navbar-top">
                                <li class="active visible-lg"><a href="/" title="�����"><span class="glyphicon glyphicon-home"></span></a></li>

                                <!-- dropdown catalog menu -->
                                <li class="@hideSite@">
                                    <div class="solid-menus">
                                        <nav class="navbar no-margin">
                                            <div id="navbar-inner-container">
                                                <div class="collapse navbar-collapse" id="solidMenu">

                                                    <ul class="nav navbar-nav">
                                                        <li class="dropdown">
                                                            <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" data-title="{�������}">{�������} <i class="icon-caret-down m-marker"></i></a>
                                                            <ul class="dropdown-menu ">
                                                                @leftCatal@


                                                            </ul>
                                                        </li>
                                                        <!-- dropdown brand menu mobile-->
                                                        <li class="dropdown visible-xs">
                                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{������} <span class="caret"></span></a>
                                                            <ul class="dropdown-menu" role="menu">
                                                                @brandsListMobile@
                                                            </ul>
                                                        </li>
                                                        <li class="visible-xs"><a href="/users/wishlist.html">{���������� ������}</a></li>
                                                        <li class="visible-xs"><a href="/price/">{�����-����}</a></li>
                                                    </ul> 
                                                </div>
                                            </div>
                                        </nav>
                                    </div>
                                </li>
                                <li class="visible-xs "> 
                                    <ul class="mobile-menu @hideSite@">
                                        @leftCatal@
                                    </ul>
                                </li>
                                @topBrands@
                                @topcatMenu@
                                @topMenu@


                                <li class="visible-xs"><a href="/news/">{�������}</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-3 @hideCatalog@">
                        <ul class="nav navbar-nav navbar-right visible-lg visible-md visible-sm" id="cart">

                            <li><a id="cartlink" data-trigger="hover" data-container="#cart" data-toggle="popover" data-placement="bottom" data-html="true" data-url="/order/" data-content='@visualcart@' href="/order/"><span class="glyphicon glyphicon-shopping-cart"></span> <span class="visible-lg-inline">{�������} <span id="num" class="label label-info">@num@</span> {��} </span><span id="sum" class="label label-info">@sum@</span> <span class="rubznak">@productValutaName@</span></a>
                                <div id="visualcart_tmp" class="hide">@visualcart@</div>
                            </li>
                        </ul>
                    </div>
                </div><!--/.nav-collapse -->
            </div>
        </nav>
        <!-- VisualCart Mod -->



        <!-- Notification -->
        <div id="notification" class="success-notification" style="display:none">
            <div  class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                <span class="notification-alert"> </span>
            </div>
        </div>
        <!--/ Notification -->

        <div class="container">

            <div class="row">
                <div class="clearfix"></div>

                <div class="col-md-3 sidebar col-xs-3 visible-lg visible-md">

                    <!-- jQuery -->
                    <script src="@pathTemplate@/js/jquery-1.11.0.min.js"></script>

                    <ul class="list-group sidebar-nav hidden-xs hidden-sm @hideSite@">
                        @leftCatal@
                    </ul>

                    <!-- ProductDay Mod -->
                    @productDay@
                    <!--/ ProductDay Mod -->
                    <div class="list-group left-block hidden-xs @php __hide('pageCatal'); php@"> 
                        <span class="list-group-item active">{���������}</span>
                        <ul class="left-block-list">
                            @pageCatal@
                        </ul>
                    </div>

                    @leftMenu@
                    <div class="visible-lg visible-md text-center banner">@banersDisp@</div>


                </div>                

                <div class="col-md-9 col-xs-12 main"> 


                    <div class="bar-padding-top-fix visible-md"></div>
                    <!-- Slider Section Starts -->
                    <!-- Nested Container Starts -->
                    <!-- Carousel Starts -->
                    @imageSlider@
                    <!-- Slider Section Ends -->

                    @sortselection@

                    <div class="page-header">
                        <h1>@mainContentTitle@</h1>
                    </div>
                    <div >@mainContent@</div>

                    <div class="page-header  @php __hide('specMain'); php@ @hideSite@">
                        <span class="pull-right hidden-xs"><a href="/spec/" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-bell"></span> {���������������}</a> <a href="/newtip/" class="btn btn-default btn-sm"><span class="glyphicon glyphicon-bullhorn"></span> {�������}</a> <a href="/newprice/" class="btn btn-default btn-sm @hideCatalog@"><span class="glyphicon glyphicon-certificate"></span> {����������}</a></span>
                        <h2>{���������������}</h2>
                    </div>
                    <div class="visible-xs visible-sm @hideSite@"> </div>
                    <div class="row @hideSite@">@specMain@</div>

                    <div class="catalog-block @hideSite@">@leftCatalTable@</div>

                </div>
            </div>

            <!-- toTop -->
            <div class="visible-lg visible-md">
                <a href="#" id="toTop"><span id="toTopHover"></span>{������}</a>
            </div>
            <!--/ toTop -->
            <div class="banner">@banersDispHorizontal@</div>

            @editor@

            <footer class="footer well ">
                <div class="row">

                    <!-- My Account Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12" itemscope itemtype="http://schema.org/Organization">

                        <h4>
                            <!-- ���������� ���� -->
                            <ul class="social-menu list-inline">
                                <li class="list-inline-item @php __hide('vk'); php@"><a class="social-button header-top-link" title="���������" href="@vk@" target="_blank"><em class="fa fa-vk" aria-hidden="true">.</em></a></li>
                                <li class="list-inline-item @php __hide('telegram'); php@"><a class="social-button header-top-link" title="Telegram" href="@telegram@" target="_blank"> <em class="fa fa-telegram" aria-hidden="true">.</em></a></li>
                                <li class="list-inline-item @php __hide('odnoklassniki'); php@"><a class="social-button header-top-link" title="�������������" href="@odnoklassniki@" target="_blank"> <em class="fa fa-odnoklassniki" aria-hidden="true">.</em></a></li>
                                <li class="list-inline-item @php __hide('youtube'); php@"><a class="social-button header-top-link" title="Youtube" href="@youtube@" target="_blank"><em class="fa fa-youtube" aria-hidden="true">.</em></a></li>
                                <li class="list-inline-item  @php __hide('whatsapp'); php@"><a class="social-button header-top-link" title="WhatsApp" href="@whatsapp@" target="_blank"><em class="fa fa-whatsapp" aria-hidden="true">.</em></a></li>
                            </ul>
                            <!-- / ���������� ���� -->
                        </h4>

                        <h5>&copy; <span itemprop="name">@company@</span>, @year@</h5>
                        <ul>
                            <li><i class="fa fa-envelope" aria-hidden="true"></i> <span itemprop="email">@adminMail@</span></li>
                            <li><i class="fa fa-phone" aria-hidden="true"></i> <span itemprop="telephone">@telNum@</span></li>
                            <li itemprop="telephone">@telNum2@</li>
                            <li>@workingTime@</li>
                            <li itemprop="address" itemscope itemtype="http://schema.org/PostalAddress"> <span itemprop="streetAddress">@streetAddress@</span></li>
                            <li>@button@</li>
                        </ul>
                    </div>

                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{������ �������}</h5>
                        <ul>
                            <li><a href="/users/">@UsersLogin@</a></li>
                            <li class="@hideCatalog@"><a href="/users/order.html">{��������� �����}</a></li>
                            <li class="@hideCatalog@"><a href="/users/notice.html">{����������� � �������}</a></li>
                            @php if($_SESSION['UsersId']) echo '<li><a href="/users/message.html">{����� � �����������}</a></li>
                            <li><a href="?logout=true">{�����}</a></li>'; else echo '<li><a href="#" data-toggle="modal" data-target="#userModal">{�����}</a></li>'; php@
                        </ul>
                    </div>
                    <!-- My Account Links Ends -->
                    <!-- Customer Service Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{���������}</h5>
                        <ul>
                            <li class="@hideCatalog@"><a href="/price/" title="{�����-����}">{�����-����}</a></li>
                            <li><a href="/news/" title="{�������}">{�������}</a></li>
                            <li><a href="/gbook/" title="{������}">{������}</a></li>
                            <li class="@hideSite@"><a href="/map/" title="{����� �����}">{����� �����}</a></li>
                            <li><a href="/forma/" title="{����� �����}">{����� �����}</a></li>
                        </ul>
                    </div>
                    <!-- Customer Service Links Ends -->
                    <!-- Information Links Starts -->
                    <div class="col-md-3 col-sm-4 col-xs-12">
                        <h5>{����������}</h5>
                        <ul>
                            @bottomMenu@

                        </ul>
                    </div>
                    <!-- Information Links Ends -->

                </div>

            </footer>
        </div>

        <!-- ��������� ���� ���������� ������ -->
        <div class="modal fade bs-example-modal-sm" id="searchModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{�����}</h4>
                    </div>
                    <div class="modal-body">
                        <form  action="/search/" role="search" method="get">
                            <div class="input-group">
                                <input name="words" maxlength="50" class="form-control" placeholder="{������..}" required="" type="search">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                                </span>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� ���������� ������ -->

        <!-- ��������� ���� �����������-->
        <div class="modal fade bs-example-modal-sm" id="userModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm auto-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title">{�����������}</h4>
                        <span id="usersError" class="hide">@usersError@</span>
                    </div>
                    <form method="post" name="user_forma">
                        <div class="modal-body">
                            <div class="form-group">

                                <input type="email" name="login" class="form-control" placeholder="Email" required="" value="@UserLogin@">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                                <br>

                                <input type="password" name="password" class="form-control" placeholder="{������}" required="" value="@UserPassword@">
                                <span class="glyphicon glyphicon-remove form-control-feedback hide" aria-hidden="true"></span>
                            </div>
                            <div class="flex-row">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" value="1" name="safe_users" @UserChecked@> {���������}
                                    </label>
                                </div>
                                <a href="/users/sms.html" class="pass @sms_login_enabled@">SMS</a>
                                <a href="/users/sendpassword.html" class="pass">{������ ������}</a>
                            </div>
                        </div>
                        <div class="modal-footer flex-row">

                            <input type="hidden" value="1" name="user_enter">
                            <button type="submit" class="btn btn-primary">{�����}</button>
                            <a href="/users/register.html" >{������������������}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!--/ ��������� ���� �����������-->


        <!-- Fixed mobile bar -->
        <div class="bar-padding-fix visible-xs"></div>
        <nav class="navbar navbar-default navbar-fixed-bottom bar bar-tab visible-xs">

            <a class="tab-item @user_active@" @user_link@ data-target="#userModal">
                <span class="glyphicon glyphicon-user"></span>
                <span class="tab-label">{�������}</span>
            </a>
            <a class="tab-item @cart_active@ @hideCatalog@" href="/order/" id="bar-cart">
                <span class="glyphicon glyphicon-shopping-cart"></span> <span class="badge badge-positive" id="mobilnum">@cart_active_num@</span>
                <span class="tab-label">{�������}</span>
            </a>
            <a class="tab-item @hideSite@" href="/users/wishlist.html" >
                <span class="glyphicon glyphicon-bookmark"></span>
                <span class="tab-label">{����������}</span>
            </a>
            <a class="tab-item @hideSite@" href="/compare/" >
                <span class="glyphicon glyphicon-eye-open"></span>
                <span class="tab-label">{��������}</span>
            </a>
        </nav>
        <!--/ Fixed mobile bar -->

        <!-- �������� �� ������������� cookie  -->
        <div class="cookie-message hide"><p></p><a href="#" class="btn btn-default btn-sm">Ok</a></div>

        <link rel="stylesheet" href="@pathTemplate@css/font-awesome.min.css"> 
        <link rel="stylesheet" href="@pathTemplate@css/solid-menu.css"> 
        <link href="@pathTemplateMin@css/menu.css" rel="stylesheet">
        <script src="@pathTemplate@/js/jquery.maskedinput.min.js"></script>
        <link href="@pathTemplate@css/bootstrap-select.min.css" rel="stylesheet"> 
        <link href="@pathTemplate@css/suggestions.min.css" rel="stylesheet">
        <link href="@pathTemplateMin@css/bar.css" rel="stylesheet">
        <script src="@pathTemplate@/js/bootstrap.min.js"></script>
        <script src="@pathTemplate@/js/bootstrap-select.min.js"></script>
        <script src="@pathTemplate@/js/jquery.lazyloadxt.min.js"></script>
        <script src="@pathTemplate@/js/phpshop.js"></script>
        <script src="@pathMin@java/jqfunc.js"></script>
        <script src="phpshop/locale/@php echo $_SESSION['lang']; php@/template.js"></script>
        <script src="@pathTemplate@/js/flipclock.min.js"></script>
        <script src="@pathTemplate@/js/jquery.cookie.js"></script>
        <script src="@pathTemplate@/js/jquery.waypoints.min.js"></script>
        <script src="@pathTemplate@/js/jquery.suggestions.min.js"></script>
        <script src="@pathTemplate@/js/solid-menu.js"></script> 
        @visualcart_lib@
        <div class="visible-lg visible-md">

