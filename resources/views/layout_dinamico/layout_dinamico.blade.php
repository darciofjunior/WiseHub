{{--Se tiver logado, trago automaticamente o Layout do AdminLTE 3--}}

{{--Do contrário, trago o Layout normal--}}

@extends(Auth::user() ? 'adminlte::page' : 'layouts.app')