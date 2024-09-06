<?php

    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use GuzzleHttp\Client;
    use App\Models\Boleto;
    use Carbon\Carbon;
    
    class BoletoController extends Controller
    {
        // Exibe boletos na dashboard
        public function index()
        {
            // Pega boletos
            $boletos = Boleto::all();
    
            // Verifica se o boleto está perto do vencimento (por exemplo, 7 dias)
            foreach ($boletos as $boleto) {
                $hoje = Carbon::now();
                $dataVencimento = Carbon::parse($boleto->data_vencimento);
                $diasParaVencimento = $dataVencimento->diffInDays($hoje, false);
    
                // Se o boleto estiver a 7 dias ou menos do vencimento, permitir download
                if ($diasParaVencimento <= 7 && $diasParaVencimento >= 0) {
                    $boleto->pode_baixar = true;
                } else {
                    $boleto->pode_baixar = false;
                }
            }
    
            return view('dashboard', compact('boletos'));
        }
    
        // Sincroniza boletos com a API da Hinova
        public function sincronizarBoletos()
        {
            $client = new Client();
    
            try {
                // Chamada à API da Hinova
                $response = $client->request('GET', 'https://api.hinova.com.br/api/sga/v2/boletos', [
                    'headers' => [
                        'Authorization' => 'Bearer 76649bff1ade8b3d3dc26c9283450799b963de740222e944abd2fa832535d7eccb0b22cdf1edc9325a9eec02d12f17a32b4e94bd18fac9bf1991c64f4121621907b55b6c85c24606cd8614a241fc942625f90765261fd5d890266d2e18218bbbb55636278a7ce8de6bed034bd0bb86628556b9f4ead9b208067a906bccc29501f126cfa4abde930a052db12c37cecc0b', // Substitua pelo seu token
                        'Accept' => 'application/json',
                    ],
                ]);
    
                if ($response->getStatusCode() == 200) {
                    $boletosData = json_decode($response->getBody()->getContents(), true);
    
                    
                    foreach ($boletosData['boletos'] as $boletoData) {
                        Boleto::updateOrCreate(
                            ['id' => $boletoData['id']],
                            [
                                'codigo_associado' => $boletoData['codigo_associado'],
                                'data_emissao' => $boletoData['dataEmissao'],
                                'valor' => $boletoData['valor'],
                                'status' => $boletoData['status'],
                                'link_download' => $boletoData['linkDownload'],
                                'data_vencimento' => $boletoData['dataVencimento'] ?? null, // Adiciona data de vencimento
                            ]
                        );
                    }
    
                    return redirect()->route('boletos.index')->with('success', 'Boletos sincronizados com sucesso!');
                } else {
                    return redirect()->route('boletos.index')->with('error', 'Falha ao sincronizar boletos.');
                }
            } catch (\Exception $e) {
                return redirect()->route('boletos.index')->with('error', 'Erro ao conectar com a API da Hinova.');
            }
        }
    
        // Função para download de boleto
        public function download($id)
        {
            $boleto = Boleto::findOrFail($id);
            return redirect($boleto->link_download);
        }
    }
    