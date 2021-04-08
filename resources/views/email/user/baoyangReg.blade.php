@component('mail::message')
# 谢谢注册
byany
*{{$mname}}* 您好！<br>
    感谢你注册*99妹妹网*。<br>
    如果你要更改你上传的资料，请登录后在帐号管理的底部按修改按钮进行修改。<br>
    <br>
    希望本网能给你带来更多的生意，增加你的收入。<br>
    如果你有任何问题或建议，请随时  


    @component('mail::button', ['url' => '127.0.0.1/help'])
    联系我们
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent