<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — Parking Excellence</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        * { margin:0; padding:0; box-sizing:border-box; font-family:'Inter',sans-serif; }
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0f172a 0%, #1e3a5f 50%, #0f172a 100%);
            display: flex; align-items: center; justify-content: center;
            padding: 20px; position: relative; overflow: hidden;
        }
        body::before {
            content: '';
            position: absolute; inset: 0;
            background: radial-gradient(ellipse at 20% 50%, rgba(37,99,235,0.15) 0%, transparent 60%),
                        radial-gradient(ellipse at 80% 20%, rgba(99,102,241,0.1) 0%, transparent 50%);
        }
        .dots {
            position: absolute; inset: 0; overflow: hidden;
            background-image: radial-gradient(rgba(255,255,255,0.04) 1px, transparent 1px);
            background-size: 30px 30px;
        }
        .card {
            position: relative; z-index: 10;
            background: rgba(255,255,255,0.97);
            border-radius: 24px;
            padding: 40px;
            width: 100%; max-width: 420px;
            box-shadow: 0 25px 60px rgba(0,0,0,0.4), 0 0 0 1px rgba(255,255,255,0.1);
        }
        .logo-wrap {
            text-align: center; margin-bottom: 28px;
        }
        .logo-icon {
            width: 56px; height: 56px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            border-radius: 16px;
            display: inline-flex; align-items: center; justify-content: center;
            margin-bottom: 14px;
            box-shadow: 0 8px 24px rgba(37,99,235,0.4);
        }
        h1 { font-size: 22px; font-weight: 800; color: #0f172a; }
        .subtitle { font-size: 13px; color: #94a3b8; margin-top: 3px; }
        .label {
            display: block; font-size: 11.5px; font-weight: 700;
            color: #374151; text-transform: uppercase; letter-spacing: 0.06em;
            margin-bottom: 7px;
        }
        .input-wrap { position: relative; margin-bottom: 18px; }
        .input-icon {
            position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
            color: #94a3b8; font-size: 14px;
        }
        input[type=text], input[type=password] {
            width: 100%; padding: 12px 14px 12px 40px;
            border: 1.5px solid #e2e8f0; border-radius: 12px;
            font-size: 14px; color: #0f172a; background: #f8fafc;
            outline: none; transition: all 0.15s;
        }
        input:focus { border-color: #2563eb; background: #fff; box-shadow: 0 0 0 3px rgba(37,99,235,0.1); }
        .btn {
            width: 100%; padding: 13px;
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff; font-size: 14px; font-weight: 700;
            border: none; border-radius: 12px; cursor: pointer;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            transition: all 0.15s;
            box-shadow: 0 4px 14px rgba(37,99,235,0.4);
        }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(37,99,235,0.5); }
        .btn:active { transform: translateY(0); }
        .error-box {
            background: #fef2f2; border: 1.5px solid #fecaca;
            color: #991b1b; padding: 11px 14px; border-radius: 10px;
            font-size: 13px; margin-bottom: 18px;
            display: flex; align-items: center; gap: 8px;
        }
        .footer { text-align: center; margin-top: 20px; color: #94a3b8; font-size: 12px; }
        .footer i { margin-right: 4px; }
        .hint {
            background: #f8fafc; border-radius: 10px; padding: 12px 14px;
            margin-top: 18px; font-size: 12px; color: #64748b;
        }
        .hint p { margin-bottom: 3px; }
        .hint strong { color: #374151; }
    </style>
</head>
<body>
    <div class="dots"></div>

    <div class="card">
        <div class="logo-wrap">
            <div class="logo-icon">
                <i class="fa-solid fa-square-parking" style="color:#fff; font-size:24px;"></i>
            </div>
            <h1>Parking Excellence</h1>
            <p class="subtitle">Professional Parking Management System</p>
        </div>

        @if($errors->any())
        <div class="error-box">
            <i class="fa-solid fa-circle-exclamation"></i>
            {{ $errors->first() }}
        </div>
        @endif

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div>
                <label class="label">Username</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-user input-icon"></i>
                    <input type="text" name="username" value="{{ old('username') }}"
                           placeholder="Masukkan username" required autofocus>
                </div>
            </div>
            <div>
                <label class="label">Password</label>
                <div class="input-wrap">
                    <i class="fa-solid fa-lock input-icon"></i>
                    <input type="password" name="password" placeholder="••••••••" required>
                </div>
            </div>
            <button type="submit" class="btn">
                Masuk ke Sistem <i class="fa-solid fa-arrow-right"></i>
            </button>
        </form>

        <div class="footer">
            <i class="fa-solid fa-shield-halved"></i>
            Sistem terenkripsi & aman
        </div>
    </div>
</body>
</html>
