<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\Infos\Create;
use App\Http\Requests\Users\Infos\Update;
use App\Models\Users\Info;
use Illuminate\Http\Request;

class InfosController extends Controller
{
    public function index()
    {
        throw new \Exception('invalid route');
    }

    public function store(Create $request)
    {
        $data = $request->only('code', 'info', 'user_id');

        try {
            $info = Info::create($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'There was a problem registering the info.',
                'success' => false,
                'error' => $th->getMessage(),
                'code' => $th->getCode()
            ], 500);
        }

        return response()->json(['data' => $info]);
    }

    public function show(string $id)
    {
        throw new \Exception('invalid route');
    }

    public function update(Update $request, string $id)
    {
        $data = $request->only('code', 'info', 'user_id');
        $info = Info::findOrFail($id);

        if ($data['user_id'] != $info->user_id) {
            throw new \Exception('invalid info: unauthorized');
        }

        try {
            $info->update($data);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'There was a problem update the info.',
                'success' => false,
                'error' => $th->getMessage(),
                'code' => $th->getCode()
            ], 500);
        }

        return response()->json(['data' => $info]);
    }

    public function destroy(string $id)
    {
        throw new \Exception('invalid route');
    }
}
