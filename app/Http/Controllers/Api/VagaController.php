<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vaga;

class VagaController extends Controller
{
    private $vaga;

    public function __construct(Vaga $vaga)
    {
        $this->vaga = $vaga;
    }

    public function index()
    {
        if(!$vagas = $this->vaga->with(['habilidade', 'local'])->orderBy('data_cadastro', 'ASC')->get())
            return response()->json(['mensagem' => 'Not Found Vaga(s) !'], 404);

        return response()->json($vagas);
    }

    public function show($id)
    {
        if(!$vaga = $this->vaga->find($id))
            return response()->json(['mensagem' => 'Not Found Vaga !'], 404);

        return response()->json($vaga);
    }

    public function store(Request $request)
    {
        $data                   = $request->all();
        $data['preco']          = $this->vaga->formatar_moeda($request->budget);
        $data['data_cadastro']  = date('Y-m-d');

        $vaga = $this->vaga->create($data);

        return response()->json($vaga, 201);
    }

    public function update(Request $request, $id)
    {
        if(!$vaga = $this->vaga->find($id))
            return response()->json(['mensagem' => 'Not Found Vaga !'], 404);

        $data                   = $request->all();
        $data['preco']          = $this->vaga->formatar_moeda($request->budget);
        $data['data_cadastro']  = date('Y-m-d');

        $vaga->update($data);

        return response()->json($vaga);
    }

    public function destroy($id)
    {
        if(!$vaga = $this->vaga->find($id))
            return response()->json(['mensagem' => 'Not Found Vaga !'], 404);

        $vaga->delete();

        return response()->json($vaga, 204);
    }
}
