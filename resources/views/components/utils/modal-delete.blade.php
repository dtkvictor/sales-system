{{--
    Form settings and modal message must be passed through button attributs.
    Ex: 
        <button type="button" 
            data-bs-toggle="modal" 
            data-bs-target="#deleteData" 
            data-delete-route="{{route('route.data', $data->id)}}"
            data-delete-message="Do you really want to delete the {{$data->name}}?"
            class="btn btn-danger d-flex justify-content-center align-items-center"
        >
--}}

<div class="modal fade" id="{{$id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$id}}Label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{$id}}Label">{{ $title }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger" id="modalDeleteMessage"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <form action="" method="POST" id="modalDeleteForm">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>