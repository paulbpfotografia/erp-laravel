<!-- Formulario POST. Si lleva otro método, lo cambiamos abajo. Enctype para permitir subida de archivos -->
<form method="POST" action="{{ $accion }}" enctype="multipart/form-data">
    @csrf

    <!-- Si el formulario no es POST, significa que es una actualización o eliminación (PUT, PATCH, DELETE).
         En ese caso, agregamos el método correspondiente de forma oculta. -->
    @if(isset($metodo) && $metodo !== 'POST')
        @method($metodo)
    @endif

    <!-- Iteramos sobre el array de campos que se pasa en la vista para generarlos dinámicamente -->
    @foreach($campos as $campo)
        <div class="mb-3">
            <!-- Etiqueta del campo para mostrar el nombre del campo en el formulario -->
            <label for="{{ $campo['nombre'] }}" class="form-label">{{ $campo['etiqueta'] }}</label>

            <!-- Si el campo es de tipo "select", generamos un desplegable con opciones -->
            @if ($campo['tipo'] === 'select')
                <select id="{{ $campo['nombre'] }}" name="{{ $campo['nombre'] }}" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror">
                 
                    <!-- Iteramos sobre las opciones que se han definido para este campo -->
                    @foreach($campo['opciones'] as $valor => $texto)
                        <option value="{{ $valor }}" 
                            {{ old($campo['nombre'], $valores[$campo['nombre']] ?? '') == $valor ? 'selected' : '' }}>
                            {{ $texto }}
                        </option>
                    @endforeach
                </select>

            <!-- Si el campo es un "textarea", generamos una caja de texto de varias líneas -->
            @elseif ($campo['tipo'] === 'textarea')
                <textarea id="{{ $campo['nombre'] }}" name="{{ $campo['nombre'] }}" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror">
                    {{ old($campo['nombre'], $valores[$campo['nombre']] ?? '') }}
                </textarea>

            <!-- Si el campo es de tipo archivo (file), generamos un input para subir archivos -->
            @elseif ($campo['tipo'] === 'file')
                <input id="{{ $campo['nombre'] }}" 
                    type="file" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror"        
                    name="{{ $campo['nombre'] }}">

            <!-- Si el campo es de cualquier otro tipo, generamos un input -->
            @else
                <input id="{{ $campo['nombre'] }}" 
                    type="{{ $campo['tipo'] }}" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror"        
                    name="{{ $campo['nombre'] }}" 
                    value="{{ old($campo['nombre'], $valores[$campo['nombre']] ?? '') }}" 
                    
                    <!-- Si el campo es obligatorio, agregamos el atributo required -->
                    {{ $campo['requerido'] ? 'required' : '' }}>
            @endif

            <!-- Si alguna validación no es correcta, se mostrará mensje de error -->
            @error($campo['nombre'])
                <span class="invalid-feedback">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endforeach

    <!-- Botón de envío -->
    <div class="text-center">
        <button type="submit" class="btn btn-success btn-lg">
            {{ $textoBoton }} <!-- Texto del botón de envío -->
        </button>
    </div>
</form>
