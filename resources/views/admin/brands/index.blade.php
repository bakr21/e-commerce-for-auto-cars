@extends('admin.layouts.master')
@section('TitlePage', 'brands')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Brand List</h4>
            <h6>Manage your Brand</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('brands.create')}}" class="btn btn-added"><img src="{{asset('admin/assets/img/icons/plus.svg')}}" class="me-2"
                    alt="img">Add Brand</a>
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
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            {{-- <th>Image</th> --}}
                            <th>Brand Name</th>
                            <th>Brand Slug</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            {{-- <td>
                                <a class="product-img">
                                    <img src="{{asset('admin/assets/img/brand/adidas.png')}}" alt="product">
                                </a>
                            </td> --}}
                            <td>{{ $brand->name}}</td>
                            <td>{{ $brand->slug}}</td>
                            <td>
                                @if($brand->status == 1)
                                <span class="badge bg-success">Active</span>
                                @else
                                <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <a class="me-3" href="{{route('brands.edit',$brand->id)}}">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>
                                
                                @include('admin.brands.delete_modal',['type'=>'brand','data'=>$brand,'routes'=>'brands.destroy'])
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center">No Brands Yet!</td>
                        </tr>
                        @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>


            
        
@endsection