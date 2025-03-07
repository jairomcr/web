<div>
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <div class="col">
                    <div class="input-group">
                        <input wire:model.live="search" class="form-control" placeholder="Ingrese el nombre del usuario o correo....">
                        <span class="input-group-text">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($users->count())
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td width="10px">
                               @livewire('admin.users-edit', ['user' => $user], key( $user->id))
                            </td>
                            <td width="10px">
                                <a wire:click="dispatch('deleteUser',{ userId : {{$user->id}}})"
                                        class="btn btn-xs btn-default text-danger mx-1 shadow edit-button">
                                        <i class="fa fa-lg fa-fw fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <strong>No hay ninguna Usuario con ese nombre...</strong>
            @endif
        </div>
    </div>
    <!-- Pagination -->
    {{ $users->links() }}
</div>
