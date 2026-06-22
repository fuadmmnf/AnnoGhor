<style>
    .reset-card {
        max-width: 380px;
        margin: 80px auto;
        padding: 26px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        font-family: 'DM Sans', sans-serif;
        border: 1px solid #f1f5f9;
    }

    .reset-card h2 {
        font-size: 20px;
        text-align: center;
        margin-bottom: 18px;
        color: #5a3e2b; /* AnnoGhor থিম ব্রাউন */
        font-weight: 700;
    }

    .reset-card input {
        width: 100%;
        padding: 11px 14px;
        margin-bottom: 14px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 14px;
        box-sizing: border-box;
        transition: all 0.2s ease;
    }

    .reset-card input:focus {
        outline: none;
        border-color: #f15922; /* AnnoGhor থিম অরেঞ্জ */
        box-shadow: 0 0 0 3px rgba(241, 89, 34, 0.1);
    }

    .reset-card button {
        width: 100%;
        padding: 11px;
        border-radius: 8px;
        border: none;
        background: #5a3e2b; /* থিম ব্রাউন বাটন */
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .reset-card button:hover {
        background: #f15922; /* হোভার করলে অরেঞ্জ হবে */
    }

    .reset-card p {
        font-size: 12px;
        text-align: center;
        margin-top: 14px;
        color: #666;
        line-height: 1.5;
    }

    /* 🔔 পাসওয়ার্ড ম্যাচ না করলে বা দুর্বল হলে এরর অ্যালার্ট */
    .reset-error-box {
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 13px;
        margin-bottom: 14px;
        font-weight: 500;
        background-color: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .reset-error-box ul {
        margin: 0;
        padding-left: 15px;
    }
</style>

<div class="reset-card">
    <h2>Reset Your Password</h2>

    @if ($errors->any())
        <div class="reset-error-box">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li><i class="fas fa-exclamation-circle me-1"></i> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Confirm your email address" required>
        
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm new password" required>

        <button type="submit">Reset Password</button>
    </form>

    <p>Please choose a strong password to keep your account secure.</p>
</div>