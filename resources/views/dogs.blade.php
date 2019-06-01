@include('layout.header')
<!-- ##### Single Product Details Area Start ##### -->
<section class="single_product_details_area d-flex align-items-center">

    <!-- Single Product Thumb -->
    <div class="single_product_thumb clearfix">
        <div class="product_thumbnail_slides owl-carousel">
            @foreach($dog->pic as $pic)
                @if($pic -> usetype == 1 && $pic->bodytype == 1)
                    <img src="{{ $pic->url }}" alt="">
                @elseif($pic -> usetype == 1 && $pic->bodytype !=1)
                    <img src="{{ $pic->url }}" alt="">
                @endif
            @endforeach
        </div>
    </div>

    <!-- Single Product Description -->
    <div class="single_product_desc clearfix">

        <a>
            <h2>{{ ceil((strtotime(date("y-m-d h:i:s")) - strtotime($dog->birth_at)) / 86400) }}
                天大的{{ $dog->good->goodsname }}</h2>
        </a>
        <span>宠物ID：{{ $dog->dog_id }}</span>
        <p class="product-desc">{{ $dog->good->content }}</p>
        <p class="product-price" id="product-price">￥{{ $dog->good->price/100 }}</p>
        <span>{{ $dog->province }}{{ $dog->city }} 至 {{ $address['city']}}</span>

        <!-- Form -->
        <form class="cart-form clearfix" method="post" action="/addorder">
            <!-- Select Box -->
            {{ csrf_field() }}
            @if($dog->level==1)
                <div class="select-box d-flex mt-50 mb-30">
                    {{ csrf_field() }}
                    <select name="select" id="productSize" class="mr-5" onchange="select_cert(this.id)">
                        <option value="{{ $dog->good->price/100 }}" class="selected">自办证书</option>
                        <option value="{{ $dog->good->price/100+800 }}">代办证书</option>
                    </select>
                </div>
        @endif
        <!-- Cart & Favourite Box -->
            <div class="cart-fav-box d-flex align-items-center">
                <!-- Cart -->
                @if($is_login)
                    <button type="submit" name="addtocart" value="{{ $dog->id }}" class="btn essence-btn ">立即购买</button>
                @else
                    <button type="button" name="addtocart" value="{{ $dog->id }}" class="btn essence-btn wechat_login" data-toggle="modal" data-target="#myModal">立即购买</button>
                @endif
                    <!-- Favourite -->
                <div class="product-favourite ml-4">
                    @if($is_login)
                        <a href="#" id="dog_cart" class="favme fa fa-heart @if(isset($dog_cart)) active @endif "
                           onclick="update_cart({{ $dog->id }})"></a>
                    @else
                        <a href="#" class="ffavme fa fa-heart user-login-info wechat_login" data-toggle="modal" data-target="#myModal"></a>
                    @endif
                </div>
            </div>
        </form>
    </div>
</section>

<!-- ##### Single Product Details Area End ##### -->
宠物详情：
<table class="table">
    <tbody>
    <tr score="row">
        <td>出生日期</td>
        <td>{{ $dog->birth_at }}</td>
    </tr>
    <tr>
        <td>品种</td>
        <td>{{ $dog->dog_type }}</td>
    </tr>
    <tr>
        <td>芯片</td>
        <td>{{ $dog->chip_id }}</td>
    </tr>
    <tr>
        <td>性别</td>
        <td>{{ $dog->sex }}</td>
    </tr>
    <tr>
        <td>毛色</td>
        <td>{{ $dog->color }}</td>
    </tr>
    <tr>
        <td>级别</td>
        <td>{{ $dog->level }}</td>
    </tr>
    <tr>
        <td>已知缺陷</td>
        <td>{{ $dog->defect }}</td>
    </tr>
    </tbody>
</table>
妈妈：{{ $dog->mother_id }}{{ $dog->mother->certificate_id }}{{ $dog->mother->name }}{{ $dog->mother->birth_at }}
爸爸：{{ $dog->father_id }}{{ $dog->father->certificate_id }}{{ $dog->father->name }}{{ $dog->father->birth_at }}
<br><br>疫苗：
@foreach($dog->vaccine as $vaccine)
    <br>
    时间：{{ $vaccine->created_at }}
    药物名：{{ $vaccine->medicinename }}
    code：{{ $vaccine->pcode }}
@endforeach

<br><br>驱虫：
@foreach($dog->uninsect as $uninsect)
    <br>
    时间：{{ $uninsect->created_at }}
    药物名：{{ $uninsect->medicinename }}
    类型：{{ $uninsect->type }}
@endforeach

<br><br>视频：<br>
@foreach($dog->video as $video)
    地址：{{ $video->url }}
@endforeach

<br><br>图片：
@foreach($dog->pic as $picl)
    <br>
    @if($picl -> usetype == 1)
        时间：{{ $picl->created_at }}
        地址：{{ $picl->url }}
    @endif
@endforeach

<br><br>体重：
@foreach($dog->weight as $weight)
    <br>
    时间：{{ $weight->created_at }}
    重量：{{ $weight->weight }}
@endforeach

<br><br>繁殖：
@foreach($dog->reproduction as $rpevent)
    <br>
    孕时间：{{ $rpevent->created_at }}
    孕描述：{{ $rpevent->content }}
    @foreach($dog->reproductionpic as $rpeventpic)
        @if($rpeventpic->event_id == $rpevent->id)
            url:{{ $rpeventpic->url }}
        @endif
    @endforeach
@endforeach


<br><br>Timeline：
@foreach($dog->event as $tineline)
    <br>
    时间：{{ $tineline->created_at }}
    用户：{{ $tineline->user_id }}
    事件：{{ $tineline->content }}
    @foreach($dog->eventpic as $eventpic)
        @if($eventpic->event_id==$tineline->id)
            url：{{ $eventpic->url }}
        @endif
    @endforeach
@endforeach
@include('layout.footer')
