<!DOCTYPE html>
<html lang="zh">
<script src="https://cdn.staticfile.org/jquery/1.10.2/jquery.min.js">
</script>
<style>
    .login-center {
        width: 66%;
        display: block;
        margin: 0 auto;
        text-align: center;
    }
</style>
<?php dump($authuserinfo);?>
<script>
    var count = {{ $cart }}

    function product_remove(dog_id) {
        $(".prorem-" + dog_id).toggle();
        $.get("/delcart/" + dog_id);
        count--
        document.getElementById("cart-area").innerHTML = count;
        document.getElementById("cart-area1").innerHTML = count;
    }
    function select_cert(id){
        var aa = document.getElementById(id);
        document.getElementById("product-price").innerHTML = "￥"+aa.value;
    }

    function update_cart(id) {
        var str = document.getElementById("dog_cart").className;
        if (str.indexOf("active") != -1) {
            $.get("/delcart/" + id);
            count--
            document.getElementById("cart-area").innerHTML = count;
            document.getElementById("cart-area1").innerHTML = count;
        } else {
            $.get("/addcart/" + id);
            count++
            document.getElementById("cart-area").innerHTML = count;
            document.getElementById("cart-area1").innerHTML = count;
        }
    }

    function wxCodeStatus(qrcode) {
        $.ajax({
            url: '/whoscan/' + qrcode,
            success: function (res) {
                // obj=JSON.parse(res);
                document.cookie = "wx_login_token=" + res + ";path=/"
                document.getElementById("login-qrcode").innerHTML = "登录成功，正在跳转...";
                location.reload()
            },
            error: function (jqXHR, textStatus, errorThrown) {

                setTimeout("wxCodeStatus(" + qrcode + ")", 1000)
                /*弹出jqXHR对象的信息*/
                // alert(jqXHR.responseText);
                // alert(jqXHR.status);
                // alert(jqXHR.readyState);
                // alert(jqXHR.statusText);
                // /*弹出其他两个参数的信息*/
                // alert(textStatus);
                // alert(errorThrown);
            }
        });
    }
</script>
<script>
    $(document).ready(function () {
        $(".wechat_login").click(function () {
            $.get("/wx/loginqrcode", function (data, status) {
                $("#qrcode").attr("src", data.url);
                wxCodeStatus(data.code)
            });
        });

        $(".wechat_logout").click(function () {
            $.get("/logout", function (data, status) {
                location.reload()
            });
        });

        $(".get-cart-list").click(function () {
            $.get("/getcart", function (data, status) {
                // obj=JSON.parse(data);
                var cartlist = ''
                for (var i = 0; i < data.length; i++) {
                    cart = data[i]
                    var nowdate = new Date();
                    var birthdate = new Date(cart['good']['birth_at']);
                    var birth = Math.round((nowdate.getTime() - birthdate.getTime()) / (24 * 3600 * 1000))
                    cartlist = cartlist + '<div class="single-cart-item prorem-' + cart['dog_id'] + '"> <a href="#" class="product-image"> <img src="' + cart['good']['goodspic'] + '" class="cart-thumb" alt=""> <div class="cart-item-desc"> <span class="product-remove"><i class="product-remove fa fa-close" aria-hidden="true" onclick="product_remove(' + cart['dog_id'] + ')"></i></span> <h6>' + birth + '天大的' + cart['good']['goodsname'] + '</h6> <p class="color">品种：' + cart['good']['goodstype'] + '</p> <p class="color">颜色：' + cart['good']['color'] + '</p><p class="price">￥' + cart['good']['price'] / 100 + '</p> </div> </a> </div>'
                }
                document.getElementById("cart-list").innerHTML = cartlist
            });
        });
    });
</script>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Title  -->
    <title>小岛宠物</title>

    <!-- Favicon  -->
    <link rel="icon" href="/img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="/css/core-style.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>
