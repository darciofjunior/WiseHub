@extends('layouts.app')

@section('content')

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="card-header" align="center">
                    <th colspan="8">
                        Vagas
                    </th>
                </tr>
                <tr class="card-header" align="center">
                    <th>
                        Habilidade
                    </th>
                    <th>
                        Local
                    </th>
                    <th>
                        Tipo de Contratação
                    </th>
                    <th>
                        Budget
                    </th>
                    <th>
                        Data de Cadastro
                    </th>
                    <th>
                        Contatado Por
                    </th>
                    <th>
                        Interessado
                    </th>
                    <th>
                        Data de Contato
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($vagas as $vaga)
                <tr align="center">
                    <td>
                        @if($vaga->data_contato)
                            <a href="/feedback_detalhes/{{ $vaga->id }}">
                        @endif
                        {{ $vaga->habilidade->habilidade }}
                    </td>
                    <td>
                        {{ $vaga->local->local }}
                    </td>
                    <td>
                        {{ $vaga->tipo_contratacao }}
                    </td>
                    <td align="right">
                        R$ {{ number_format($vaga->budget, 2, ',', '.') }}
                    </td>
                    <td>
                        {{ formatDateAndTime($vaga->data_cadastro, 'd/m/Y') }}
                    </td>
                    <td>
                        {{ $vaga->contatado_por }}
                    </td>
                    <td>
                        {{ $vaga->interessado }}
                    </td>
                    <td>
                        @if($vaga->data_contato)
                            {{ formatDateAndTime($vaga->data_contato, 'd/m/Y') }}
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection