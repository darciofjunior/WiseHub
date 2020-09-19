@extends('layout_dinamico.layout_dinamico')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Senha de Usuário WiseHub</b>
                </div>

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

                    @if(isset($user)) {{--Update --}}
                        {!! Form::model($user, ['route' => ['user.update', $user->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
                    @else {{--Insert --}}
                        {!! Form::open(['route' => 'user.store', 'class' => 'form form-search form-ds']) !!}
                    @endif

                        <div class="form-group">
                            <label for="nome">Nome: </label>
                            {!! Form::text('nome', null, ['class' => 'form-control', 'placeholder' => 'Digite o Nome', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="email">E-mail: </label>
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Digite o E-mail', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="telefone">Telefone: </label>
                            {!! Form::text('telefone', null, ['class' => 'form-control', 'placeholder' => 'Digite o Telefone', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="habilidades">Habilidades: </label>
                            <div class="col-md-6">
                                {!! Form::select('habilidades_id[]', $habilidades, $habilidades_user, ['id' => 'habilidades', 'class' => 'form-control', 'multiple' => 'multiple', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('radios', 'Experiência: ') !!}
                            <div class="radio">
                                {!! Form::radio('experiencia', '0', false, ['id' => 'radio_experiencia1', 'required']) !!}
                                &nbsp;
                                {!! Form::label('radio_experiencia1', '0-1 anos') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                {!! Form::radio('experiencia', '1', false, ['id' => 'radio_experiencia2']) !!}
                                &nbsp;
                                {!! Form::label('radio_experiencia2', '1-3 anos') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                
                                {!! Form::radio('experiencia', '3', false, ['id' => 'radio_experiencia3']) !!}
                                &nbsp;
                                {!! Form::label('radio_experiencia3', '3-5 anos') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                {!! Form::radio('experiencia', '5', false, ['id' => 'radio_experiencia4']) !!}
                                &nbsp;
                                {!! Form::label('radio_experiencia4', '5-7 anos') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                {!! Form::radio('experiencia', '7', false, ['id' => 'radio_experiencia5']) !!}
                                &nbsp;
                                {!! Form::label('radio_experiencia5', '+7 anos') !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="local_id">Local: </label>
                            <div class="col-md-6">
                                {!! Form::select('local_id', $locals, null, ['class' => 'form-control', 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            {!! Form::label('radios', 'Tipo de Contratação: ') !!}
                            <div class="radio">
                                {!! Form::radio('tipo_contratacao', 'PJ', false, ['id' => 'radio_tipo_contratacao1', 'required']) !!}
                                &nbsp;
                                {!! Form::label('radio_tipo_contratacao1', 'PJ') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                {!! Form::radio('tipo_contratacao', 'CLT', false, ['id' => 'radio_tipo_contratacao2']) !!}
                                &nbsp;
                                {!! Form::label('radio_tipo_contratacao2', 'CLT') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                {!! Form::radio('tipo_contratacao', 'Temporário', false, ['id' => 'radio_tipo_contratacao3']) !!}
                                &nbsp;
                                {!! Form::label('radio_tipo_contratacao3', 'Temporário') !!}
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            
                                {!! Form::radio('tipo_contratacao', 'Estagiário', false, ['id' => 'radio_tipo_contratacao4']) !!}
                                &nbsp;
                                {!! Form::label('radio_tipo_contratacao4', 'Estagiário') !!}
                            </div>
                        </div>

                        <div class="form-group" align="center">
                            {!! Form::submit('Enviar', ['class' => 'btn btn-success']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop