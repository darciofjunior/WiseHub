<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Vaga;
use App\Models\VagaUser;

class ControlarVagaController extends Controller
{
    private $vaga;
    private $vagauser;

    public function __construct(Vaga $vaga, VagaUser $vagauser)
    {
        $this->vaga     = $vaga;
        $this->vagauser = $vagauser;
    }

    public function divulgar()
    {
        $vagas = DB::table('vagas AS v')
                    ->select('v.*', 'h.habilidade', 'l.local', 'u.id AS user_id', 'u.nome', 'u.email', 'u.telefone')
                    ->join('locals AS l', 'l.id', '=', 'v.local_id')
                    ->join('habilidades AS h', 'h.id', '=', 'v.habilidade_id')
                    ->join('user_habilidades AS uh', 'uh.habilidade_id', '=', 'h.id')
                    ->join('users AS u', 'u.id', '=', 'uh.user_id')
                    ->where('v.contatado_por', null)
                    ->get();

        return view('vagas.divulgar', compact('vagas'));
    }

    public function atualizar_interesse(Request $request)
    {
        for($i = 0; $i < $request->total_vagas; $i++)
        {
            //Distribui as vagas oferecidas ao usuário ...
            $vaga_users[] = [
		        'vaga_id'   => $request->vaga_id[$i],
                'user_id'   => $request->user_id[$i],
            ];
            
            //Localiza a Vaga através de seu ID ...
            $vaga = $this->vaga->find($request->vaga_id[$i]);

            //Atualiza os dados da Vaga com o FeedBack ...
            $vaga->contatado_por    =  $request->contatado_por[$i];
            $vaga->interessado      =  $request->interessado[$i];
            $vaga->data_contato     =  date('Y-m-d');
            $vaga->save();
        }

        //Distribui as vagas oferecidas ao usuário ...
        $this->vagauser->insert($vaga_users);

        return redirect()
                ->route('vaga.feedback')
                ->with('success', 'FeedBack(s) atualizado(s) com sucesso !');
    }

    public function feedback()
    {
        $vagas = $this->vaga->with(['habilidade', 'local'])->orderBy('data_cadastro', 'ASC')->get();
        
        return view('vagas.feedback', compact('vagas'));
    }

    public function feedback_detalhes($id)
    {
        $vaga = DB::table('vagas AS v')
                    ->select('v.*', 'h.habilidade', 'l.local', 'u.id AS user_id', 'u.nome', 'u.email', 'u.telefone')
                    ->join('locals AS l', 'l.id', '=', 'v.local_id')
                    ->join('habilidades AS h', 'h.id', '=', 'v.habilidade_id')
                    ->join('user_habilidades AS uh', 'uh.habilidade_id', '=', 'h.id')
                    ->join('users AS u', 'u.id', '=', 'uh.user_id')
                    ->where('v.id', $id)
                    ->get();
        
        return view('vagas.feedback_detalhes', compact('vaga'));
    }
}
