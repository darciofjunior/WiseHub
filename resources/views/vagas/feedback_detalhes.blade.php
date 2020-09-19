@extends('layouts.app')

@section('content')

<div class="card-body">
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr class="card-header" align="center">
                    <th colspan="3">
                        Dados de Usuário
                    </th>
                    <th colspan="6">
                        Dados da Vaga
                    </th>
                    <th colspan="2">
                        FeedBack
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
                @foreach($vaga as $vaga)
                <tr align="center">
                    <td>
                        {{ $vaga->nome }}
                    </td>
                    <td>
                        {{ $vaga->email }}
                    </td>
                    <td>
                        {{ $vaga->telefone }}
                    </td>
                    <td>
                        {{ $vaga->habilidade }}
                    </td>
                    <td>
                        {{ $vaga->local }}
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
                <tr align="center">
                    <td colspan="11">
                        <a href="/feedback/" class="btn btn-success">
                            Voltar
                        </a>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection