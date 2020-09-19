<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreUpdateFormRequest;
use App\Http\Requests\CriarSenhaUpdateFormRequest;
use App\Mail\EnviarEmailUser;
use App\Models\Habilidade;
use App\Models\Local;
use App\Models\User;
use App\Models\UserHabilidade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    private $user;
    private $userhabilidade;

    public function __construct(User $user, UserHabilidade $userhabilidade)
    {
        $this->user             = $user;
        $this->userhabilidade   = $userhabilidade;
    }

    public function users()
    {
        $users = $this->user->with(['habilidades'])->get();
        
        return view('users.users', compact('users'));
    }

    public function create()
    {
        $habilidades        = Habilidade::pluck('habilidade', 'id');
        $locals             = Local::pluck('local', 'id');
        
        /*No primeiro momento não existe habilidade de usuário nenhum, afinal
        esse está sendo cadastrado ...*/
        $habilidades_user   = '';

        return view('users.cadastrar', compact('habilidades', 'locals', 'habilidades_user'));
    }

    public function store(UserStoreUpdateFormRequest $request)
    {
        $data                           = $request->all();
        $this->user->nome               = $data['nome'];
        $this->user->email              = $data['email'];
        $this->user->telefone           = $data['telefone'];
        $this->user->experiencia        = $data['experiencia'];
        $this->user->local_id           = $data['local_id'];
        $this->user->tipo_contratacao   = $data['tipo_contratacao'];
        $this->user->data_cadastro      = date('Y-m-d');
        
        $this->user->save();//Cria um novo usuário  ...
        $user_id        = $this->user->id;//Retorna o último id inserido ...
        $habilidades    = $data['habilidades_id'];

        //Salva as várias habilidades selecionadas pelo usuário na Combo ...
        foreach($habilidades as $habilidade_id)
        {
            $user_habilidades[] = [
		        'user_id'       => $user_id,
		        'habilidade_id' => $habilidade_id
	        ];
        }
        $this->userhabilidade->insert($user_habilidades);

        if($user_id) {
            return redirect()
                    ->route('user.enviar_email')
                    ->with('success', 'Usuário cadastrado com sucesso !');
        }else {
            return redirect()
                    ->back()
                    ->with('error', 'Falha ao cadastrar usuário !')
                    ->withInput();
        }
    }

    public function enviar_email()
    {
        $user = User::orderBy('id', 'DESC')->first();

        Mail::to($user->email)
            ->send(new EnviarEmailUser($user));

        return redirect()
                ->route('user.create')
                ->with('success', 'Email Enviado com Sucesso !');
    }

    public function senha(User $user)
    {
        /*******************************************************************/
        /****************Usuário já está logado no DashBoard****************/
        /*******************************************************************/
        if(Auth::check()) {//Loagdo no AdminLTE 3 ...
            $user   = Auth::User();
            $email  = Auth::User()->email;
        }else {//Não logado ...
            $email  = $user->email;
        }
        return view('users.senha', compact('user', 'email'));
    }

    public function salvar_senha(CriarSenhaUpdateFormRequest $request, $id)
    {
        //Verifico se esse usuário existe ...
        if(!$user = $this->user->find($id))
            return redirect()
                    ->back()
                    ->with('error', 'Esse usuário não existe !')
                    ->withInput();
        else 
            //Verifico se as senhas são iguais ...
            if($request->password != $request->confirmar_password)//As senhas são diferentes ...
                return redirect()
                        ->back()
                        ->with('error', 'As senhas estão diferentes !')
                        ->withInput();
            else//As senhas são iguais ...
                $dados              = $request->all();
                $dados['password']  = bcrypt($request->password);

                $user->update($dados);//Atualiza a Senha do Usuário ...

                /*******************************************************************/
                /****************Usuário já está logado no DashBoard****************/
                /*******************************************************************/
                if(Auth::check()) {//Loagdo no AdminLTE 3 ...
                    return redirect()
                            ->back()
                            ->with('success', 'Senha alterada com sucesso !');
                }else {
                    return redirect()
                            ->route('home')
                            ->with('success', 'Senha criada com sucesso, agora logo em nosso DashBoard !');
                }
    }

    public function edit()
    {
        if(Auth::check()) {//Loagdo no AdminLTE 3 ...
            $id = Auth::User()->id;

            //Verifico se esse Usuário existe ...
            if(!$user = $this->user->find($id))
                return redirect()
                        ->back()
                        ->with('error', 'Esse usuário não existe !')
                        ->withInput();
            else 
                $habilidades        = Habilidade::pluck('habilidade', 'id');
                $locals             = Local::pluck('local', 'id');
                $userhabilidade     = UserHabilidade::where('user_id', $id)->select('habilidade_id')->get();

                foreach($userhabilidade as $habilidade_id)
                {
                    $habilidades_user[] = $habilidade_id->habilidade_id;
                }

                return view('users.cadastrar', compact('user', 'habilidades', 'locals', 'habilidades_user'));
        }else {//Não está logado ...
            return redirect()
                    ->route('login');
        }
    }

    public function update(UserStoreUpdateFormRequest $request, $id)
    {
        //Verifico se esse Usuário existe ...
        if(!$user = $this->user->find($id))
            return redirect()
                    ->back()
                    ->with('error', 'Esse usuário não existe !')
                    ->withInput();
            else 
                $data                   = $request->all();
                $user->nome             = $data['nome'];
                $user->email            = $data['email'];
                $user->telefone         = $data['telefone'];
                $user->experiencia      = $data['experiencia'];
                $user->local_id         = $data['local_id'];
                $user->tipo_contratacao = $data['tipo_contratacao'];
          
                $user->save();//Atualiza os dados do Usuário ...

                $habilidades            = $data['habilidades_id'];
               
                //Deleta as habilidades atuais do Usuário ...
                $userhabilidade         = UserHabilidade::where('user_id', $id)->select('habilidade_id');
                $userhabilidade->delete();

                /*Salva as novas ou mesmas habilidades selecionadas pelo
                usuário na Combo ...*/
                foreach($habilidades as $habilidade_id)
                {
                    $user_habilidades[] = [
                        'user_id'       => $id,
                        'habilidade_id' => $habilidade_id
                    ];
                }
                $this->userhabilidade->insert($user_habilidades);

                return redirect()
                        ->back()
                        ->with('success', 'Usuário alterado com sucesso !');
        
    }
}
