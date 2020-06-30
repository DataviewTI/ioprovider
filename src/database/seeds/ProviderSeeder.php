<?php
namespace Dataview\IOProvider;

use Dataview\IntranetOne\Service;
use Dataview\IntranetOne\IntranetOneServiceProvider;
use Dataview\IntranetOne\Category;
use Dataview\IntranetOne\City;
use Dataview\IOProvider\Provider;
use Illuminate\Database\Seeder;
use Dataview\IOProvider\IOProviderServiceProvider;
use Illuminate\Support\Facades\File;
use Sentinel;
use Illuminate\Support\Str;
use Faker;


class ProviderSeeder extends Seeder
{
  public function run()
  {
    $faker = Faker\Factory::create('pt_BR');
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
          "category" => "Alimentos e Bebidas",
          "description"=>"Alimentos e Bebidas",
          "config"=>["main"=>false,"icon"=>"ico-save","color"=>"red","image"=>"fast-food.png"],
          "subs" => [
            "Alimentos prontos e congelados",
            "Carnes e Peixes",
            "Doces, tortas, bolos, biscoitos e pães",
            "Verduras, frutas e hortaliças",
            "Queijos, requeijão, ricota e outros derivados do leite)",
            "Pamonha, curau e outros derivados do milho",
            "Pastel, salgados lanches em geral",
            "Especiarias e temperos",
            "Farinhas, feijões e grãos em geral",
            "Animais vivos  ( galinha caipira, leitoa caipira)"
          ],
        ],
        [
          "category" => "Reparos e manutenção em geral",
          "description"=>"Reparos e manutenção em geral",
          "config"=>["main"=>false,"icon"=>"ico-save","color"=>"red","image"=>"toolbox.png"],
          "subs" => [
            "Pintor",
            "Eletricista",
            "Montador de móveis",
            "Pedreiro",
            "Encanador",
            "Calheiro",
            "Gesseiro",
            "Jardineiro",
            "Piscineiro",
            "Marido de aluguel",
            "Detetizador",
            "Segurança eletrônica",
            "Manutenção de ar-condicionado",
            "Manutenção em computadores",
            "Reparo de celulares",
            "Serviço de mudança ( Chapa)",
            "Vidraceiro",
            "Ajudante de pedreiro",
            "Pedreiro",
            "Chaveiro",
            "Carpinteiro",
            "Serralheiro",
          ]
        ],
        [
          "category" => "Reparo e Manutenção (Automóveis)",
          "description"=>"Reparo e Manutenção (Automóveis)",
          "config"=>["main"=>false,"icon"=>"ico-edit","color"=>"blue","image"=>"car-repair.png"],
          "subs" => [
            "Serviços de auto elétrica",
            "Mecânica em geral",
            "Borracheiro",
            "Martelinho de ouro",
            "Funilaria e pintura",
            "Serviços de alarme automotivo",
            "Serviços de ar condicionado",
            "Lava-jato e polimento",
            "Serviços de Insulfilme",
            "Serviços de guincho e reboque",
            "Chaveiro"
          ]
        ],
        [
          "category" => "Educação e Esportes",
          "description"=>"Educação e Esportes",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"certificate.png"],
          "subs" => [
            "Aula de dança",
            "Aula de idiomas",
            "Aula de instrumentos musicais",
            "Aula particular",
            "Aula para cursinho",
            "Aula para concurso",
            "Aula informática",
            "Aula para música e canto",
            "Aula arte e artesanato",
            "Aula de artes marciais",
            "Aula de jogos",
            "Aula de natação",
            "Aula de hidroginástica",
            "Auto escola",
            "Aulas com utilização de animais",
          ],
        ],
        [
          "category" => "Reparo de eletro eletrônicos",
          "description"=>"Reparo de eletro eletrônicos",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"car-repair.png"],
          "subs" => [
              "Eletro eletrônicos",
              "Fornos, fogões e microondas",
              "Refrigeradores em geral",
              "Redes e Internet e telefonia",
              "Computadores, impressoras e notebooks",
              "Celulares, tablets e outros",
            ]
        ],
        [
          "category" => "Serviços Domésticos",
          "description"=>"Serviços Domésticos",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"housekeeper.png"],
          "subs" => [
            "Diarista",
            "Passadeira",
            "Lavadeira de roupas",
            "Cozinheira",
            "Motorista particular",
            "Babá",
            "Cuidadora de idosos",
            "Adestrador de cachorros",
            "Doméstica para dormir no trabalho",
            "Doméstica",
          ]
        ],
        [
          "category" => "Moda e Beleza",
          "description"=>"Moda e Beleza",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"makeup.png"],
          "subs" => [
            "Cabeleleiro",
            "Manicure e pedicure",
            "Disigner de sobrancelhas",
            "Maquiador",
            "Esteticista",
            "Barbeiro",
            "Depilador",
            "Tatuador e  body piercing",
            "Personal stylist",
            "Costureira",
            "Sapateiro",
          ]
        ], 
        [
          "category" => "Saúde",
          "description"=>"",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"medicine.png"],
          "subs" => [
            "Fisioterauta",
            "Fonodiologo",
            "Nutricionista",
            "Terapias alternativas",
            "Massagista",
            "Enfermeiro",
            "Pscicólogo",
            "Protético",
          ]
        ],                                     
        [
          "category" => "Festas e Eventos",
          "description"=>"Festas e Eventos",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"toast.png"],
          "subs" => [
            "Assessor de eventos",
            "Locação de equipamentos e utensílios",
            "Garçom e copeira",
            "Recepcionista",
            "Segurança",
            "Limpeza e serviços gerais",
            "Animador de festas",
            "Mestre de cerimonial",
            "Bandas e  cantores",
            "Locação de equipamentos de som",
            "Serviço de DJs",
            "Serviços de Bar Men",
            "Serviços de buffet completo",
            "Churrasqueiro",
            "Confeiteiro",
            "Convites, brindes e lembrancinhas",
            "Serviços de decoração",
            "Serviços de fotos e filmagens"
          ]
        ],                                     
        [
          "category" => "Transporte, logística e mobilidade",
          "description"=>"Transporte, logística e mobilidade",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"taxi.png"],
          "subs" => [
            "Serviços de entrega (delivery)",
            "Transporte de cargas em geral",
            "Transporte de cargas vivas",
            "Transporte de pessoas",
            "Caminhão pipa",
            "Carga e descarga",
            "Transporte de mudanças",
            "Envio de malotes e documentos",
            "Locação de veículos",
            "locação de equipamentos para construção civil",
            "Serviços de tira entulho",
            "Serviços de guincho"
          ]
        ],                                     
        [
          "category" => "Serviços no Agronegócio",
          "description"=>"Serviços no Agronegócio",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"tractor.png"],
          "subs" => [
            "Caseiro",
            "Tratorista",
            "Vaqueiro",
            "Mecânico de máquinas agrícolas",
            "Cerqueiro",
            "Vacinador",
            "Serviço de locação de maquinas e equipamentos",
            "Operador de máquinas pesadas",
          ]
        ],       
        [
          "category" => "Coronavírus COVID-19",
          "description"=>"Serviços no Agronegócio",
          "config"=>["main"=>false,"icon"=>"ico-new","color"=>"green","image"=>"covid-19.png"],
          "subs" => [
            "Cuidados com saúde e higiene",
            "Gestão de pessoas",
            "Finanças",
            "Comunicação e marketing digital",
            "Gestão de fornecedores e suprimentos",
            "Delivery e logística",
            "Gestão de processos e consulta a legislação",
            "Gestão de pagamentos de impostos e tributos",
            "Gestão empresarial e controles",
            "Apoio a gestão da produtividade",
            "Educação à distância",
            "Vendas online",
            "Trabalho remoto",
          ]
        ],   
      ];

      $i=0;
      foreach($categorias as $c){
         $cat = Category::create([
            'service_id' => $service->id,
            'category' => $c["category"],
            'category_slug' => Str::slug($c['category']),
            'description' => $c["description"],
            'config' => $c["config"],
          ]);

          $j=0;
          foreach($c['subs'] as $sc){
            Category::create([
                'category' => $sc,
                'service_id' => $service->id,
                'category_id' => $cat->id,
                'category_slug' => Str::slug($sc),
                'order'=>$j++,
                'erasable'=>false
              ]);
          }          
      }

      if(empty(\DB::table('cities')->select('id')->first())){
        $json = File::get(IntranetOneServiceProvider::pkgAddr('/assets/src/base/js/data/cities.json'));
        $data = json_decode($json, true);
        foreach ($data as $obj) {
            City::create([
              'id' => $obj['i'],
              'city' => $obj['c'],
              'region' => $obj['u'],
            ]);
        }
      }


      // $provs = factory(Provider::class, 3)->create();

      
      //Criando providers de teste
      $cats = Category::where('service_id', $service->id)
          ->whereNull('category_id')
          ->pluck('id');

      for($i=0;$i<5;$i++){

        if($faker->boolean(75)){
          $name = $faker->unique()->name;
          $cpf_cnpj = $faker->unique()->cpf(false);
        }
        else
        {
          $name = $faker->unique()->company;
          $cpf_cnpj = $faker->unique()->cnpj(false);
        }

        $prov = new Provider([
          "name"=> $name,
          "cpf_cnpj" => $cpf_cnpj,
          "isWhatsapp" => $faker->boolean(75),
          "delivery" => $faker->boolean,
          "phone"=> $faker->unique()->cellphoneNumber,
          "email"=> $faker->unique()->email,
          "instagram" => $faker->boolean(33) ? $faker->lexify('????????') : null,
          "description" => $faker->text(mt_rand(20,400)),
          "status"=>"A"
        ]);

        $img_sizes = [
          "original"=>false,
          "sizes"=>[
              "thumb"=>["w"=>180,"h"=>180],
              "md"=>["w"=>720,"h"=>720],
            ]
        ];

        $prov->setAppend("sizes",json_encode($img_sizes));
        $prov->setAppend("hasImages",true);
        $prov->setAppend("service_id",$service->id);

        $prov->save();

        //add some
        if(filled($prov)){
          //add images
          $tmp_name = tempnam(sys_get_temp_dir(),'dz');
          $stream = file_get_contents("https://picsum.photos/640/480");
          $file = file_put_contents($tmp_name,$stream);

          $imgs = json_encode([(object)[
              "name"=>$faker->bothify('imgseed_#?#?#?#?.jpg'),
              "tmp"=>$tmp_name,
              "data"=>[
                "caption"=>null,
                "details"=>null,
              ],
              "mimetype"=>"image/jpeg",
              "id"=>null,
              "order"=>1
            ]]);

          $prov->group->manageImages(json_decode($imgs),$img_sizes);
          $prov->save();            


          $main = $faker->randomElement($cats);
          $prov->categories()->attach($main);

          $subcats = Category::where('service_id', $service->id)
              ->where('category_id',$main)
              ->pluck('id');

          for($y=0;$y<3;$y++){
            $prov->categories()->attach($faker->randomElement($subcats));
          }
        }

      }
  }
}
