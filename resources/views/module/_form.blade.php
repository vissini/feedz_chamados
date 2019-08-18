<div class="box-body">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="nome">Módulo</label>
      <input type="text" class="form-control" name='name' id="name" placeholder="Nome do Módulo" value="{{ old('name',$module->name) }}">
    </div>
</div>
<!-- /.box-body -->