<!-- ##### Header Area Start ##### -->
<header class="header_area">
    <div class="classy-nav-container breakpoint-off d-flex align-items-center justify-content-between">
        <!-- Classy Menu -->
        <nav class="classy-navbar" id="essenceNav">
            <!-- Logo -->
            <a class="nav-brand" href="/"><img src="/img/core-img/logo.png" alt=""></a>
            <!-- Navbar Toggler -->
            <div class="classy-navbar-toggler">
                <span class="navbarToggler"><span></span><span></span><span></span></span>
            </div>
            <!-- Menu -->
            <div class="classy-menu">
                <!-- close btn -->
                <div class="classycloseIcon">
                    <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                </div>
                <!-- Nav Start -->
                <div class="classynav">
                    <ul>
                        <li><a href="/goods">汪星人</a></li>
                        <li><a href="#">铲屎官学院</a>
                            <div class="megamenu">
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Women's Collection</li>
                                    <li><a href="shop.html">Dresses</a></li>
                                    <li><a href="shop.html">Blouses &amp; Shirts</a></li>
                                    <li><a href="shop.html">T-shirts</a></li>
                                    <li><a href="shop.html">Rompers</a></li>
                                    <li><a href="shop.html">Bras &amp; Panties</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Men's Collection</li>
                                    <li><a href="shop.html">T-Shirts</a></li>
                                    <li><a href="shop.html">Polo</a></li>
                                    <li><a href="shop.html">Shirts</a></li>
                                    <li><a href="shop.html">Jackets</a></li>
                                    <li><a href="shop.html">Trench</a></li>
                                </ul>
                                <ul class="single-mega cn-col-4">
                                    <li class="title">Kid's Collection</li>
                                    <li><a href="shop.html">Dresses</a></li>
                                    <li><a href="shop.html">Shirts</a></li>
                                    <li><a href="shop.html">T-shirts</a></li>
                                    <li><a href="shop.html">Jackets</a></li>
                                    <li><a href="shop.html">Trench</a></li>
                                </ul>
                                <div class="single-mega cn-col-4">
                                    <img src="/img/bg-img/bg-6.jpg" alt="">
                                </div>
                            </div>
                        </li>
                        <li><a href="about">关于我们</a></li>
                    </ul>
                </div>
                <!-- Nav End -->
            </div>
        </nav>

        <!-- Header Meta Data -->
        <div class="header-meta d-flex clearfix justify-content-end">

            <!-- User Login Info -->
            @if($is_login)
                <div class="classynav user-login-info " data-toggle="modal" data-target="">

                    <ul>
                        <li class="cn-dropdown-item pr12 megamenu-item"><a href="#">{{ $user['nickname'] }}</a>
                            <ul class="dropdown">
                                <li class="wechat_logout"><a href="#">退出</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- Cart Area -->
                <div class="cart-area get-cart-list">
                    <a href="#" id="essenceCartBtn"><img src="/img/core-img/heart.svg" alt="">
                        <span><div id="cart-area">{{ $cart }}</div></span></a>
                </div>
            @else
                <div class="user-login-info wechat_login" data-toggle="modal" data-target="#myModal">
                    <a href="#"><img src="/img/core-img/user.svg" alt=""></a>
                </div>
            @endif

        </div>

    </div>
</header>
<!-- ##### Header Area End ##### -->
<!-- 模态框（Modal） -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">
                    快捷登录
                </h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">
                    &times;
                </button>
            </div>
            <div class="modal-body">
                <div id="login-qrcode" class="login-center"><img scr="" id="qrcode" class="login-center"/></div>
                <div class="login-center">
                    微信扫描并关注即可登录
                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal -->
</div>
<!-- ##### Right Side Cart Area ##### -->
@if(isset($cart))
    <div class="cart-bg-overlay"></div>

    <div class="right-side-cart-area">

        <!-- Cart Button -->
        <div class="cart-button">
            <a href="#" id="rightSideCart"><img src="/img/core-img/heart.svg" alt=""> <span><div
                            id="cart-area1">{{ $cart }}</div></span></a>
        </div>

        <div class="cart-content d-flex">

            <!-- Cart List Area -->
            <div class="cart-list" id="cart-list">
                <!-- Single Cart Item -->

                <!-- Single Cart Item -->

            </div>

            <!-- Cart Summary
            <div class="cart-amount-summary">

                <h2>Summary</h2>
                <ul class="summary-table">
                    <li><span>subtotal:</span> <span>$274.00</span></li>
                    <li><span>delivery:</span> <span>Free</span></li>
                    <li><span>discount:</span> <span>-15%</span></li>
                    <li><span>total:</span> <span>$232.00</span></li>
                </ul>
                <div class="checkout-btn mt-100">
                    <a href="checkout.html" class="btn essence-btn">check out</a>
                </div>
            </div>
            -->
        </div>
    </div>
@endif
<!-- ##### Right Side Cart End ##### -->