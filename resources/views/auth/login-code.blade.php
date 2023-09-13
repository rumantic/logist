{{--
@component('mail::message')
--}}
    # Добрый день!

    Ваш код подтверждения для входа на сайт {{ config('app.name') }}.


    Код: <b>{{$email_code}}</b>

    Если вы не входили, то игнорируйте это сообщение и смените пароль в личном кабинете.

{{--
    > **Time:** {{ $time->toCookieString() }}<br>
    > **IP Address:** {{ $ipAddress }}<br>
    > **Browser:** {{ $browser }}
--}}

    Хорошего дня,<br>{{ config('app.name') }}
{{--
@endcomponent
--}}
