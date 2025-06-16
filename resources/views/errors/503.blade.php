@extends('website.layouts.master')
@section('TitlePage' , '503 ERROR')
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
        background: linear-gradient(45deg, #6610f2, #007bff);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1;
        margin-bottom: 1rem;
        position: relative;
        display: inline-block;
        animation: float 4s ease-in-out infinite;
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
        background: linear-gradient(45deg, #007bff, #6610f2);
        color: #fff;
        border-radius: 50px;
        font-weight: 600;
        text-decoration: none;
        box-shadow: 0 5px 15px rgba(0, 123, 255, 0.4);
        transition: all 0.3s ease;
        border: none;
        animation: bounceIn 1s ease-in-out;
    }

    .home-button:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 123, 255, 0.6);
        color: #fff;
    }

    .tools-container {
        position: absolute;
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    .tool {
        position: absolute;
        opacity: 0.2;
        transform-origin: center;
    }

    .progress-container {
        width: 60%;
        margin: 0 auto 2rem;
        height: 10px;
        background-color: #e9ecef;
        border-radius: 5px;
        overflow: hidden;
        animation: fadeIn 1s ease-in-out;
    }

    .progress-bar {
        height: 100%;
        width: 0;
        background: linear-gradient(45deg, #007bff, #6610f2);
        border-radius: 5px;
        animation: progress 3s ease-in-out infinite;
    }

    @keyframes progress {
        0% {
            width: 15%;
        }
        50% {
            width: 85%;
        }
        100% {
            width: 15%;
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

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
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
    <!-- Animated tools background -->
    <div class="tools-container" id="tools-container"></div>

    <div class="error-container">
        <div class="error-code">503</div>
        <h1 class="error-title"><i class="fas fa-tools"></i> {{__('errors.service_unavailable')}}</h1>
        <p class="error-message">{{__('errors.service_unavailable_message')}}</p>

        <!-- Progress bar to indicate maintenance -->
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>

        <a href="{{route('home')}}" class="home-button">
            <i class="fas fa-home mr-2"></i> {{__('errors.back_to_home')}}
        </a>
    </div>
</div>

<script>
    // Create animated tools background
    document.addEventListener('DOMContentLoaded', function() {
        const toolsContainer = document.getElementById('tools-container');
        const toolCount = 12;
        const toolIcons = [
            'fa-wrench',
            'fa-tools',
            'fa-cog',
            'fa-hammer',
            'fa-screwdriver'
        ];

        for (let i = 0; i < toolCount; i++) {
            const tool = document.createElement('div');
            tool.className = 'tool';

            // Randomly select a tool icon
            const randomIcon = toolIcons[Math.floor(Math.random() * toolIcons.length)];
            tool.innerHTML = `<i class="fas ${randomIcon}"></i>`;

            // Random position
            tool.style.left = `${Math.random() * 100}%`;
            tool.style.top = `${Math.random() * 100}%`;

            // Random size
            const size = Math.random() * 40 + 20;
            tool.style.fontSize = `${size}px`;

            // Random rotation animation
            const duration = Math.random() * 15 + 10;
            tool.style.animation = `rotate ${duration}s linear infinite`;

            toolsContainer.appendChild(tool);
        }
    });
</script>
@endsection
