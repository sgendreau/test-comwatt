<?php

namespace App\Form\EventSubscriber;

use App\Entity\Pays;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class CheckFormEventSubscriber implements EventSubscriberInterface {

    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::SUBMIT => 'checkFields',
        ];
    }

    public function checkFields(FormEvent $event): void
    {
        $form = $event->getForm();
        $data = $event->getData();

        if($data) {
            if(!$data->getNationalite() || (string) $data->getNationalite()->getUuid() !== Pays::FRANCE_UUID && !$data->getTitreOriginal()) {
                $form->remove('titreOriginal');
                $form->add(
                'titreOriginal',
                TextType::class,
                    [
                        'label'    => 'Titre original',
                        'required' => true,
                        'attr'     => [
                            'placeholder' => 'Harry Potter and the Philosopher\'s stone',
                        ],
                    ]
                );
            } else {
                $form->remove('titreOriginal');
                $form->add(
                    'titreOriginal',
                    TextType::class,
                    [
                        'label'    => 'Titre original',
                        'required' => false,
                        'attr'     => [
                            'placeholder' => 'Harry Potter and the Philosopher\'s stone',
                        ],
                    ]
                );
            }
        }
    }
}
