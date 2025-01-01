{{-- @props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="https://laravel.com/img/notification-logo.png" class="logo" alt="Laravel Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr> --}}

@props(['url'])
<tr>
    <td class="header" align="center">
        <a href="{{ $url }}" style="display: inline-block; text-decoration: none;">
            <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png alt="Sinaka Hotel Logo" style="width: 100px; border-radius: 50%;">
            <h1 style=" text-align: center; color: white; font-family: Arial, sans-serif; margin: 0; font-size: 24px;">
                Sinaka Hotel
            </h1>
        </a>
    </td>
</tr>

