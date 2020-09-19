@extends('layout_dinamico.layout_dinamico')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <b>Salvar Senha de Usuário WiseHub</b>
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

                    {!! Form::model($user, ['route' => ['user.salvar_senha', $user->id], 'class' => 'form form-search form-ds', 'method' => 'PUT']) !!}
                        {!! Form::hidden('id', $user->id) !!}
                        
                        <div class="form-group">
                            <label for="email">E-mail: </label>
                            {!! Form::email('email', $user->email, ['class' => 'form-control', 'disabled']) !!}
                        </div>

                        <div class="form-group">
                            <label for="senha">Senha: </label>
                            {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Digite a Senha', 'required']) !!}
                        </div>

                        <div class="form-group">
                            <label for="confirmar_senha">Confirmar Senha: </label>
                            {!! Form::password('confirmar_password', ['class' => 'form-control', 'placeholder' => 'Confirme a Senha', 'required']) !!}
                        </div>

                        <div class="form-group" align="center">
                            {!! Form::submit('Salvar Senha', ['class' => 'btn btn-success']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop