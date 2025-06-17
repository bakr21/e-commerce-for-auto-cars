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
                <table class="table ">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><i class="fas fa-image"></i> Image</th>
                            <th><i class="fas fa-flag"></i> Name (EN)</th>
                            <th><i class="fas fa-flag"></i> Name (AR)</th>
                            <th><i class="fas fa-eye"></i> Showing</th>
                            <th><i class="fas fa-star"></i> Popular</th>
                            <th><i class="fas fa-link"></i> Slug</th>
                            <th><i class="fas fa-cogs"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td class="productimgname">
                                <a class="product-img">
                                    <img width="50" src="{{ Storage::url($category->image) }}" alt="{{ $category->getTranslation('name', 'en') }}"
                                    class="img-thumbnail">
                                </a>
                            </td>
                            <td>
                                <strong>{{ $category->getTranslation('name', 'en') ?? 'N/A' }}</strong>
                            </td>
                            <td dir="rtl">
                                <strong>{{ $category->getTranslation('name', 'ar') ?? 'غير متوفر' }}</strong>
                            </td>
                            <td>
                                @if($category->is_showing == 1)
                                <span class="badge bg-success">Show</span>
                                @else
                                <span class="badge bg-danger">Hidden</span>
                                @endif
                            </td>
                            <td>
                                @if($category->is_popular == 1)
                                <span class="badge bg-success">Popular</span>
                                @else
                                <span class="badge bg-secondary">Normal</span>
                                @endif
                            </td>
                            <td><code>{{ $category->slug }}</code></td>
                            <td>
                                <a class="me-3" href="{{route('categories.show',$category->id)}}" title="View">
                                    <img src="{{asset('admin/assets/img/icons/eye.svg')}}" alt="img">
                                </a>
                                <a class="me-3" href="{{route('categories.edit',$category->id)}}" title="Edit">
                                    <img src="{{asset('admin/assets/img/icons/edit.svg')}}" alt="img">
                                </a>

                                @include('admin.categories.delete_modal',['type'=>'category','data'=>$category,'routes'=>'categories.destroy'])

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center">No Categories Yet!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
