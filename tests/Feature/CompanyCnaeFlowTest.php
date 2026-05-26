<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyCnaeFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_store_company_with_multiple_secondary_cnaes(): void
    {
        $this->actingAs($user = User::factory()->create());

        $response = $this->post(route('companies.store'), $this->validPayload([
            'cnpj' => '12.345.678/0001-90',
            'cnae_primario_codigo' => ' 6319-4/00 ',
            'cnae_primario_descricao' => ' Portais, provedores de conteudo ',
            'cnaes_secundarios' => [
                ['codigo' => '6201-5/01', 'descricao' => 'Desenvolvimento de software sob encomenda'],
                ['codigo' => '6204-0/00', 'descricao' => 'Consultoria em TI'],
            ],
        ]));

        $response->assertRedirect(route('companies.index'));

        $company = Company::query()->firstOrFail();

        $this->assertSame('6319-4/00', $company->cnae_primario_codigo);
        $this->assertSame('Portais, provedores de conteudo', $company->cnae_primario_descricao);
        $this->assertSame([
            ['codigo' => '6201-5/01', 'descricao' => 'Desenvolvimento de software sob encomenda'],
            ['codigo' => '6204-0/00', 'descricao' => 'Consultoria em TI'],
        ], $company->cnaes_secundarios);
    }

    public function test_can_update_company_secondary_cnaes(): void
    {
        $this->actingAs($user = User::factory()->create());

        $company = Company::create([
            'user_id' => $user->id,
            'razao_social' => 'Empresa Base LTDA',
            'nome_fantasia' => 'Empresa Base',
            'contato' => 'Ana',
            'cnpj' => '12345678000190',
            'regime_tributario' => 'Simples Nacional',
            'natureza_juridica' => '2062',
            'porte' => 'ME',
            'cnae_primario_codigo' => '6201-5/01',
            'cnae_primario_descricao' => 'Desenvolvimento de software',
            'cnaes_secundarios' => [
                ['codigo' => '6202-3/00', 'descricao' => 'Desenvolvimento e licenciamento'],
            ],
            'endereco' => 'Rua A',
            'cidade' => 'Sao Paulo',
            'estado' => 'SP',
            'cep' => '01001000',
            'pais' => 'Brasil',
            'nfse_environment' => 'homologacao',
        ]);

        $response = $this->put(route('companies.update', $company), $this->validPayload([
            'cnpj' => '12.345.678/0001-90',
            'active_tab' => 'tab-cnae',
            'cnae_primario_codigo' => ' 6201-5/01 ',
            'cnae_primario_descricao' => ' Desenvolvimento de software ',
            'cnaes_secundarios' => [
                ['codigo' => '6204-0/00', 'descricao' => 'Consultoria em TI'],
                ['codigo' => '6311-9/00', 'descricao' => 'Tratamento de dados'],
            ],
        ]));

        $response->assertRedirect(route('companies.edit', $company).'?tab=tab-cnae#tab-cnae');

        $company->refresh();

        $this->assertSame('6201-5/01', $company->cnae_primario_codigo);
        $this->assertSame('Desenvolvimento de software', $company->cnae_primario_descricao);
        $this->assertSame([
            ['codigo' => '6204-0/00', 'descricao' => 'Consultoria em TI'],
            ['codigo' => '6311-9/00', 'descricao' => 'Tratamento de dados'],
        ], $company->cnaes_secundarios);
    }

    public function test_secondary_cnae_requires_code_and_description_together(): void
    {
        $this->actingAs(User::factory()->create());

        $response = $this->from(route('companies.create'))
            ->post(route('companies.store'), $this->validPayload([
                'cnpj' => '11.111.111/0001-11',
                'cnaes_secundarios' => [
                    ['codigo' => '6201-5/01', 'descricao' => ''],
                ],
            ]));

        $response->assertRedirect(route('companies.create'));
        $response->assertSessionHasErrors('cnaes_secundarios.0');
        $this->assertDatabaseCount('companies', 0);
    }

    private function validPayload(array $overrides = []): array
    {
        return array_merge([
            'razao_social' => 'Emitoo Tecnologia LTDA',
            'nome_fantasia' => 'Emitoo',
            'contato' => 'Carlos',
            'cnpj' => '12345678000190',
            'inscricao_municipal' => '12345',
            'inscricao_estadual' => '54321',
            'regime_tributario' => 'Simples Nacional',
            'natureza_juridica' => '2062',
            'data_abertura' => '2024-01-01',
            'porte' => 'ME',
            'cnae_primario_codigo' => '',
            'cnae_primario_descricao' => '',
            'cnaes_secundarios' => [],
            'optante_simples_nacional' => '1',
            'incentivador_cultural' => '0',
            'endereco' => 'Rua das Flores',
            'endereco_numero' => '100',
            'endereco_complemento' => 'Sala 10',
            'bairro' => 'Centro',
            'cidade' => 'Sao Paulo',
            'estado' => 'sp',
            'pais' => 'Brasil',
            'cep' => '01001-000',
            'telefone' => '(11) 99999-0000',
            'email' => 'contato@emitoo.test',
            'nfse_environment' => 'homologacao',
        ], $overrides);
    }
}
