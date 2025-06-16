@extends('website.layouts.master')
@section('TitlePage' , '500 ERROR')
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
        background: linear-gradient(45deg, #dc3545, #6c757d);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
        animation: shake 2s infinite;
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
        background: linear-gradient(45deg, #3D464D, #6c757d);
        color: #fff;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(108, 117, 125, 0.4);
        transition: all 0.3s ease;
        border: none;
        animation: bounceIn 1s ease-in-out;
    }

    .home-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(108, 117, 125, 0.6);
        color: #fff;
    }

    .gear {
        position: absolute;
        border-radius: 50%;
        background-color: rgba(220, 53, 69, 0.1);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 1;
    }

    .gear i {
        color: rgba(220, 53, 69, 0.5);
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes rotateReverse {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(-360deg);
        }
    }

    @keyframes shake {
        0%, 100% {
            transform: translateX(0);
        }
        10%, 30%, 50%, 70%, 90% {
            transform: translateX(-5px);
        }
        20%, 40%, 60%, 80% {
            transform: translateX(5px);
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
</style>

<div class="error-page">
    <!-- Animated gears background -->
    <div id="gears-container"></div>

    <div class="error-container">
        <div class="error-code">500</div>
        <h1 class="error-title"><i class="fas fa-exclamation-circle"></i> {{__('errors.server_error')}}</h1>
        <p class="error-message">{{__('errors.server_error_message')}}</p>
        <a href="{{route('home')}}" class="home-button">
            <i class="fas fa-home mr-2"></i> {{__('errors.back_to_home')}}
        </a>
    </div>
</div>

<script>
    // Create animated gears background
    document.addEventListener('DOMContentLoaded', function() {
        const gearsContainer = document.getElementById('gears-container');
        const gearCount = 8;

        for (let i = 0; i < gearCount; i++) {
            const size = Math.random() * 100 + 50;
            const gear = document.createElement('div');
            gear.className = 'gear';
            gear.style.width = `${size}px`;
            gear.style.height = `${size}px`;
            gear.style.left = `${Math.random() * 100}%`;
            gear.style.top = `${Math.random() * 100}%`;

            // Add gear icon
            const icon = document.createElement('i');
            icon.className = 'fas fa-cog';
            icon.style.fontSize = `${size * 0.7}px`;

            // Alternate rotation direction
            if (i % 2 === 0) {
                gear.style.animation = `rotate ${Math.random() * 10 + 10}s linear infinite`;
            } else {
                gear.style.animation = `rotateReverse ${Math.random() * 10 + 10}s linear infinite`;
            }

            gear.appendChild(icon);
            gearsContainer.appendChild(gear);
        }
    });
</script>
@endsection
