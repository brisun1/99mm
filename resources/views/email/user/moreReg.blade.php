@component('mail::message')
# 谢谢注册

*{{$mname}}* 您好！<br>
    感谢你注册*99妹妹网*。<br>
    如果你要更改你上传的资料，请登录后在帐号管理的底部按修改按钮进行修改。<br>
    本网站允许用户6周的试用期，须要交费时我们会另行通知。<br>
    希望本网能给你带来更多的生意，增加你的收入。<br>
    如果你有任何问题或建议，请随时  

more
    @component('mail::button', ['url' => '99meimei/help'])
    联系我们
@endcomponent

<br>
{{ config('app.name') }}
@endcomponent