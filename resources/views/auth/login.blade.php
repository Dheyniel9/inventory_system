@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
    }

    .login-wrapper {
        width: 100%;
        max-width: 420px;
    }

    .login-card {
        background: white;
        border-radius: 16px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        padding: 40px;
        backdrop-filter: blur(10px);
    }

    .logo-container {
        display: flex;
        justify-content: center;
        margin-bottom: 24px;
    }

    .logo-icon {
        width: 64px;
        height: 64px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 8px 16px rgba(102, 126, 234, 0.4);
    }

    .logo-icon svg {
        width: 36px;
        height: 36px;
        color: white;
    }

    .login-header {
        text-align: center;
        margin-bottom: 32px;
    }

    .login-title {
        font-size: 28px;
        font-weight: 700;
        color: #1f2937;
        margin: 0 0 8px 0;
        line-height: 1.2;
    }

    .login-subtitle {
        font-size: 14px;
        color: #6b7280;
        margin: 0;
        line-height: 1.4;
    }

    .error-box {
        margin-bottom: 20px;
        padding: 12px 16px;
        background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
        border-radius: 8px;
        border-left: 4px solid #ef4444;
    }

    .error-content {
        display: flex;
        align-items: flex-start;
        gap: 10px;
    }

    .error-icon {
        width: 20px;
        height: 20px;
        color: #dc2626;
        flex-shrink: 0;
        margin-top: 2px;
    }

    .error-text {
        font-size: 13px;
        color: #991b1b;
        line-height: 1.4;
        margin: 0;
    }

    .login-form {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .form-group {
        margin: 0;
    }

    .form-label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
        line-height: 1.2;
    }

    .input-wrapper {
        position: relative;
    }

    .input-icon {
        position: absolute;
        left: 14px;
        top: 50%;
        transform: translateY(-50%);
        width: 18px;
        height: 18px;
        color: #9ca3af;
        pointer-events: none;
    }

    .form-input {
        width: 100%;
        padding: 12px 14px 12px 42px;
        border: 2px solid #e5e7eb;
        border-radius: 8px;
        font-size: 14px;
        color: #1f2937;
        transition: all 0.2s;
        background: #f9fafb;
        line-height: 1.4;
    }

    .form-input:focus {
        outline: none;
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }

    .form-input::placeholder {
        color: #9ca3af;
    }

    .checkbox-container {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .checkbox-input {
        width: 18px;
        height: 18px;
        border: 2px solid #d1d5db;
        border-radius: 4px;
        cursor: pointer;
        accent-color: #667eea;
    }

    .checkbox-label {
        font-size: 14px;
        color: #374151;
        cursor: pointer;
        user-select: none;
        line-height: 1.4;
    }

    .submit-btn {
        width: 100%;
        padding: 14px 24px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        font-size: 15px;
        font-weight: 600;
        border: none;
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
        line-height: 1.4;
    }

    .submit-btn:active {
        transform: translateY(0);
    }

    .divider {
        display: flex;
        align-items: center;
        margin: 24px 0 20px 0;
    }

    .divider-line {
        flex: 1;
        height: 1px;
        background: #e5e7eb;
    }

    .divider-text {
        padding: 0 12px;
        font-size: 13px;
        color: #9ca3af;
        font-weight: 500;
    }

    .demo-box {
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-radius: 8px;
        padding: 16px;
        text-align: center;
    }

    .demo-title {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        margin: 0 0 8px 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .demo-credential {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 13px;
        color: #374151;
        margin: 0;
    }

    .demo-credential strong {
        font-weight: 600;
        color: #1f2937;
    }

    .demo-credential svg {
        width: 14px;
        height: 14px;
        color: #9ca3af;
    }

    .footer-text {
        text-align: center;
        margin-top: 24px;
        font-size: 13px;
        color: rgba(255, 255, 255, 0.9);
    }

    @media (max-width: 480px) {
        .login-card {
            padding: 28px 24px;
        }

        .login-title {
            font-size: 24px;
        }

        .logo-icon {
            width: 56px;
            height: 56px;
        }

        .logo-icon svg {
            width: 32px;
            height: 32px;
        }
    }
</style>

<div class="login-wrapper">
    <div class="login-card">
        <div class="logo-container">
            <div class="logo-icon">
                <svg fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="2"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                </svg>
            </div>
        </div>

        <div class="login-header">
            <h2 class="login-title">Welcome Back</h2>
            <p class="login-subtitle">Sign in to access your inventory system</p>
        </div>

        @if($errors->any())
        <div class="error-box">
            <div class="error-content">
                <svg class="error-icon"
                     viewBox="0 0 20 20"
                     fill="currentColor">
                    <path fill-rule="evenodd"
                          d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z"
                          clip-rule="evenodd" />
                </svg>
                <p class="error-text">{{ $errors->first() }}</p>
            </div>
        </div>
        @endif

        <form class="login-form"
              action="{{ route('login') }}"
              method="POST">
            @csrf

            <div class="form-group">
                <label for="email"
                       class="form-label">Email Address</label>
                <div class="input-wrapper">
                    <svg class="input-icon"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0L3.32 8.91a2.25 2.25 0 01-1.07-1.916V6.75" />
                    </svg>
                    <input id="email"
                           name="email"
                           type="email"
                           autocomplete="email"
                           required
                           value="{{ old('email') }}"
                           class="form-input"
                           placeholder="your@email.com">
                </div>
            </div>

            <div class="form-group">
                <label for="password"
                       class="form-label">Password</label>
                <div class="input-wrapper">
                    <svg class="input-icon"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke-width="2"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z" />
                    </svg>
                    <input id="password"
                           name="password"
                           type="password"
                           autocomplete="current-password"
                           required
                           class="form-input"
                           placeholder="Enter your password">
                </div>
            </div>

            <div class="checkbox-container">
                <input id="remember"
                       name="remember"
                       type="checkbox"
                       class="checkbox-input">
                <label for="remember"
                       class="checkbox-label">Remember me for 30 days</label>
            </div>

            <button type="submit"
                    class="submit-btn">Sign In to Dashboard</button>
        </form>

        <div class="divider">
            <div class="divider-line"></div>
            <span class="divider-text">Demo Access</span>
            <div class="divider-line"></div>
        </div>

        <div class="demo-box">
            <p class="demo-title">Quick Login</p>
            <p class="demo-credential">
                <svg fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="2"
                     stroke="currentColor">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                </svg>
                <strong>admin@example.com</strong>
                <span>/</span>
                <span>password</span>
            </p>
        </div>
    </div>

    <p class="footer-text">© 2025 Inventory System. All rights reserved.</p>
</div>
@endsection
