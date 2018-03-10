<?php

namespace Manzoli2122\Salao\Gerencial\Ajax\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\Salao\Atendimento\Ajax\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Ajax\Models\Pagamento;
use Manzoli2122\Salao\Atendimento\Ajax\Models\AtendimentoFuncionario;
use Manzoli2122\Salao\Atendimento\Ajax\Models\ProdutosVendidos;
use Manzoli2122\Salao\Despesas\Ajax\Models\Despesa;


use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Carbon\Carbon;

class GerencialController extends BaseController
{
 
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    protected $pagamento;
    protected $despesa;


    public function __construct( Pagamento $pagamento , Despesa $despesa ){
        $this->middleware('auth');

        $this->pagamento = $pagamento;
        $this->despesa = $despesa;

    }  
       


    public function index()
    {

        return view( "gerencialAjax::relatorio.index" );
    }
        




    public function pagamentos(Request $request)
    {      
        $dataForm = $request->except('_token');        
        $dataString = $dataForm['data'] ;  
        $data = Carbon::createFromFormat('Y-m-d', $dataString);
        
        $dia = $dataForm['dia'] ;   
        return view('gerencialAjax::relatorio.graficos.pagamentos.pagamentos' , compact('data', 'dia'));
    }


    public function atendimentos(Request $request)
    {      
        $dataForm = $request->except('_token');        
        $dataString = $dataForm['data'] ;  
        $data = Carbon::createFromFormat('Y-m-d', $dataString);
            
        $dia = $dataForm['dia'] ; 
        return view('gerencialAjax::relatorio.graficos.atendimentos.atendimentos' , compact('data', 'dia'));
    }



    public function home()
    {

        $pagamentos = $this->pagamento->where('formaPagamento','<>', 'fiado')->sum('valor');
        $pagamentosFiados = $this->pagamento->where('formaPagamento', 'fiado')->sum('valor');
        $despesas = $this->despesa->sum('valor');

        return view("gerencialAjax::relatorio.teste",compact('pagamentos', 'despesas','pagamentosFiados'));
    }







}
