@extends('website.layouts.master')
@section('TitlePage' , $page->name)
@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid mb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
            <span class="bg-secondary pr-3">{{$page->name}}</span>
        </h2>

        @if ($page->slug == 'contact-us')
            <div class="row px-xl-5">
                <div class="col-lg-7 mb-5">
                    <div id="successAlert" class="alert alert-success alert-dismissible fade show d-none" role="alert">
                        <span id="alertMessage"></span>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    
                    <form name="sentMessage" id="contactForm" method="POST" action="{{ route('messages.store') }}" novalidate="novalidate">
                        @csrf
                        <div class="control-group">
                            <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="email" name="email" class="form-control" id="email" placeholder="Your Email" required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" name="phone" class="form-control" id="phone" placeholder="Phone" required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <input type="text" name="subject" class="form-control" id="subject" placeholder="Subject" required="required" />
                            <p class="help-block text-danger"></p>
                        </div>
                        <div class="control-group">
                            <textarea class="form-control" name="message" rows="8" id="message" placeholder="Message" required="required"></textarea>
                            <p class="help-block text-danger"></p>
                        </div>
                        <div>
                            <button class="btn btn-primary py-2 px-4" type="submit">Send Message</button>
                        </div>
                    </form>
                    
                    
                    
                </div>
                <div class="col-lg-5 mb-5">
                    <div class="bg-light p-30 mb-30">
                        <iframe style="width: 100%; height: 250px;"
                        src="{{$site_settings->map_link}}"
                        frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                    @if($page->content)
                        {!! $page->content !!}
                    @endif
                </div>
            </div>
        @else 
            <div class="row px-xl-5 pb-3">
                <div class="col-sm-12 pb-1">
                    <div class="bg-white mb-4" style="padding: 30px;">
                        <div class="d-flex align-items-center mb-4">
                            {{-- <h1 class="fa-regular fa-address-card text-primary mr-3"></h1> --}}
                            <h5 class="font-weight-semi-bold m-0">{{$page->name}}</h5>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col-md-7 p-4">
                                @if($page->content)
                                    {!! $page->content !!}
                                @else
                                    <p>There is no content to display on this page.</p>
                                @endif
                            </div>
                            <div class="col-md-5 p-4">
                                @if($page->image)
                                <img src="{{ asset('storage/' . $page->image) }}" alt="{{ $page->name }}" class="img-fluid  rounded">
                                @else
                                    <p></p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
    <!-- Carousel End -->
    <script>
        document.getElementById('contactForm').addEventListener('submit', function(e) {
            e.preventDefault(); 
    
            let formData = new FormData(this); 
    
            fetch("{{ route('messages.store') }}", {
                method: "POST",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // عرض الـ Alert بالرسالة
                    document.getElementById('alertMessage').textContent = data.success;
                    document.getElementById('successAlert').classList.remove('d-none');
                    this.reset();
                }
            })
            .catch(error => console.error('Error:', error));
        });
    </script>
@endsection