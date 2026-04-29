<style>
    .reset-card {
        max-width: 380px;
        margin: 80px auto;
        padding: 26px;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        font-family: Arial, sans-serif;
    }

    .reset-card h2 {
        font-size: 18px;
        text-align: center;
        margin-bottom: 18px;
        color: #333;
    }

    .reset-card input {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 14px;
        border-radius: 8px;
        border: 1px solid #ddd;
        font-size: 14px;
    }

    .reset-card input:focus {
        outline: none;
        border-color: #4f46e5;
    }

    .reset-card button {
        width: 100%;
        padding: 10px;
        border-radius: 8px;
        border: none;
        background: #4f46e5;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s ease;
    }

    .reset-card button:hover {
        background: #4338ca;
    }

    .reset-card p {
        font-size: 12px;
        text-align: center;
        margin-top: 12px;
        color: #666;
    }
</style>

<div class="reset-card">
    <h2>Reset Your Password</h2>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <input type="email" name="email" placeholder="Email address" required>
        <input type="password" name="password" placeholder="New password" required>
        <input type="password" name="password_confirmation" placeholder="Confirm password" required>

        <button type="submit">Reset Password</button>
    </form>

    <p>Please choose a strong password.</p>
</div>

