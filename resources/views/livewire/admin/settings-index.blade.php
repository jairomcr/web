<div>
    @if (session()->has('message'))
        <x-adminlte-alert theme="success" title="{{ session('message') }}" dismissable></x-adminlte-alert>
    @endif
    <form wire:submit.prevent="save" >
    <div class="card card-default">
        <div class="card-header">
            <h3 class="card-title">Empresa</h3>
    
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Nombre:</label>
                        <input type="text" class="form-control" wire:model="name"  placeholder="Introduce el nombre de la empresa">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Email:</label>
                        <input type="email" class="form-control" wire:model="email" placeholder="Introduce el correo de la empresa">
                        @error('email')
                         <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Título:</label>
                        <input type="text" class="form-control" wire:model="title" placeholder="Introduce un título">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Subtítulo:</label>
                        <input type="text" class="form-control" wire:model="subtitle" placeholder="Introduce un subtítulo o frase">
                        @error('subtitle')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>No. Teléfono:</label>
                        <input type="text" class="form-control" wire:model="phone" placeholder="Introduce el número de teléfono">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Logo:</label>
                        <input type="file" class="form-control mb-2" wire:model="logo" accept="image/*">
                        @error('logo')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if ($logoUrl && !$logo)
                            <img src="{{ $logoUrl }}" alt="Logo" style="max-width: 200px;">
                        @elseif ($logo)
                           <div class="mt-2">
                             <img src="{{ $logo->temporaryUrl() }}" alt="Imagen seleccionada"  class="img-fluid" style="max-width: 200px;">
                           </div>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>

                <!-- /.col -->
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Video:</label>
                        <input type="file" class="form-control" wire:model="video" accept="video/*">
                        @error('video')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <!-- Mostrar el video actual -->
                        @if ($videoUrl  && !$video)
                            <div class="mt-3">
                                <h3 class="h5">Video Actual</h3>
                                <div class="embed-responsive embed-responsive-16by9">
                                    <video class="embed-responsive-item" controls>
                                        <source src="{{$videoUrl}}" type="video/mp4">
                                        Tu navegador no soporta la reproducción de video.
                                    </video>
                                </div>                           
                            </div>
                        @elseif ($video)
                          
                            <h3 class="h5 mt-3">Vista Previa del Video</h3>
                            <div class="embed-responsive embed-responsive-16by9">
                                <video class="embed-responsive-item" controls>
                                    <source src="{{$video->temporaryUrl()}}" type="video/mp4">
                                    Tu navegador no soporta la reproducción de video.
                                </video>
                            </div>
                        @endif
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <div>
                            <button class="btn btn-primary" type="button" wire:click="$toggle('showExecutiveForm')">
                                {{ $showExecutiveForm ? 'Ocultar Ejecutivos' : 'Ver Ejecutivos' }}
                            </button>
                        </div>
                        @if ($showExecutiveForm)
                        <div>
                            <h3>Agregar Ejecutivo</h3>
                            <div>
                                <label for="executiveName">Nombre:</label>
                                <input type="text" id="executiveName" class="form-control" wire:model="newExecutive.name" placeholder="Introduce del ejecutivo">
                                @error('newExecutive.name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <div>
                                <label for="executivePosition">Cargo:</label>
                                <input type="text" class="form-control" id="executivePosition" wire:model="newExecutive.position" placeholder="Introduce el cargo que ocupa">
                                @error('newExecutive.position') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <div>
                                <label for="executivePhoto">Foto:</label>
                                <input type="file" class="form-control mb-3" id="executivePhoto" wire:model="newExecutive.photo">
                                @error('newExecutive.photo') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        
                            <button type="button" class="btn btn-primary" wire:click="addExecutive">Agregar</button>
                        </div>
                        @endif
                    </div>
                    <!-- Lista de ejecutivos -->
                    <div>
                        <h3>Ejecutivos</h3>
                        <ul class="list-group">
                            @foreach ($executives as $index => $executive)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <strong>{{ $executive['name'] }}</strong> - {{ $executive['position'] }}
                                    @if ($executive['photo'])
                                    <img src="{{ asset('storage/' . $executive['photo']) }}" alt="{{ $executive['name'] }}" width="50" class="ml-2 rounded-circle">
                                    @endif
                                </div>
                                <button type="button" class="btn btn-danger btn-sm mr-2" wire:click="removeExecutive({{ $index }})"><i class="fas fa-trash"></i></button>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- /.form-group -->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Enlaces de Redes Sociales:</label>
                        <input type="text" class="form-control mr-2 mb-3" wire:model="socialLinks.whatsapp" placeholder="WhatsApp...">
                        @error('socialLinks.whatsapp')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control mr-2 mb-3" wire:model="socialLinks.twitter" placeholder="Twitter...">
                        @error('socialLinks.twitter')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control mr-2 mb-3" wire:model="socialLinks.facebook" placeholder="Facebook...">
                        @error('socialLinks.facebook')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <input type="text" class="form-control mr-2 mb-3" wire:model="socialLinks.instagram" placeholder="Instagram...">
                        @error('socialLinks.instagram')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Descripción:</label>
                        <x-adminlte-textarea class="form-control" name="taBasic" wire:model="description" placeholder="Inserta una descripción..." />
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Extracto:</label>
                        <x-adminlte-textarea class="form-control" name="taBasic" wire:model="extract" placeholder="Inserta un extracto..." />
                        @error('extract')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                    @if ($settingId)
                     <button type="button" class="btn btn-danger" wire:click="delete">Eliminar</button>
                    @endif
                </div>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    </form>
</div>
