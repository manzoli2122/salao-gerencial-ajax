<?php

namespace Manzoli2122\Salao\Gerencial\Ajax\Http\Controllers;

use Illuminate\Http\Request;
use Manzoli2122\Salao\Atendimento\Ajax\Models\Atendimento;
use Manzoli2122\Salao\Atendimento\Ajax\Models\Pagamento;
use Manzoli2122\Salao\Atendimento\Ajax\Models\AtendimentoFuncionario;
use Manzoli2122\Salao\Atendimento\Ajax\Models\ProdutosVendidos;
use Manzoli2122\Salao\Despesas\Ajax\Models\Despesa;


use Manzoli2122\Salao\Cadastro\Http\Controllers\Padroes\Controller ;

use Carbon\Carbon;

class GerencialController extends Controller
{
 

    protected $pagamento;
    protected $despesa;


    public function __construct( Pagamento $pagamento , Despesa $despesa ){
        $this->middleware('auth');

        $this->pagamento = $pagamento;
        $this->despesa = $despesa;

    }  
       


    public function index()
    {

        return view( "gerencial::relatorio.index" );
    }
        




    public function pagamentos(Request $request)
    {      
        $dataForm = $request->except('_token');        
        $dataString = $dataForm['data'] ;  
        $data = Carbon::createFromFormat('Y-m-d', $dataString);
        
        //$dia = 30;      
        $dia = $dataForm['dia'] ;        
        //$models = $this->model->whereDate('created_at', $dataForm['key'])->get();        
        //$data['models'] = $models;
        return view('gerencial::relatorio.graficos.pagamentos.pagamentos' , compact('data', 'dia'));
    }


    public function atendimentos(Request $request)
    {      
        $dataForm = $request->except('_token');        
        $dataString = $dataForm['data'] ;  
        $data = Carbon::createFromFormat('Y-m-d', $dataString);
        
        //$dia = 30;      
        $dia = $dataForm['dia'] ;        
        //$models = $this->model->whereDate('created_at', $dataForm['key'])->get();        
        //$data['models'] = $models;
        return view('gerencial::relatorio.graficos.atendimentos.atendimentos' , compact('data', 'dia'));
    }



    public function home()
    {

        $pagamentos = $this->pagamento->where('formaPagamento','<>', 'fiado')->sum('valor');
        $pagamentosFiados = $this->pagamento->where('formaPagamento', 'fiado')->sum('valor');
        $despesas = $this->despesa->sum('valor');

        return view("gerencial::relatorio.teste",compact('pagamentos', 'despesas','pagamentosFiados'));
    }







}
