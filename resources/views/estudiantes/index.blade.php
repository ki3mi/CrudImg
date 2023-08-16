<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Estudiantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <a type="button" href="{{ route('estudiantes.create') }}" class="bg-indigo-500 px-12 py-2 rounded text-gray-200 font-semibold hover:bg-indigo-800 transition duration-200 each-in-out">Crear</a>

                <table class="table-fixed w-full">
                    <thead>
                        <tr class="bg-gray-800 text-white">
                            <th style="display: none;">ID</th>
                            <th class="border px-4 py-2">NOMBRE</th>
                            <th class="border px-4 py-2">APELLIDOS</th>
                            <th class="border px-4 py-2">DNI</th>
                            <th class="border px-4 py-2">FOTO</th>
                            <th class="border px-4 py-2">ACCIÓN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $estudiantes as $estudiante )
                            <tr>
                                <td style="display: none;">{{ $estudiante->id }}</td>
                                <td class="text-white">{{ $estudiante->nombre }}</td>
                                <td class="text-white">{{ $estudiante->apellido }}</td>
                                <td class="text-white">{{ $estudiante->dni }}</td>
                                <td>
                                    <img src="/imagen/{{ $estudiante->imagen }}" width="60%">
                                </td>
                                <td class="boroder px-4 py-2">
                                    <div class="flex justify-center rounded-lg text-lg" role="group">
                                        {{-- boton editar --}}
                                        <a href="{{ route('estudiantes.edit', $estudiante->id) }}" class="rounded bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4">Editar</a>
                                        {{-- boton borrar --}}
                                        <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" class="formEliminar">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="rounded bg-pink-400 hover:bg-pink-500 text-white font-bold py-2 px-4">Borrar</button>
                                        </form>                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div>
                    {!! $estudiantes->links() !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    (function () {
  'use strict'
  //debemos crear la clase formEliminar dentro del form del boton borrar
  //recordar que cada registro a eliminar esta contenido en un form  
  var forms = document.querySelectorAll('.formEliminar')
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {        
          event.preventDefault()
          event.stopPropagation()        
          Swal.fire({
                title: '¿Confirma la eliminación del registro?',        
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#20c997',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Confirmar'
            }).then((result) => {
                if (result.isConfirmed) {
                    this.submit();
                    Swal.fire('¡Eliminado!', 'El registro ha sido eliminado exitosamente.','success');
                }
            })                      
      }, false)
    })
    })()
</script>