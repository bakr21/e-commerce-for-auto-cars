@extends('website.layouts.master')
@section('TitlePage' , '403 ERROR')
@section('content')
<style>
    /* Style for error page */
    .error-page {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: calc(100vh - 95px);
        background-color: #f8f9fa;
        overflow: hidden;
        position: relative;
    }

    .error-container {
        position: relative;
        z-index: 2;
        padding: 3rem;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        max-width: 800px;
        width: 90%;
        text-align: center;
        animation: fadeIn 1s ease-in-out;
    }

    .error-code {
        font-size: 10rem;
        font-weight: 900;
        background: linear-gradient(45deg, #ffc107, #dc3545);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
        animation: pulse 2s infinite;
    }

    .error-title {
        font-size: 2.5rem;
        margin-bottom: 1.5rem;
        color: #3D464D;
        animation: slideInDown 0.7s ease-in-out;
    }

    .error-message {
        font-size: 1.2rem;
        color: #6c757d;
        margin-bottom: 2rem;
        animation: slideInUp 0.7s ease-in-out;
    }

    .home-button {
        display: inline-block;
        padding: 12px 30px;
        background: linear-gradient(45deg, #ffc107, #dc3545);
        color: #fff;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.4);
        transition: all 0.3s ease;
        border: none;
        animation: bounceIn 1s ease-in-out;
    }

    .home-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(255, 193, 7, 0.6);
        color: #fff;
    }

    .lock-container {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
        opacity: 0.1;
    }

    .lock {
        position: absolute;
        font-size: 3rem;
        color: #dc3545;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideInDown {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes slideInUp {
        from {
            transform: translateY(50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    @keyframes bounceIn {
        0% {
            transform: scale(0.1);
            opacity: 0;
        }
        60% {
            transform: scale(1.1);
            opacity: 1;
        }
        100% {
            transform: scale(1);
        }
    }

    @keyframes float {
        0% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-20px);
        }
        100% {
            transform: translateY(0);
        }
    }
</style>

<div class="error-page">
    <!-- Animated locks background -->
    <div class="lock-container" id="lock-container"></div>

    <div class="error-container">
        <div class="error-code">403</div>
        <h1 class="error-title"><i class="fas fa-lock"></i> {{__('errors.forbidden')}}</h1>
        <p class="error-message">{{__('errors.forbidden_message')}}</p>
        <a href="{{route('home')}}" class="home-button">
            <i class="fas fa-home mr-2"></i> {{__('errors.back_to_home')}}
        </a>
    </div>
</div>

<script>
    // Create animated locks background
    document.addEventListener('DOMContentLoaded', function() {
        const lockContainer = document.getElementById('lock-container');
        const lockCount = 15;

        for (let i = 0; i < lockCount; i++) {
            const lock = document.createElement('div');
            lock.className = 'lock';
            lock.innerHTML = '<i class="fas fa-lock"></i>';
            lock.style.left = `${Math.random() * 100}%`;
            lock.style.top = `${Math.random() * 100}%`;
            lock.style.fontSize = `${Math.random() * 30 + 20}px`;
            lock.style.opacity = `${Math.random() * 0.5 + 0.1}`;
            lock.style.animation = `float ${Math.random() * 5 + 3}s ease-in-out infinite`;
            lock.style.animationDelay = `${Math.random() * 2}s`;

            lockContainer.appendChild(lock);
        }
    });
</script>
@endsection

