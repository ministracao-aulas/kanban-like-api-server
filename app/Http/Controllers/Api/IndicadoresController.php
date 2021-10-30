<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class IndicadoresController extends Controller
{
    public static function routes()
    {
        Route::post('indicadores',  [self::class, 'new'])->name('indicadores.index');
        Route::post('varios',       [self::class, 'multi'])->name('indicadores.varios');
    }

    public function new(Request $request)
    {
        $tokens = [//Esse é um exemplo. !!! É necessário uma implementação mais segura
            'df5sdfsd54fsd6_012'  => 'abcjks879dhfkjdshfkjdshfdfskdfs',
            'df5sdfsd54fsd6_345'  => 'cdejksdhfkjdshfkjdshfdfs7367834kdfs',
        ];

        $request->validate([
            'vendas'    => 'required',
            'date'      => 'required',
            'vendedor'  => 'required',
            'app_id'    => 'required|in:'.implode(',', array_keys($tokens)),
            'app_token' => 'required',
        ]);

        $app_token_is_valid = $tokens[$request->app_id] === $request->app_token;

        if(!$app_token_is_valid)
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'Indicador registrado com sucesso'
        ], 201);
    }

    public function multi(Request $request)
    {
        $tokens = [//Esse é um exemplo. !!! É necessário uma implementação mais segura
            'df5sdfsd54fsd6_012'  => 'abcjks879dhfkjdshfkjdshfdfskdfs',
            'df5sdfsd54fsd6_345'  => 'cdejksdhfkjdshfkjdshfdfs7367834kdfs',
        ];

        $request->validate([
            'app_id'    => 'required|in:'.implode(',', array_keys($tokens)),
            'app_token' => 'required',
            'vendedores.*.vendas'    => 'required',
            'vendedores.*.date'      => 'required',
            'vendedores.*.code'      => 'required',
        ]);

        $app_token_is_valid = $tokens[$request->app_id] === $request->app_token;

        if(!$app_token_is_valid)
        {
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        }

        return response()->json([
            'message' => 'Indicador registrado com sucesso'
        ], 201);
    }
}
