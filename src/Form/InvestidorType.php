<?php

namespace App\Form;

use App\Entity\Investidor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvestidorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->addEventListener(FormEvents::SUBMIT,[$this,"onSubmit"])
            ->add('nome')
            ->add('email')
            ->add('telefone')
            ->add('cpf');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Investidor::class,
        ]);
    }

    public function onSubmit(FormEvent $event)
    {
        // aqui sabemos que o formulário foi enviado
        /**
         * @var Investidor $investidor
         */
        $investidor = $event->getData();

        $cpfValido = $this->validaCPF($investidor->getCpf());

        if(!$cpfValido) {
            $form = $event->getForm();
            // adiciona um erro no campo CPF
            $form->get("cpf")->addError(new FormError("Por favor, digite um CPF válido."));
        }
    }

    private function validaCPF($cpf) {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );

        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }

        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }
        return true;

    }
}
