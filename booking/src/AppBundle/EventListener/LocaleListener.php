<?php

namespace AppBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Za dodatne informacije o načinu rada Event listenera vidjeti Symfony dokumentaciju:
 * @link http://symfony.com/doc/current/event_dispatcher.html
 */
class LocaleListener implements EventSubscriberInterface
{
    private $defaultLocale;

    public function __construct($defaultLocale = 'en')
    {
        $this->defaultLocale = $defaultLocale;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        /**
         * Prvo provjeravamo je li lokal postavljen kroz _locale parametar route
         * @link http://symfony.com/doc/current/translation/locale.html#the-locale-and-the-url
         */
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // Ako lokal nije postavljen kroz request, koristimo lokal iz sesije. Ako lokala nema ni u sesiji, koristimo
            // defaultni lokal aplikacije.
            $request->setLocale($request->getSession()->get('_locale', $this->defaultLocale));
        }
    }

    public static function getSubscribedEvents()
    {
        return array(
            // Ovaj listener se mora pokrenuti nakon zadanog Locale listenera (prioritet 16), ovdje mu možemo postaviti
            // manji prioritet (15).
            // Popis listenera po prioritetu možemo vidjeti u konzoli pomoću naredbe:
            // php bin/console debug:event-dispatcher
            KernelEvents::REQUEST => [['onKernelRequest', 15]],
        );
    }
}
