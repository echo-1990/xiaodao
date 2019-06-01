
<form method="post" action="saveorder">
    {{ csrf_field() }}
    <input type="hidden" name="certificate_type" value="
    @if($price == ($goods->price/100))
                0
    @else
                1
    @endif">
    <input type="hidden" name="openid" value="{{ $user['openid'] }}">
    <input type="hidden" name="dog_id" value="{{ $dog_id }}">
    <input type="text" name="province" value="@if(isset($address->province)){{ $address->province }}@endif">
    <input type="text" name="city" value="@if(isset($address->city)){{ $address->city }}@endif">
    <input type="text" name="area" value="@if(isset($address->area)){{ $address->area }}@endif">
    <input type="text" name="addressinfo" value="@if(isset($address->addressinfo)){{ $address->addressinfo }}@endif">
    <input type="text" name="phone" value="@if(isset($address->phone)){{ $address->phone }}@endif">

    <button type="submit">提交</button>
</form>

