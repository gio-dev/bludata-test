<?php

namespace App\Providers;

use App\Rules\BirthdateRule;
use App\Rules\BirthmaiorRule;
use App\Rules\Celular;
use App\Rules\CelularComCodigo;
use App\Rules\CelularComDdd;
use App\Rules\Cnh;
use App\Rules\Cnpj;
use App\Rules\CompostName;
use App\Rules\Cpf;
use App\Rules\CpfOuCnpj;
use App\Rules\FormatoCep;
use App\Rules\FormatoCnpj;
use App\Rules\FormatoCpf;
use App\Rules\FormatoCpfOuCnpj;
use App\Rules\FormatoPis;
use App\Rules\FormatoPlacaDeVeiculo;
use App\Rules\Pis;
use App\Rules\Telefone;
use App\Rules\TelefoneComCodigo;
use App\Rules\TelefoneComDdd;
use App\Rules\Uf;
use Illuminate\Support\ServiceProvider;

class ValidatorProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;


    /**
     * Bootstrap the application events.
     *
     * @return void
     */

    public function boot()
    {
        $rules = [
            'celular'                  => Celular::class,
            'celular_com_ddd'          => CelularComDdd::class,
            'celular_com_codigo'       => CelularComCodigo::class,
            'cnh'                      => Cnh::class,
            'cnpj'                     => Cnpj::class,
            'cpf'                      => Cpf::class,
            'formato_cnpj'             => FormatoCnpj::class,
            'formato_cpf'              => FormatoCpf::class,
            'telefone'                 => Telefone::class,
            'telefone_com_ddd'         => TelefoneComDdd::class,
            'telefone_com_codigo'      => TelefoneComCodigo::class,
            'formato_cep'              => FormatoCep::class,
            'formato_placa_de_veiculo' => FormatoPlacaDeVeiculo::class,
            'formato_pis'              => FormatoPis::class,
            'pis'                      => Pis::class,
            'cpf_ou_cnpj'              => CpfOuCnpj::class,
            'formato_cpf_ou_cnpj'      => FormatoCpfOuCnpj::class,
            'uf'                       => Uf::class,
            'compost_name'             => CompostName::class,
            'birthdate'                => BirthdateRule::class,
            'birth_maior_idade'        => BirthmaiorRule::class,
        ];

        foreach ($rules as $name => $class) {
            $rule = new $class;

            $extension = static function ($attribute, $value) use ($rule) {
                return $rule->passes($attribute, $value);
            };

            $this->app['validator']->extend($name, $extension, $rule->message());
        }
    }


    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}
