<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>رسالة جديدة من نموذج الاتصال</title>
</head>
<body style="font-family: Arial, sans-serif; direction: rtl; text-align: right; padding: 20px; background-color: #f5f5f5;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <div style="background: #1a1a1a; color: #fff; padding: 20px; text-align: center;">
            <h1 style="margin: 0; font-size: 20px;">L.D IMPORTER</h1>
            <p style="margin: 5px 0 0; opacity: 0.8;">رسالة جديدة من نموذج الاتصال</p>
        </div>
        <div style="padding: 30px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #eee; font-weight: bold; width: 120px;">الاسم:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">{{ $contactMessage->name }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #eee; font-weight: bold;">الهاتف:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;" dir="ltr">{{ $contactMessage->phone }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #eee; font-weight: bold;">البلد:</td>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;">{{ $contactMessage->country }}</td>
                </tr>
                <tr>
                    <td style="padding: 12px; font-weight: bold; vertical-align: top;">الرسالة:</td>
                    <td style="padding: 12px;">{{ $contactMessage->message }}</td>
                </tr>
            </table>
        </div>
        <div style="background: #f9f9f9; padding: 15px; text-align: center; font-size: 12px; color: #999;">
            تم الإرسال في: {{ $contactMessage->created_at->format('Y-m-d H:i:s') }}
        </div>
    </div>
</body>
</html>
