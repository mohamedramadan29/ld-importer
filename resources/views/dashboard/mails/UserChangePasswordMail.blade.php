<!doctype html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إعادة تعيين كلمة المرور - AyaKids Dashboard</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Cairo', 'Segoe UI', Tahoma, sans-serif;
            background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%);
            margin: 0;
            padding: 40px 20px;
            min-height: 100vh;
        }
        .email-wrapper {
            max-width: 520px;
            margin: 0 auto;
        }
        .email-card {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 20px 60px rgba(16, 185, 129, 0.15);
            overflow: hidden;
        }
        .email-header {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .logo-container {
            background: rgba(255, 255, 255, 0.2);
            width: 90px;
            height: 90px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            backdrop-filter: blur(10px);
        }
        .logo-container img {
            width: 60px;
            height: 60px;
            object-fit: contain;
        }
        .email-header h1 {
            color: #ffffff;
            font-size: 22px;
            font-weight: 700;
            margin: 0;
        }
        .email-header p {
            color: rgba(255, 255, 255, 0.9);
            font-size: 14px;
            margin-top: 5px;
        }
        .email-body {
            padding: 40px 35px;
            text-align: center;
        }
        .welcome-icon {
            font-size: 48px;
            margin-bottom: 15px;
        }
        .email-body h2 {
            color: #1e293b;
            font-size: 20px;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .email-body p {
            color: #64748b;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 25px;
        }
        .btn-reset {
            display: inline-block;
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: #ffffff !important;
            text-decoration: none;
            padding: 14px 40px;
            border-radius: 50px;
            font-weight: 700;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.35);
        }
        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(16, 185, 129, 0.45);
        }
        .divider {
            height: 1px;
            background: linear-gradient(90deg, transparent, #e2e8f0, transparent);
            margin: 25px 0;
        }
        .note-box {
            background: #f8fafc;
            border-radius: 12px;
            padding: 15px 20px;
            margin-top: 20px;
        }
        .note-box p {
            color: #94a3b8;
            font-size: 13px;
            margin: 0;
        }
        .email-footer {
            background: #f8fafc;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #f1f5f9;
        }
        .footer-logo {
            width: 50px;
            height: 50px;
            margin: 0 auto 10px;
            opacity: 0.6;
        }
        .email-footer p {
            color: #94a3b8;
            font-size: 12px;
            margin: 5px 0;
        }
        .email-footer a {
            color: #10B981;
            text-decoration: none;
        }
        @media (max-width: 480px) {
            body { padding: 20px 15px; }
            .email-header { padding: 30px 20px; }
            .email-body { padding: 30px 25px; }
            .email-header h1 { font-size: 18px; }
            .btn-reset { padding: 12px 30px; font-size: 14px; }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <div class="email-card">
            <!-- Header -->
            <div class="email-header">
                <div class="logo-container">
                    <img src="{{ asset('assets/uploads/ayakids.svg') }}" alt="AyaKids">
                </div>
                <h1>AyaKids Dashboard</h1>
                <p>لوحة تحكم المعلمين</p>
            </div>

            <!-- Body -->
            <div class="email-body">
                <div class="welcome-icon">🔐</div>
                <h2>إعادة تعيين كلمة المرور</h2>
                <p>تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بحسابك. اضغط على الزر أدناه لإنشاء كلمة مرور جديدة:</p>

                <a href="{{ url('dashboard/change-forget-password/' . $code) }}" class="btn-reset">
                    إعادة تعيين كلمة المرور
                </a>

                <div class="divider"></div>

                <div class="note-box">
                    <p>⚠️ إذا لم تطلب هذا التغيير، يرجى تجاهل هذا الإيميل. لن يتم تغيير كلمة المرور إلا إذا قمت بالضغط على الزر أعلاه.</p>
                </div>
            </div>

            <!-- Footer -->
            <div class="email-footer">
                <img class="footer-logo" src="{{ asset('assets/uploads/ayakids.svg') }}" alt="AyaKids">
                <p>© {{ date('Y') }} AyaKids. جميع الحقوق محفوظة</p>
                <p>للتواصل عبر واتساب: <a href="https://wa.me/201064525348">اضغط هنا</a></p>
            </div>
        </div>
    </div>
</body>
</html>
