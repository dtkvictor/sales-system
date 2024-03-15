<table class="table">
    <thead>
        <tr>
            <th>ID</th>
            <th>Thumb</th>
            <th>Name</th>
            <th>Last updated</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <th>{{$category->id}}</th>
                <td>
                    <img src="{{ $category->thumb }}" 
                        onerror="this.src='{{asset('assets/image/default.png')}}'"
                        width="48"
                        height="48"
                    >
                </td>
                <td>{{$category->name}}</td>
                <td>{{$category->updated_at}}</td>
                <td>
                    <div class="w-100 d-flex justify-content-end gap-1 p-1">
                        <a class="btn btn-warning d-flex justify-content-center align-items-center p-1" 
                           href="{{route('category.edit', $category->id)}}"
                        >
                            <x-utils.icon name='edit'/>
                        </a>
                        <button type="button" 
                                data-bs-toggle="modal" 
                                data-bs-target="#deleteCategory" 
                                data-delete-route="{{route('category.destroy', $category->id)}}"
                                data-delete-message="Do you really want to delete the {{$category->name}} category?"
                                class="btn btn-danger d-flex justify-content-center align-items-center p-1"
                        >
                            <x-utils.icon name='delete'/>
                        </button>
                    </div>
                </td>
            </tr>                                   
        @endforeach
    </tbody>
</table>