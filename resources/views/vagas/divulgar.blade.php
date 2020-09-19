@extends('layouts.app')

@section('content')

<div class="card-body">
    <div class="table-responsive">
        {!! Form::open(['route' => 'vaga.atualizar_interesse', 'class' => 'form form-search form-ds']) !!}
            {!! Form::hidden('total_vagas', count($vagas)) !!}
                <table class="table table-bordered table-striped">
                    @if(count($vagas) > 0)
                    <thead>
                        <tr class="card-header" align="center">
                            <th colspan="3">
                                Dados de Usuário
                            </th>
                            <th colspan="4">
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
                                Contatado Por
                            </th>
                            <th>
                                Interessado
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($vagas as $vaga)
                    <tr align="center">
                        <td>
                            {{ $vaga->nome }}
                            {!! Form::hidden('vaga_id[]', $vaga->id) !!}
                            {!! Form::hidden('user_id[]', $vaga->user_id) !!}
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
                            {!! Form::select('contatado_por[]', ['' => 'SELECIONE', 'Email' => 'Email', 'Telefone' => 'Telefone', 'Sem Contato' => 'Sem Contato'], null, ['class' => 'form-control', 'required']) !!}
                        </td>
                        <td>
                            {!! Form::select('interessado[]', ['' => 'SELECIONE', 'SIM' => 'SIM', 'NÃO' => 'NÃO'], null, ['class' => 'form-control', 'required']) !!}
                        </td>
                    </tr>
                    @endforeach
                    <tr align="center">
                        <td colspan="9">
                            {!! Form::submit('Enviar', ['class' => 'btn btn-success']) !!}
                        </td>
                    </tr>
                    </tbody>
                    @else
                    <thead>
                        <tr class="card-header" align="center">
                            <th>
                                Talvez haja vaga(s) mais não tem usuários para as mesma(s) cadastrada(s) !!!
                                <br/>

                                Confira as vagas(s) cadastrada(s) nos botões abaixo !!!
                                <br/><br/>

                                <a href="/vagas/" class="btn btn-success">
                                    Vagas
                                </a>
                                &nbsp;
                                <a href="/feedback/" class="btn btn-primary">
                                    FeedBack
                                </a>
                            </th>
                        </tr>
                    </thead>
                    @endif
                </table>
        {!! Form::close() !!}
    </div>
</div>

@endsection