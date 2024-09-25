@extends('admin.layouts.master')
@section('TitlePage', 'create shipping')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Shipping Add</h4>
            <h6>Create new Shipping</h6>
        </div>
    </div>
    {{-- Start Create shipping --}}
    <div class="card">
        <div class="card-body">
            <form action="{{ route('shipping.store') }}" method="POST" name="shippingForm" id="shippingForm"
                enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-4 col-sm-6 col-12">
                        <div class="form-group">
                            <select class="select" name="country" id="country">
                                <option value="">select a country</option>
                                @if ($countries->isNotEmpty())
                                @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ $country->code == 'EG' ? 'selected' : '' }}>
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
                                value="{{ old('amount') }}">
                                <p></p>
                            </div>
                        </div>
                    <div class="col-lg-4">
                        <button type="submit" class="btn btn-sm btn-submit">create</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    {{-- End Create shipping --}}


    <div class="card">
        <div class="card-body">
            <div class="table-top">
                <div class="search-set">
                    <div class="search-input">
                        <a class="btn btn-searchset"><img src="{{asset('admin/assets/img/icons/search-white.svg')}}"
                                alt="img"></a>
                    </div>
                </div>
                <div class="wordset">
                    <ul>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                    src="{{asset('admin/assets/img/icons/pdf.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                    src="{{asset('admin/assets/img/icons/excel.svg')}}" alt="img"></a>
                        </li>
                        <li>
                            <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                    src="{{asset('admin/assets/img/icons/printer.svg')}}" alt="img"></a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>#</th>
                            {{-- <th>Image</th> --}}
                            <th>Country</th>
                            <th>Amount</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($shippingCharges as $shippingCharge)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $shippingCharge->name}}</td>
                            <td>{{ $shippingCharge->amount}} EGP</td>
                            
                            <td>
                                <a class="me-3" href="{{ route('shipping.edit',$shippingCharge->id) }}">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="javascript:void(0);" onclick="deleteRecord({{$shippingCharge->id}})">
                                    <img src="{{asset('admin/assets/img/icons/delete.svg')}}" alt="img">
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Shipping Charges Yet!</td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
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
            url: '{{ route('shipping.store') }}',
            type: 'post',
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
                errorFeedback
                .addClass('invalid-feedback')
                .html(errors[field][0]);
            } else {
                input.removeClass('is-invalid');
                errorFeedback
                .removeClass('invalid-feedback')
                .html('');
            }
        });
    }
    });
    
    function deleteRecord(id) {
        if(confirm("Are you sure you want to delete this record?")) {
            var url = '{{ route('shipping.destroy', 'id') }}';
            var newUrl = url.replace("id", id);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: newUrl,
                type: 'DELETE',
                dataType: 'json',
                success: function(response) {
                    if(response.status === true) {
                        window.location.href = "{{ route('shipping.create') }}";
                    }
                },
                error: function(xhr, status, error) {
                    alert("An error occurred while deleting the record. Please try again.");
                }
            });
        }
    }


</script>

@endsection
