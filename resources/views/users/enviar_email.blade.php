<html>
    <body>
        <p>Olá {{ $user->nome }} !!!</p>
        <p></p>
        <p>Obrigado por você se cadastrar em nosso Site da WiseHub e seja muito bem vindo !!!</p>
        <p></p>
        <p>Agora crie uma senha para logar em seu DashBoard e usufluir dos recursos do nosso Sistema no link abaixo: <br>
        <p></p>
        <p>
            <li>
                <a href="{{ route('user.senha', ['user' => $user, 'email' => $user->email]) }}" class="btn btn-info btn-xs" role="button">
                    *** Criar Senha de Usuário WiseHub ***
                </a>
            </li>
        <br>
        <p></p>
        <p>Att WiseHub, <br>
    </body>
</html>