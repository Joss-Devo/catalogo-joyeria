@extends('layouts.admin')

@section('content')
@if (session('success'))
    <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
        {{ session('error') }}
    </div>
@endif

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Usuarios</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}" class="flex items-center gap5">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <a href="{{route('admin.users')}}" class="flex items-center gap5">
                        <div class="text-tiny">Usuarios</div>
                    </a>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap mb-4">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <!-- Input de búsqueda si lo necesitas -->
                        </fieldset>
                        <div class="button-submit">
                            <!-- Botón buscar -->
                        </div>
                    </form>
                </div>
                <div>
                   <a href="{{ route('admin.users.create') }}" class="btn btn-success">
                        <i class="icon-plus"></i> Agregar Usuario
                    </a> 
                </div>
            </div>

            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Usuario</th>
                                <th>Móvil</th>
                                <th>Email</th>
                                <th>Rol</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="pname">
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{ $user->name }}</a>
                                        <div class="text-tiny mt-3">{{ strtoupper($user->role ?? 'USR') }}</div>
                                    </div>
                                </td>
                                <td>{{ $user->mobile }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <!-- Editar utype -->
                                   <form method="POST" action="{{ route('admin.user.update.utype', $user->id) }}" style="display:inline;" class="utype-form">
                                    @csrf
                                    @method('PUT')
                                    <select name="utype" class="utype-select" data-original="{{ $user->utype }}" style="min-width:80px;">
                                        <option value="USR" {{ $user->utype == 'USR' ? 'selected' : '' }}>USR</option>
                                        <option value="ADM" {{ $user->utype == 'ADM' ? 'selected' : '' }}>ADM</option>
                                    </select>
                                </form>

                                </td>
                                <td>
                                    <div class="list-icon-function flex items-center gap-2">
                                        <!-- Editar usuario -->
                                      <a href="{{ route('admin.user.edit', $user->id) }}" class="text-primary">
                                            <i class="icon-edit-3"></i>
                                        </a> 

                                        <!-- Eliminar usuario -->
                                        <form method="POST" action="{{ route('admin.user.delete', $user->id) }}" style="display:inline;" onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="item text-danger delete" style="background:none;border:none;padding:0;">
                                                <i class="icon-trash-2"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
       
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.utype-select').forEach(select => {
        select.addEventListener('change', function(e) {
            const form = this.closest('form');
            const confirmed = confirm('¿Seguro que deseas cambiar el rol de este usuario?');
            if (confirmed) {
                form.submit();
            } else {
                // Restaurar el valor original
                this.value = this.dataset.original;
            }
        });
    });
</script>
@endpush
