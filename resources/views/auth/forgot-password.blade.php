<style>
    .reset-card {
        max-width: 360px;
        margin: 80px auto;
        padding: 24px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.06);
        font-family: 'DM Sans', sans-serif;
        border: 1px solid #f1f5f9;
    }

    .reset-card h2 {
        font-size: 20px;
        text-align: center;
        margin-bottom: 16px;
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
        background: #5a3e2b; /* সাবমিট বাটন ব্রাউন */
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

    /* 🔔 এরর মেসেজ স্টাইল */
    .reset-alert-error {
        padding: 10px 12px;
        border-radius: 6px;
        font-size: 13px;
        margin-bottom: 14px;
        font-weight: 500;
        background-color: #fee2e2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
</style>

<div class="reset-card">
    <h2>Reset Password</h2>

    @if ($errors->has('email'))
        <div class="reset-alert-error">
            <i class="fas fa-exclamation-circle me-1"></i> {{ $errors->first('email') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Enter your registered email" required>
        <button type="submit">Send Reset Link</button>
    </form>

    <p>We’ll send a password reset link to your email if it exists in our system.</p>
</div>

@if (session('status'))
    @push('scripts')
    <script>
        $(document).ready(function() {
            // আপনার লেআউটের গ্লোবাল নোটিফিকেশন ফাংশনটি এখানে কল করা হয়েছে
            if (typeof showNotification === 'function') {
                showNotification("{{ session('status') }}", 'success');
            } else {
                // ব্যাকআপ হিসেবে যদি গ্লোবাল ফাংশন লোড হতে দেরি হয়
                alert("{{ session('status') }}");
            }
        });
    </script>
    @endpush
@endif