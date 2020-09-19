<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Local;
use App\Http\Requests\LocalStoreUpdateFormRequest;

class LocalController extends Controller
{
    private $local;

    public function __construct(Local $local)
    {
        $this->local = $local;
    }

    public function index()
    {
        if(!$locals = $this->local->orderBy('local', 'ASC')->get())
            return response()->json(['mensagem' => 'Not Found Local(s) !'], 404);

        return response()->json($locals);
    }

    public function show($id)
    {
        if(!$local = $this->local->find($id))
            return response()->json(['mensagem' => 'Not Found Local !'], 404);

        return response()->json($local);
    }

    public function store(LocalStoreUpdateFormRequest $request)
    {       
        $local = $this->local->create($request->all());

        return response()->json($local, 201);
    }

    public function update(LocalStoreUpdateFormRequest $request, $id)
    {
        if(!$local = $this->local->find($id))
            return response()->json(['mensagem' => 'Not Found Local !'], 404);

        $local->update($request->all());

        return response()->json($local);
    }

    public function destroy($id)
    {
        if(!$local = $this->local->find($id))
            return response()->json(['mensagem' => 'Not Found Local !'], 404);

        $local->delete();

        return response()->json($local, 204);
    }
}
