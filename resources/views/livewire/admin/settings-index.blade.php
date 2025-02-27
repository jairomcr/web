<div>
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
                        <label>Nombre</label>
                        <input type="text" class="form-control"  placeholder="Introduce el nombre de la empresa">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" placeholder="Introduce el correo de la empresa">
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Título</label>
                        <input type="text" class="form-control" placeholder="Introduce un título">
                    </div>
                    <!-- /.form-group -->
                    <div class="form-group">
                        <label>Subtítulo</label>
                        <input type="text" class="form-control" placeholder="Introduce un subtítulo o frase">
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>No. Teléfono</label>
                        <input type="text" class="form-control" placeholder="Introduce el número de teléfono">
                    </div>
                    <!-- /.form-group -->
                </div>
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Logo</label>
                        <x-adminlte-input-file name="img_file" placeholder="Choose an image...">
                            <x-slot name="prependSlot">
                                <div class="input-group-text text-lightblue">
                                    <i class="fas fa-upload"></i>
                                </div>
                            </x-slot>
                        </x-adminlte-input-file>
                    </div>
                    <!-- /.form-group -->
                </div>

                <!-- /.col -->
                <div class="col-12 col-sm-6">
                    <div class="form-group">
                        <label>Video</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="exampleInputFile">Elige un video</label>
                        </div>
                    </div>
                    <!-- /.form-group -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.card-body -->
    </div>
</div>
