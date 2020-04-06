<?php
namespace Dataview\IOProvider;

use Dataview\IntranetOne\Service;
use Dataview\IntranetOne\Category;
use Dataview\IOVitrine\Models\City;
use Dataview\IOVitrine\Models\Provider;
use Illuminate\Database\Seeder;
use Dataview\IOVitrine\IOProviderServiceProvider;
use Sentinel;

class ProviderSeeder extends Seeder
{
  public function run()
  {
    //cria o serviço se ele não existe
    if (!Service::where('service', 'Provider')->exists()) {
        $service = Service::create([
            'service' => "Provider",
            'alias' => 'provider',
            'trans' => 'Providers',
            'ico' => 'ico-teacher',
            'description' => 'Cadastro de Prestadores',
            'order' => Service::max('order') + 1,
        ]);
    }
    else
      $service = Service::where('service', 'Provider')->first();

      //seta privilegios padrão para o role admin
      $adminRole = Sentinel::findRoleBySlug('admin');
      $adminRole->addPermission('provider.view');
      $adminRole->addPermission('provider.create');
      $adminRole->addPermission('provider.update');
      $adminRole->addPermission('provider.delete');
      $adminRole->save();
      

      \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
      \DB::table('cities')->truncate();
      // \DB::table('oticas')->truncate();
      \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

      $categorias = [
        [
          "category" => "Alimentação",
          // "alias"=> "Alimentação",
          "description"=>"Venda de produtos alimentícios diversos",
          "config"=>["main"=>false,"icon"=>"ico-save","color"=>"red"],
          "subs" => [
            "Marmitas",
            "Pizzas",
            "Espetinhos",
            "Açaí",
            "Bolos e Doces",
            "Hamburgers",
            "Salgados",
            "Congelados"
          ]
        ],
        [
          "category" => "Feirantes",
          // "alias"=> "Alimentação",
          "description"=>"Venda de produtos alimentícios diversos",
          "config"=>["main"=>false,"icon"=>"ico-save","color"=>"red"],
          "subs" => [
            "Carnes",
            "Frutas e hortaliças",
            "Pães, bolos e biscoitos",
            "Outras comidas prontas",
            "Plantas e animais vivos",
            "Cereais e temperos",
            "Utensílios diversos",
            "Outros"
          ]
        ],
        [
          "category" => "Reparo e Manutenção",
          // "alias"=> "Reparo e Manutenção",
          "description"=>"reparo e manutenção",
          "config"=>["main"=>false,"icon"=>"ico-edit","color"=>"blue"],
          "subs" => [
            "Jardineiro",
            "Limpador de Piscina",
            "Encanador",
            "Marido de Aluguel",
            "Pedreiro",
            "Pintor",
            "Eletricista",
            "Instalador de Alarme",
            "Técnico em Informática",
          ]
        ],
        [
          "category" => "Serviços Domésticos",
          // "alias"=> "Serviços Domésticos",
          "description"=>"descrição da categoria de serviços domésticos",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green"],
          "subs" => [
            "Faxineira",
            "Diarista",
            "Babá",
            "Cuidadora",
          ],
          [
            "category" => "Saúde e Beleza",
            // "alias"=> "Serviços Domésticos",
            "description"=>"descrição da categoria de serviços domésticos",
            "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green"],
            "subs" => [
              "Professional Trainner",
              "Manicure e Pedicure",
              "Cabelereira",
              "Maquiadora",
              "Depiladora",
              "Design de sobrancelhas",
              "Maquiadora",
            ]
          ],
          [
            "category" => "Aulas particulaes",
            // "alias"=> "Serviços Domésticos",
            "description"=>"descrição da categoria de serviços domésticos",
            "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green"],
            "subs" => [
              "Manicure e Pedicure",
              "Cabelereira",
              "Maquiadora",
              "Depiladora",
              "Design de sobrancelhas",
            ]
          ]                         
        ],
        [
          "category" => "Revendedores",
          // "alias"=> "Serviços Domésticos",
          "description"=>"descrição da categoria de serviços domésticos",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green"],
          "subs" => [
            "Avon",
            "Hinode",
            "Mari Kay",
            "Natura",
            "Tupperware",
            "Rommanel",
            "Outros"
          ]
        ],
      ];

      $i=0;
      foreach($categorias as $c){
         $cat = Category::create([
            'service_id' => $service->id,
            'category' => $c["category"],
            'category_slug' => str_slug($c['category']),
            'description' => $c["description"],
            'config' => $c["config"],
          ]);

          $j=0;
          foreach($c['subs'] as $sc){
            Category::create([
                'category' => $sc,
                'category_id' => $cat->id,
                'category_slug' => str_slug($sc),
                'order'=>$j++,
                'erasable'=>false
              ]);
          }          
      }

      // $json = File::get(IOVitrineServiceProvider::pkgAddr('/assets/src/cities.json'));
      // $data = json_decode($json, true);
      // foreach ($data as $obj) {
      //     City::create([
      //       'id' => $obj['i'],
      //       'city' => $obj['c'],
      //       'region' => $obj['u'],
      //     ]);
      // }

      //seed das categories

    //  $i=0;
    //   foreach($cats as $c){
    //      $cat = Category::create([
    //         'category' => $c['name'],
    //         'service_id' => $service->id,
    //         'category_slug' => str_slug($c['name']),
    //         'order'=>$i++,
    //         'erasable'=>false
    //       ]);
    //       $j=0;
    //       foreach($c['subc'] as $sc){
    //         Category::create([
    //             'category' => $sc,
    //             'category_id' => $cat->id,
    //             'category_slug' => str_slug($sc),
    //             'order'=>$j++,
    //             'erasable'=>false
    //           ]);
    //       }
    //   }


  }
}
