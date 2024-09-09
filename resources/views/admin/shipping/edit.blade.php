@extends('admin.layouts.master')
@section('TitlePage', 'Edit shipping')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Shipping Add</h4>
            <h6>Create new Shipping</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('shipping.create')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/reverse.svg')}}" alt="img" class="me-1">Shipping List
            </a>
        </div>
    </div>
    {{-- Start Create shipping --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('shipping.update', $shippingCharge->id) }}" method="POST" name="shippingForm" id="shippingForm"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <select class="select" name="country" id="country">
                                <option value="">select a country</option>
                                @if ($countries->isNotEmpty())
                                @foreach ($countries as $country)
                                    <option {{ ($shippingCharge->country_id == $country->id) ? 'selected' : ''}} value="{{ $country->id }}">
                                        {{$country->name}}</option>
                                @endforeach
                                @endif
                            </select>
                            <p></p>
                        </div>
                    </div>
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <input type="text" name="amount" id="amount" class="form-control" placeholder="Amount"
                                value="{{ $shippingCharge->amount }}">
                                <p></p>
                            </div>
                        </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-sm btn-submit">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Create shipping --}}


    
</div>

<script>
    $(document).ready(function() {
    $("#shippingForm").submit(function(event) {
        event.preventDefault();
        $('button[type="submit"]').prop('disabled', true);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '{{ route('shipping.update', $shippingCharge->id) }}',
            type: 'put',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(response) {
                $('button[type="submit"]').prop('disabled', false);

                if (response.status === false) {
                    handleErrors(response.errors);
                } else {
                    // حفظ ناجح، إعادة التوجيه إلى صفحة الشكر
                    window.location.href = "{{ route('shipping.create') }}";
                }
            },
            error: function(xhr, status, error) {
                $('button[type="submit"]').prop('disabled', false);
                // يمكن معالجة الأخطاء الأخرى هنا
                alert("حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.");
            }
        });
    });

    function handleErrors(errors) {
        var fields = ['country', 'amount'];

        fields.forEach(function(field) {
            var input = $("#" + field);
            var errorFeedback = input.siblings('p');
            if (errors[field]) {
                input.addClass('is-invalid');
                errorFeedback.addClass('invalid-feedback').html(errors[field][0]);
            } else {
                input.removeClass('is-invalid');
                errorFeedback.removeClass('invalid-feedback').html('');
            }
        });
    }
});

</script>

@endsection
