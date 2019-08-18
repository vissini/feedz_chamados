<div class="box-body">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="nome">Tipo</label>
      <input type="text" class="form-control" name='name' id="name" placeholder="Tipo" value="{{ old('name',$type->name) }}">
    </div>
</div>
<!-- /.box-body -->