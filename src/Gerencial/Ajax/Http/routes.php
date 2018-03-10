<?php

use Illuminate\Support\Facades\Route;



    Route::group(['prefix' => 'gerencial/ajax', 'middleware' => 'auth' ], function(){
    

        // PAGAMENTOS
        Route::post('pagamentos/getDatatable', 'PagamentosController@getDatatable')->name('pagamentos.ajax.getDatatable');        
        Route::resource('pagamentos', 'PagamentosController' , [
            'only' => [
                'index' 
            ] ,
            'names' => [
                //'create' => 'pagamentos.ajax.create' ,
                'index' => 'pagamentos.ajax.index' ,
               // 'edit' => 'pagamentos.ajax.edit' ,
               // 'update' => 'pagamentos.ajax.update' ,
               // 'store' => 'pagamentos.ajax.store' ,
               // 'show' => 'pagamentos.ajax.show' ,
                //'destroy' => 'pagamentos.ajax.destroy' ,
            ]
        ]); 

        //Route::post('pagamentos/confirma-operadora/{id}', 'PagamentosController@confirmarOperadora')->name('pagamentos.ajax.confirmarOperadora.id');
        Route::post('pagamentos/confirma-operadora', 'PagamentosController@confirmarOperadora')->name('pagamentos.ajax.confirmarOperadora');

        //Route::post('pagamentos/confirma-banco/{id}', 'PagamentosController@confirmarBanco')->name('pagamentosv.confirmarBanco.id');
        Route::post('pagamentos/confirma-banco', 'PagamentosController@confirmarBanco')->name('pagamentos.ajax.confirmarBanco');


        




        
        Route::get('relatorio/geral', 'GerencialController@home')->name('gerencial.ajax.relatorio.geral');
        Route::get('relatorio', 'GerencialController@index')->name('gerencial.ajax.relatorio.index');
        Route::post('relatorio/pagamentos', 'GerencialController@pagamentos')->name('ajax.relatorio-pagamentos-chart');
        Route::post('relatorio/atendimentos', 'GerencialController@atendimentos')->name('ajax.relatorio-atendimentos-chart');

        


    });