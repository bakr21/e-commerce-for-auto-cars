@extends('website.layouts.master')
@section('TitlePage' , 'Blog')
@section('content')
<!-- Breadcrumb -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-1">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="{{route('website.blog.index')}}">Blogs</a>
                <span class="breadcrumb-item active">Blog Name</span>
            </nav>
        </div>
    </div>
</div>

<!-- Content with Sidebar -->
<div class="container pt-5 pb-3">
    <div class="row">
        <!-- Main Content -->
        <div class="col-lg-8 bg-light pt-4 pb-4">
            <div class="post-title mb-4">
                <h1>Blog Post Title</h1>
            </div>
            <div class="post-meta mb-4">
                <span>Author: <a href="#">Author Name</a></span> | 
                <span>Published Date: June 16, 2024</span>
            </div>
            <img src="path-to-your-image.jpg" class="img-fluid mb-4" alt="Blog Post Image">
            <p>Here is the content of the blog post. You can write your text here. This example contains sample text, you can replace it with your actual content. You can add paragraphs, images, and links as you like.</p>
            <p>An additional paragraph with more text and information. Make sure to format the text well to ensure comfortable and easy reading for visitors.</p>
            
            <!-- Tags and Categories -->
            <div class="row mb-4">
                <!-- Tags -->
                <div class="col-md-6 mb-3">
                    <h3>Tags</h3>
                    <div>
                        <a href="#" class="badge badge-primary">Tag1</a>
                        <a href="#" class="badge badge-primary">Tag2</a>
                        <a href="#" class="badge badge-primary">Tag3</a>
                    </div>
                </div>

                <!-- Categories -->
                <div class="col-md-6 mb-3">
                    <h3>Categories</h3>
                    <ul class="list-unstyled">
                        <li><a href="#">Category 1</a></li>
                        <li><a href="#">Category 2</a></li>
                        <li><a href="#">Category 3</a></li>
                    </ul>
                </div>
            </div>

            <!-- About the Writer -->
            <div class="about-writer bg-light p-4 mb-4 mx-auto" style="max-width: 600px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border-radius: 8px;">
                <h3 class="font-weight-semi-bold text-center">About the Writer</h3>
                <p class="text-center"><strong>Writer Name</strong></p>
                <p class="text-center">This is a brief bio about the writer. It can include their background, interests, and any other relevant information. You can also include a photo of the writer if you like.</p>
            </div>

            <!-- Comments Section -->
            <h3 class="mt-5">Comments</h3>
            <div class="comment-section mb-4">
                <div class="comment p-3 bg-white">
                    <h5>Commenter Name</h5>
                    <p>This is a comment from a visitor. You can use this section to display comments left by visitors on the blog post.</p>
                </div>
                <div class="comment p-3 bg-white">
                    <h5>Another Commenter</h5>
                    <p>Another comment from a different visitor. Ensure the comments are displayed clearly and beautifully to make the blog post page more interactive.</p>
                </div>
            </div>

            <!-- Leave a Comment -->
            <h3 class="mt-5">Leave a Comment</h3>
            <form>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
                <div class="form-group">
                    <label for="comment">Comment</label>
                    <textarea class="form-control" id="comment" rows="5" placeholder="Write your comment"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="bg-light p-4 mb-4">
                <h3 class="font-weight-semi-bold">Sidebar</h3>
                <ul class="list-unstyled">
                    <li><a href="#">Link 1</a></li>
                    <li><a href="#">Link 2</a></li>
                    <li><a href="#">Link 3</a></li>
                    <li><a href="#">Link 4</a></li>
                </ul>
            </div>
            <div class="bg-light p-4 mb-4">
                <h3 class="font-weight-semi-bold">AD Sidebar</h3>
                
            </div>
        </div>
        
    </div>
</div>


@endsection