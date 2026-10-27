<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends BaseResetPassword
{
    public function toMail($notifiable)
    {
        $url = $this->resetUrl($notifiable);

        return (new MailMessage)
            ->subject('Đặt lại mật khẩu tài khoản TPĐĐ Travel')
            ->greeting('Xin chào!')
            ->line('Chúng tôi nhận được yêu cầu đặt lại mật khẩu cho tài khoản TPĐĐ Travel của bạn.')
            ->line('Nhấn vào nút bên dưới để tạo mật khẩu mới.')
            ->action('Đặt lại mật khẩu', $url)
            ->line(
                'Liên kết đặt lại mật khẩu có hiệu lực trong '
                . config('auth.passwords.' . config('auth.defaults.passwords') . '.expire')
                . ' phút.'
            )
            ->line('Nếu bạn không yêu cầu đặt lại mật khẩu, hãy bỏ qua email này.')
            ->salutation('Trân trọng, TPĐĐ Travel');
    }
}