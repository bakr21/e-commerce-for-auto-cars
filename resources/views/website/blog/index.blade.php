@extends('website.layouts.master')
@section('TitlePage' , 'blogs')
@section('content')
    <!-- Breadcrumb -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-3">
                    <a class="breadcrumb-item text-dark" href="#">Home</a>
                    <span class="breadcrumb-item active">Blogs</span>
                </nav>
            </div>
        </div>
    </div>
    @php
     // In your controller, pass the blog data to the view
$blogs = [
    ['title' => 'Blog 1', 'text' => 'Some quick example text for blog 1.', 'image' => 'website/assets/img/blog-1.jpg'],
    ['title' => 'Blog 2', 'text' => 'Some quick example text for blog 2.', 'image' => 'website/assets/img/blog-2.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    ['title' => 'Blog 3', 'text' => 'Some quick example text for blog 3.', 'image' => 'website/assets/img/blog-3.jpg'],
    // Add more blog data as needed
];

    @endphp
    <!-- Blog Section -->

    <div class="container">
        <div class="row gx-3 gy-4">
            @foreach($blogs as $blog)
                <div class="col-md-4">
                    <div class="card h-100">
                        <img src="{{ asset($blog['image']) }}" class="card-img-top" alt="{{ $blog['title'] }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $blog['title'] }}</h5>
                            <p class="card-text">{{ $blog['text'] }}</p>
                            <a href="{{route('website.blog')}}" class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    
    
    

@endsection