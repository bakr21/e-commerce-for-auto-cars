@extends('admin.layouts.master')
@section('TitlePage', 'categories')
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
                <table class="table datanew">
                    <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Category Name</th>
                            <th>Name (AR)</th>
                            <th>N#P</th>
                            <th>Showing</th>
                            <th>Popular</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <td>
                                <label class="checkboxs">
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </td>
                            <td class="productimgname">
                                <a href="javascript:void(0);" class="product-img">
                                    <img width="50" src="{{ Storage::url($category->image) }}" alt="{{ $category->getTranslation('name', 'en') }}"
                                    class="img-thumbnail">
                                </a>
                                <a href="javascript:void(0);">{{ $category->getTranslation('name', 'en') ?? 'N/A' }}</a>
                            </td>
                            <td dir="rtl">{{ $category->getTranslation('name', 'ar') ?? 'غير متوفر' }}</td>
                            <td>{{ $category->products()->count() }}</td>
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
                            <td class="text-end">
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
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
