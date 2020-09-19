@extends('layouts.app')

@section('content')

<div class="card-body">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @include('errors.errors')

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="card-header" align="center">
                    <th colspan="8">
                        Users
                    </th>
                </tr>
                <tr class="card-header" align="center">
                    <th>
                        Nome
                    </th>
                    <th>
                        E-mail
                    </th>
                    <th>
                        Telefone
                    </th>
                    <th>
                        Habilidades
                    </th>
                    <th>
                        Experiência
                    </th>
                    <th>
                        Local
                    </th>
                    <th>
                        Tipo de Contratação
                    </th>
                    <th>
                        Data de Cadastro
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach($users as $user)
                <tr align="center">
                    <td align="left">
                        {{ $user->nome }}
                    </td>
                    <td>
                        {{ $user->email }}
                    </td>
                    <td>
                        {{ $user->telefone }}
                    </td>
                    <td>
                        @foreach($user->habilidades as $habilidade)
                            {{ $habilidade->habilidade }}<br/>
                        @endforeach
                    </td>
                    <td>
                        @if ($user->experiencia == 0)
                            0-1 anos
                        @elseif ($user->experiencia == 1)
                            1-3 anos
                        @elseif ($user->experiencia == 3)
                            3-5 anos
                        @elseif ($user->experiencia == 5)
                            5-7 anos
                        @else
                            +7 anos
                        @endif
                    </td>
                    <td>
                        {{ $user->local->local }}
                    </td>
                    <td>
                        {{ $user->tipo_contratacao }}
                    </td>
                    <td>
                        {{ formatDateAndTime($user->data_cadastro, 'd/m/Y') }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection