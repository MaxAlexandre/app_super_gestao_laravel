<?php

use App\SiteContato;
use Illuminate\Database\Seeder;

class SiteContatoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        $contato = new SiteContato();
        $contato->nome = 'Salão os Piranhas';
        $contato->telefone = '(21) 25696969';
        $contato->email = 'salaodosp.com.br';
        $contato->motivo_contato = 1;
        $contato->mensagem = 'Opa, queria um orçamento meu bom :)';
        $contato->save();
        */

        factory(SiteContato::class, 100)->create();
    }
}
