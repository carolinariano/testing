<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="producto" class="form-label">{{ __('Producto') }}</label>
            <input type="text" name="Producto" class="form-control @error('Producto') is-invalid @enderror" value="{{ old('Producto', $producto?->Producto) }}" id="producto" placeholder="Producto">
            {!! $errors->first('Producto', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="descripcion" class="form-label">{{ __('Descripcion') }}</label>
            <input type="text" name="Descripcion" class="form-control @error('Descripcion') is-invalid @enderror" value="{{ old('Descripcion', $producto?->Descripcion) }}" id="descripcion" placeholder="Descripcion">
            {!! $errors->first('Descripcion', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="stock" class="form-label">{{ __('Stock') }}</label>
            <input type="text" name="Stock" class="form-control @error('Stock') is-invalid @enderror" value="{{ old('Stock', $producto?->Stock) }}" id="stock" placeholder="Stock">
            {!! $errors->first('Stock', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="precio" class="form-label">{{ __('Precio') }}</label>
            <input type="text" name="Precio" class="form-control @error('Precio') is-invalid @enderror" value="{{ old('Precio', $producto?->Precio) }}" id="precio" placeholder="Precio">
            {!! $errors->first('Precio', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>