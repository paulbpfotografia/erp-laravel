{{-- 



INSTUCCIONES DE USO:

Con esta plantilla crearemos formularios dinámicos. Así, si queremos modificar algo, se hará desde aquí.

Este es un ejemplo de como funciona. En la vista Blade deberíamos crear un código como este:

INCLUIMOS EN FORMULARIO EN LA VISTA
@include('partials.formulario', [
    //DECIMOS LA ACCIÓN QUE HARÁ. PASAMOS PARÁMETROS SI ES NECESARIO
    'accion' => route('usuarios.update', $user->id),
    //INDICAMOS MÉTODO. ESTO ES ÚTIL PARA LOS PUT Y PATCH. SI NO, SE RECOGE POST
    'metodo' => 'PUT',
    //CREAMOS UN ARRAY DE CAMPOS. Y LOS COMPLETAMOS CON SU NOMBRE, TIPO Y SI ES REQUERIDO EL CAMPO O NO.

    //ESTÁN CONTEMPLADOS TODOS LOS CAMPOS
    'campos' => [
        ['nombre' => 'name', 'etiqueta' => 'Nombre', 'tipo' => 'text', 'requerido' => true],

        ['nombre' => 'email', 'etiqueta' => 'Correo Electrónico', 'tipo' => 'email', 'requerido' => true],
        [
            'nombre' => 'rol', 
            'etiqueta' => 'Rol', 
            'tipo' => 'select', 
            //SI ES UN SELECT, DEBEMOS TRAER LOS DATOS Y CONVERTIRLOS EN UN ARRAY
            'opciones' => $roles->pluck('name', 'name')->toArray(), //Extraemos los roles como array para el select, y asignamos lo mismo en clave y en valor
            'requerido' => true
        ]
    ],
    'valores' => [
        'name' => $user->name,
        'email' => $user->email,
        'rol' => $user->roles->first()->name ?? ''
    ],
    //AÑADIMOS EL TEXTO DEL BOTÓN DE CONFIRMAR BOTÓN
    'textoBoton' => 'Guardar Cambios'
])

 --}}



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

            <!-- Si el campo es de tipo select, generamos un desplegable con opciones -->
            @if ($campo['tipo'] === 'select')
                <select id="{{ $campo['nombre'] }}" name="{{ $campo['nombre'] }}" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror" 
                    @if(isset($campo['requerido']) && $campo['requerido']) required @endif>
                    
                    <option value="" disabled selected>Seleccione una opción</option> 

                    <!-- Iteramos sobre los roles -->
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
                    class="form-control @error($campo['nombre']) is-invalid @enderror"
                    @if(isset($campo['requerido']) && $campo['requerido']) required @endif>{{ old($campo['nombre'], $valores[$campo['nombre']] ?? '') }}</textarea>

            <!-- Si el campo es de tipo archivo (file), generamos un input para subir archivos -->
            @elseif ($campo['tipo'] === 'file')
                <input id="{{ $campo['nombre'] }}" 
                    type="file" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror"        
                    name="{{ $campo['nombre'] }}"
                    accept="image/jpeg, image/png, image/jpg"
                    @if(isset($campo['requerido']) && $campo['requerido']) required @endif>

            <!-- Si el campo es de cualquier otro tipo, generamos un input -->
            @else
                <input id="{{ $campo['nombre'] }}" 
                    type="{{ $campo['tipo'] }}" 
                    class="form-control @error($campo['nombre']) is-invalid @enderror"        
                    name="{{ $campo['nombre'] }}" 
                    value="{{ old($campo['nombre'], $valores[$campo['nombre']] ?? '') }}" 
                    @if(isset($campo['requerido']) && $campo['requerido']) required @endif>
            @endif

            <!-- Si alguna validación no es correcta, se mostrará mensaje de error -->
            @error($campo['nombre'])
                <span class="invalid-feedback d-block">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    @endforeach

 <!-- Botón de envío -->
<div class="text-center">
    <button type="submit" class="btn btn-success btn-lg" onclick="console.log('Formulario enviado');">
        {{ $textoBoton }} <!-- Texto del botón de envío -->
    </button>
</div>

</form>
