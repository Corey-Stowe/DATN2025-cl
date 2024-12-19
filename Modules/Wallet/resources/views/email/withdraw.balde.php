<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yêu cầu rút tiền đã được thực hiện</title>
</head>
<body style="margin: 0; padding: 0; font-family: Arial, sans-serif; font-size: 16px; line-height: 1.6; color: #333333; background-color: #f4f4f4;">
    <table cellpadding="0" cellspacing="0" style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #ffffff;">
        <tr>
            <td style="text-align: center; padding: 20px 0;">
                <img src="https://via.placeholder.com/150x50" alt="Company Logo" style="max-width: 150px; height: auto;">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <h1 style="font-size: 24px; margin-bottom: 20px; text-align: center;">Yêu cầu rút tiền được tạo</h1>
                <p style="margin-bottom: 20px;">Xin chào {{ $data['full_name']}},</p>
                <p style="margin-bottom: 20px;">Bạn vừa yêu cầu rút khoản tiền <strong>{{ number_format($data['ammount']) }}  VND </strong>, vui lòng chờ 24 - 48h để được duyệt đơn</p>
                <p style="margin-bottom: 20px;">Vui lòng chờ 24-48h để được duyệt khoản tiền</p>
                <p style="margin-bottom: 20px;">Nếu bạn không yêu cầu giao dịch này, vui lòng <strong>đổi mật khẩu ngay lập tức </strong></p>
                <p style="margin-bottom: 20px;">Cảm ơn bạn đã sử dụng ví tiền của chúng tôi!</p>
            </td>
        </tr>
        <tr>
            <td style="background-color: #f0f0f0; padding: 20px; text-align: center; font-size: 14px;">
                <p style="margin: 0;">&copy; 2024 PCV Fashion.</p>
            </td>
        </tr>
    </table>
</body>
</html>
