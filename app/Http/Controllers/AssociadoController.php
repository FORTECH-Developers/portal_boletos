<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Models\Associado;

class AssociadoController extends Controller
{
    public function listarAssociados()
    {
        $client = new Client();
        
        try {
            // Solicitação à API
            $response = $client->request('GET', 'https://api.hinova.com.br/api/sga/v2/associados', [
                'headers' => [
                    'Authorization' => 'Bearer 48488d22d93533076c0d9e163a07527dd20458eb92ded0b4152e1076049ffb1d70983592559a3f18980e61ed330df61aafb97761ae524c8aed49a3dd36d59e7f0434b65c2bb5d8fd2792f9b4b9276b751d2f16cd73349f2cd5cc3056f9df29569a1c1b953b487474fa47fdc22c40ca5c6344ff041631dc0306fdca8f8de288732a9b35699dfb4b73d5be5b58c498f0e7', 
                    'Accept' => 'application/json',
                ],
            ]);

            // Verificar se a requisição foi bem-sucedida
            if ($response->getStatusCode() == 200) {
                $dados = json_decode($response->getBody()->getContents(), true);

                // Verifique se a chave 'associados' existe na resposta
                if (isset($dados['associados']) && is_array($dados['associados'])) {
                    // Processar cada associado
                    foreach ($dados['associados'] as $associado) {
                        Associado::updateOrCreate(
                            ['cpf' => $associado['cpf'] ?? null],
                            [
                                'codigo_associado' => $associado['codigo_associado'] ?? null,
                                'nome' => $associado['nome'] ?? null,
                                'sexo' => $associado['sexo'] ?? null,
                                'tipo_pessoa' => $associado['tipo_pessoa'] ?? null,
                                'data_nascimento' => $associado['data_nascimento'] ?? null,
                                'rg_associado' => $associado['rg_associado'] ?? null,
                                'email' => $associado['email'] ?? null,
                                'telefone_celular' => $associado['telefone_celular'] ?? null,
                            ]
                        );
                    }

                    return response()->json(['mensagem' => 'Associados salvos com sucesso']);
                } else {
                    return response()->json(['mensagem' => 'Nenhum associado encontrado na resposta'], 400);
                }
            } else {
                return response()->json(['mensagem' => 'Erro ao consultar a API'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['mensagem' => 'Erro: ' . $e->getMessage()], 500);
        }
    }
}
