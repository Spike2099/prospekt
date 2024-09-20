@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
    @if ($level === 'error')
    # @lang('Whoops!')
    @else
    # Здравствуйте.
    @endif
@endif

{{-- Intro Lines --}}
{{-- @foreach ($introLines as $line) --}}
{{-- $line --}}
{{-- @endforeach --}}
Вы получаете это письмо, потому что сделал запрос на сброс пароля, для вашей учетной записи.

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
{{-- @foreach ($outroLines as $line) --}}
{{-- $line --}}
{{-- @endforeach --}}
Эта ссылка сброса пароля истекает за 30 минут. 
Если вы не запросили сброс пароля, никаких дальнейших действий не требуется.

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
<small>
С уважением,<br>
ООО «Проспект Транс»    
</small>
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
@lang(
    "Если у вас возникли проблемы с нажатием на кнопку \"Сбросить пароль\", скопируйте и вставьте URL-адрес ниже\n".
    'в ваш веб-браузер:',
    [
        'actionText' => $actionText,
    ]
) <span class="break-all">[{{ $displayableActionUrl }}]({{ $actionUrl }})</span>
@endslot
@endisset
@endcomponent
