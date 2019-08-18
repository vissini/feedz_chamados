<div class="box-body">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="nome">Empresa</label>
      <input type="text" class="form-control" name='name' id="name" placeholder="Nome da Empresa" value="{{ old('name',$company->name) }}">
    </div>
</div>
<!-- /.box-body -->