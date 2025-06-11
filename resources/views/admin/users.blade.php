@extends('layouts.admin')
@section('content')
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
                                            <div class="text-tiny">Usuarion</div>
                                        </li>
                                    </ul>
                                </div>

                                <div class="wg-box">
                                    <div class="flex items-center justify-between gap10 flex-wrap">
                                        <div class="wg-filter flex-grow">
                                            <form class="form-search">
                                               <fieldset class="name">
                                        <!--            <input type="text" placeholder="Search here..." class="" name="name"
                                                        tabindex="2" value="" aria-required="true" required="">-->
                                                </fieldset>
                                                <div class="button-submit">
                                              <!--      <button class="" type="submit"><i class="icon-search"></i></button>-->
                                                </div>
                                            </form>
                                        </div>
                                        
                                    </div>
                                    <div class="wg-table table-all-user">

                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Usuario</th>
                                                        <th>Mobil</th>
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
                                                            <form method="POST" action="{{ route('admin.user.update.utype', $user->id) }}" style="display:inline;">
                                                                @csrf
                                                                @method('PUT')
                                                                <select name="utype" onchange="this.form.submit()" style="min-width:80px;">
                                                                    <option value="USR" {{ $user->utype == 'USR' ? 'selected' : '' }}>USR</option>
                                                                    <option value="ADM" {{ $user->utype == 'ADM' ? 'selected' : '' }}>ADM</option>
                                                                </select>
                                                            </form>
                                                        </td>
                                                        <td>
                                                            <div class="list-icon-function">
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
                                        {{--  --}}
                                    </div>
                                </div>
                            </div>
                        </div>
@endsection