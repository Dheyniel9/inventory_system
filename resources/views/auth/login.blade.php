@extends('layouts.guest')

@section('title', 'Login')

@section('content')
<style>
    .login-container { max-width: 28rem; margin: 0 auto; }
    .logo-container { display: flex; justify-content: center; }
    .logo-emoji { font-size: 3rem; }
    .login-title { margin-top: 1.5rem; text-align: center; font-size: 1.875rem; font-weight: bold; color: #111827; }
    .login-subtitle { margin-top: 0.5rem; text-align: center; font-size: 0.875rem; color: #4B5563; }
    .login-card { margin-top: 2rem; background: white; padding: 2rem 1rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1); border-radius: 0.5rem; }
    .error-box { margin-bottom: 1rem; padding: 1rem; background-color: #fef2f2; border-radius: 0.375rem; display: flex; gap: 0.75rem; }
    .error-icon { width: 1.25rem; height: 1.25rem; color: #f87171; flex-shrink: 0; }
    .error-text { font-size: 0.875rem; color: #7f1d1d; }
    .form-group { margin-bottom: 1.5rem; }
    .form-label { display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem; }
    .form-input { width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #D1D5DB; border-radius: 0.375rem; font-size: 0.875rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); }
    .form-input:focus { outline: none; border-color: #3b82f6; box-shadow: 0 0 0 3px rgba(59,130,246,0.1); }
    .checkbox-group { display: flex; align-items: center; }
    .checkbox-input { width: 1rem; height: 1rem; border: 1px solid #D1D5DB; border-radius: 0.25rem; }
    .checkbox-label { margin-left: 0.5rem; font-size: 0.875rem; color: #111827; }
    .submit-btn { width: 100%; padding: 0.5rem 1rem; background-color: #2563eb; color: white; font-size: 0.875rem; font-weight: 500; border: none; border-radius: 0.375rem; box-shadow: 0 1px 2px rgba(0,0,0,0.05); cursor: pointer; }
    .submit-btn:hover { background-color: #1d4ed8; }
    .divider-container { position: relative; margin-top: 1.5rem; }
    .divider-line { height: 1px; background-color: #D1D5DB; }
    .divider-text { position: absolute; top: -0.5rem; left: 50%; transform: translateX(-50%); background: white; padding: 0 0.5rem; font-size: 0.875rem; color: #6B7280; }
    .demo-credentials { margin-top: 1rem; text-align: center; font-size: 0.75rem; color: #6B7280; }
    .demo-credentials p { margin: 0.25rem 0; }
    .demo-credentials strong { font-weight: 600; }
</style>

<div class="login-container">
    <div class="logo-container">
        <span class="logo-emoji">📦</span>
    </div>
    <h2 class="login-title">Inventory Management System</h2>
    <p class="login-subtitle">Sign in to your account</p>
</div>

<div class="login-container" style="margin-top: 2rem;">
    <div class="login-card">
        @if($errors->any())
            <div class="error-box">
                <div style="flex-shrink: 0;">
                    <svg class="error-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <p class="error-text">{{ $errors->first() }}</p>
                </div>
            </div>
        @endif

        <form style="display: flex; flex-direction: column; gap: 1.5rem;" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <input id="email" name="email" type="email" autocomplete="email" required value="{{ old('email') }}" class="form-input" placeholder="your@email.com">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input id="password" name="password" type="password" autocomplete="current-password" required class="form-input" placeholder="••••••••">
            </div>

            <div class="checkbox-group">
                <input id="remember" name="remember" type="checkbox" class="checkbox-input">
                <label for="remember" class="checkbox-label">Remember me</label>
            </div>

            <button type="submit" class="submit-btn">Sign in</button>
        </form>

        <div class="divider-container">
            <div class="divider-line"></div>
            <div class="divider-text">Demo Credentials</div>
        </div>
        <div class="demo-credentials">
            <p><strong>Admin:</strong> admin@example.com / password</p>
            <p><strong>Manager:</strong> manager@example.com / password</p>
            <p><strong>Staff:</strong> staff@example.com / password</p>
        </div>
    </div>
</div>
@endsection
