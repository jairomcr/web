<div class="card">
    <div class="card-header">
        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre de un artículos">
    </div>
    @if ($posts->count())
        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Creado por</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                    <tr>
                        <td>{{$post->id}}</td>
                        <td>{{$post->name}}</td>
                        <td>{{$post->user->name}}</td>
                        <td width="10px">
                            <a href="{{route('admin.posts.edit',$post)}}"
                                class="btn btn-xs btn-default text-primary mx-1 shadow edit-button">
                                <i class="fa fa-lg fa-fw fa-pen"></i>
                            </a>
                        </td>
                        <td width="10px">
                            {{-- Deleting the posts --}}
                            {!! html()->form('POST', route('admin.posts.destroy', $post))->open() !!}
                            {!! csrf_field() !!}
                            {!! method_field('DELETE') !!}
                            <button type="submit" class="btn btn-xs btn-default text-danger mx-1 shadow"
                                onclick="confirmation(event)">
                                <i class="fa fa-lg fa-fw fa-trash"></i>
                            </button>
                            {!! html()->form()->close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        
        </div>
        <div class="footer px-3">
            {{$posts->links()}}
        </div>
    @else
        <div class="card-body">
            <strong>No hay ningún artículo con ese nombre ....</strong>
        </div>
        
    @endif
</div>


