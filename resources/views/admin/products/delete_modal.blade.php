<a type="button" class="me-3" data-bs-toggle="modal" data-bs-target="#delete_{{$type}}_{{$data->id}}">
    <img src="{{asset('admin/assets/img/icons/delete.svg')}}" alt="img">
</a>

<!-- Modal -->
<div class="modal fade" id="delete_{{$type}}_{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Delete product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{route($routes,$data->id)}}" method="post">
                @method('DELETE')
                @csrf
                <div class="modal-body">
                    did you mean to delete this <span class="fw-bold">{{$product->name}}</span> ?
                    {{-- <h4><span class="text-warning">please note that : </span></h4> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-danger">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
