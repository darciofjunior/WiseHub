<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Habilidade;
use App\Http\Requests\HabilidadeStoreUpdateFormRequest;

class HabilidadeController extends Controller
{
    private $habilidade;

    public function __construct(Habilidade $habilidade)
    {
        $this->habilidade = $habilidade;
    }

    public function index()
    {
        if(!$habilidades = $this->habilidade->orderBy('habilidade', 'ASC')->get())
            return response()->json(['mensagem' => 'Not Found Habilidade(s) !'], 404);

        return response()->json($habilidades);
    }

    public function show($id)
    {
        if(!$habilidade = $this->habilidade->find($id))
            return response()->json(['mensagem' => 'Not Found Habilidade !'], 404);

        return response()->json($habilidade);
    }

    public function store(HabilidadeStoreUpdateFormRequest $request)
    {
        $habilidade = $this->habilidade->create($request->all());

        return response()->json($habilidade, 201);
    }

    public function update(HabilidadeStoreUpdateFormRequest $request, $id)
    {
        if(!$habilidade = $this->habilidade->find($id))
            return response()->json(['mensagem' => 'Not Found Habilidade(s) !'], 404);

        $habilidade->update($request->all());

        return response()->json($habilidade);
    }

    public function destroy($id)
    {
        if(!$habilidade = $this->habilidade->find($id))
            return response()->json(['mensagem' => 'Not Found Habilidade !'], 404);

        $habilidade->delete();

        return response()->json($habilidade, 204);
    }
}
