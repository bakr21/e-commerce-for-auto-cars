@extends('admin.layouts.master')
@section('TitlePage', 'catdasn')
@section('content')
<div class="content">
    <div class="page-header">
        <div class="page-title">
            <h4>Product Category list</h4>
            <h6>View/Search product Category</h6>
        </div>
        <div class="page-btn">
            <a href="{{route('categories.create')}}" class="btn btn-added">
                <img src="{{asset('admin/assets/img/icons/plus.svg')}}" class="me-1" alt="img">Add Category
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
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Category name</th>
                            <th>is_showing</th>
                            <th>is_popular</th>
                            <th>slug</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="productimgname">
                                <a class="product-img">
                                    <img width="50" src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}"
                                    class="img-thumbnail">
                                </a>
                                <a>{{ $category->name }}</a>
                            </td>
                            <td>
                                @if($category->is_showing == 1)
                                <span class="badge bg-success">show</span>
                                @else
                                <span class="badge bg-danger">don't show</span>
                                @endif
                            </td>
                            <td>
                                @if($category->is_popular == 1)
                                <span class="badge bg-success">popular</span>
                                @else
                                <span class="badge bg-danger">don't popular</span>
                                @endif
                            </td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <a class="me-3" href="{{route('categories.show',$category->id)}}">
                                    <img src="{{asset('admin/assets/img/icons/eye.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="{{route('categories.edit',$category->id)}}">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>
                                
                                @include('admin.categories.delete_modal',['type'=>'category','data'=>$category,'routes'=>'categories.destroy'])

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center">No Products Yet!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection