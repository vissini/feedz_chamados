<div class="box-body">
    {{ csrf_field() }}
    <div class="form-group">
      <label for="nome">Canal</label>
      <input type="text" class="form-control" name='name' id="name" placeholder="Nome do Canal" value="{{ old('name',$channel->name) }}">
    </div>
</div>
<!-- /.box-body -->