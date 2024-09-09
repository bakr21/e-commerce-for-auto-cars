@extends('admin.layouts.master')
@section('TitlePage', 'catdasn')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Product List</h4>
            <h6>Manage your products</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('products.create')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/plus.svg')}}" alt="img" class="me-1">Add New Product
            </a>
        </div>
    </div>

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
                <table class="table  datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Product Name</th>
                            <th>code</th>
                            <th>Category </th>
                            <th>status</th>
                            <th>price</th>
                            <th>Unit</th>
                            <th>Qty</th>
                            <th>Created By</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)

                        
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td class="productimgname">
                                <a href="javascript:void(0);" class="product-img">
                                    @php
                                    $image = $product->images->first();
                                    @endphp
                                    @if($image && $image->image_path)
                                        <img src="{{ Storage::url($image->image_path) }}" alt="{{ $product->name }}" width="50" class="img-thumbnail">
                                    @else
                                        <img width="50" src="{{asset('admin/assets/img/product/noimage.png')}}" alt="{{ ($product->name) }}"
                                        class="img-thumbnail">
                                    @endif
                                </a>
                                <a href="javascript:void(0);">{{$product->name}}</a>
                            </td>
                            <td>Ft-2{{$product->id}}01</td>
                            <td>{{$product->category->name}}</td>
                            <td>
                                @if($product->status == 1)
                                <span class="badge bg-success">show</span>
                                @else
                                <span class="badge bg-danger">don't show</span>
                                @endif
                            </td>
                            <td>{{$product->price}}</td>
                            <td>N/D</td>
                            <td>{{$product->qty}}</td>
                            <td>N/D</td>
                            <td class="text-end">
                                <a class="me-3" href="{{route('products.show',$product->id)}}">
                                    <img src="{{asset('admin/assets/img/icons/eye.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="{{route('products.edit',$product->id)}}">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>
                                @include('admin.products.delete_modal',['type'=>'product','data'=>$product,'routes'=>'products.destroy'])
                            </td>
                        </tr>
                        
                        @empty
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection