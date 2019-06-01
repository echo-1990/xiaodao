@include('layout.header')



<!-- ##### Shop Grid Area Start ##### -->
<section class="shop_grid_area section-padding-80">
    <div class="container">
        <div class="row">
            <div class="col-12 col-md-4 col-lg-3">
                <!-- 侧边栏 -->
                <div class="shop_sidebar_area">

                    <!-- ##### 宠物品种 ##### -->
                    <div class="widget catagory mb-50">
                        <!-- Widget Title -->
                        <!-- h6 class="widget-title mb-30">品种：</h6>-->

                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#clothing">
                                    <a href="#">品种：</a>
                                    <ul class="sub-menu collapse show" id="">
                                        <li><a @if($type==100)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/100/{{ $minp }}/{{ $maxp }}">不限</a></li>
                                        <li><a @if($type==101)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/101/{{ $minp }}/{{ $maxp }}">柯基</a></li>
                                        <li><a @if($type==102)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/102/{{ $minp }}/{{ $maxp }}">法斗</a></li>
                                        <li><a @if($type==103)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/103/{{ $minp }}/{{ $maxp }}">柴犬</a></li>
                                        <li><a @if($type==104)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/104/{{ $minp }}/{{ $maxp }}">秋田</a></li>
                                        <li><a @if($type==105)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/105/{{ $minp }}/{{ $maxp }}">金毛</a></li>
                                        <li><a @if($type==106)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/106/{{ $minp }}/{{ $maxp }}">哈士奇</a></li>
                                        <li><a @if($type==107)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/107/{{ $minp }}/{{ $maxp }}">阿拉斯加</a></li>
                                        <li><a @if($type==108)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/108/{{ $minp }}/{{ $maxp }}">拉布拉多</a></li>
                                    </ul>
                                </li>
                             </ul>
                        </div>
                    </div>
                    <!-- ##### 价格区间 ##### -->
                    <div class="widget catagory mb-50">

                        <!--  Catagories  -->
                        <div class="catagories-menu">
                            <ul id="menu-content2" class="menu-content collapse show">
                                <!-- Single Item -->
                                <li data-toggle="collapse" data-target="#clothing">
                                    <a href="#">价格：</a>
                                    <ul class="sub-menu collapse show" id="">
                                        <li><a @if($minp==0 && $maxp==50000)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/{{ $type }}/0/50000">不限</a></li>
                                        <li><a @if($minp==0 && $maxp==5000)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/{{ $type }}/0/5000">5000元以内</a></li>
                                        <li><a @if($minp==5000 && $maxp==10000)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/{{ $type }}/5000/10000">5000-10000元</a></li>
                                        <li><a @if($minp==10000 && $maxp==15000)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/{{ $type }}/10000/15000">10000-15000元</a></li>
                                        <li><a @if($minp==15000 && $maxp==20000)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/{{ $type }}/15000/20000">15000-20000元</a></li>
                                        <li><a @if($minp==2 && $maxp==50000)style="color:#0315ff"@endif href="/goods/{{ $order }}/{{ $by }}/{{ $type }}/20000/50000">20000元以上</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>


                </div>
            </div>

            <div class="col-12 col-md-8 col-lg-9">
                <div class="shop_grid_product_area">
                    <!-- 查询与排序 -->
                    <div class="row">
                        <div class="col-12">
                            <div class="product-topbar d-flex align-items-center justify-content-between">
                                <!-- Total Products -->
                                <div class="total-products">
                                    <p>搜索到<span>{{ $goods->total() }}</span>只</p>
                                </div>
                                <!-- 排序 -->
                                <div class="product-sorting d-flex">
                                    <p>排序:</p>
                                    <form action="#" method="get" id="myform">
                                        {{ csrf_field() }}
                                        <select name="select" id="sortByselect" onchange="s_click(this);">
                                        <option value="/goods/price/asc/{{ $type }}/{{ $minp }}/{{ $maxp }}" @if($order=='price'&&$by=='asc')selected = "selected"@endif>价格↑</option>
                                        <option value="/goods/price/desc/{{ $type }}/{{ $minp }}/{{ $maxp }}" @if($order=='price'&&$by=='desc')selected = "selected"@endif>价格↓</option>
                                        <option value="/goods/birth_at/asc/{{ $type }}/{{ $minp }}/{{ $maxp }}" @if($order=='birth_at'&&$by=='asc')selected = "selected"@endif>生日↑</option>
                                        <option value="/goods/birth_at/desc/{{ $type }}/{{ $minp }}/{{ $maxp }}" @if($order=='birth_at'&&$by=='desc')selected = "selected"@endif>生日↓</option>
                                        </select>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 产品列表 -->
                    <div class="row">

                        <!-- Single Product -->
                        @foreach($goods as $good)
                        <div class="col-12 col-sm-6 col-lg-4">
                            <div class="single-product-wrapper">
                                <!-- Product Image -->
                                <div class="product-img">
                                    <a href="/doginfo/{{ $good->dog_id }}"><img src="{{ $good->pic->url }}" alt="" ></a>
                                    <!-- Product Badge -->
                                    @if($good->dog->sex==1)
                                        <div class="product-badge new-badge">
                                            <span>DD</span>
                                        </div>
                                    @else
                                        <div class="product-badge offer-badge">
                                            <span>MM</span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Description -->
                                <div class="product-description">
                                    <span>{{ $good->dog->province }}.{{ $good->dog->city }}.{{ $good->dog->area }}</span>
                                    <a href="/doginfo/{{ $good->dog_id }}">
                                        <h6><?php echo ceil((strtotime (date("y-m-d h:i:s"))-strtotime($good->dog->birth_at))/86400);?>天大的{{ $good->goodsname }}</h6>
                                    </a>
                                    <p class="product-price">￥{{ $good->price/100 }}</p>


                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- 分页 -->
                <nav aria-label="navigation">
                    <ul class="pagination mt-50 mb-70">
                        {{ $goods->links() }}
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</section>
<!-- ##### Shop Grid Area End ##### -->
<script>
    function submitForm(){
        var form = document.getElementById("myform");
        form.submit();
    }
    //select跳页
    function s_click(obj) {
        //alert(obj);
        var num = 0;
        for (var i = 0; i < obj.options.length; i++) {
            if (obj.options[i].selected == true) {
                num++;
            }
        }
        if (num == 1) {
            var url = obj.options[obj.selectedIndex].value;
            window.open(url,'_self');
        }
    }
</script>
@include('layout.footer')
