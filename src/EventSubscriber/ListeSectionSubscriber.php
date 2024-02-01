<?php

namespace App\EventSubscriber;

use Twig\Environment;
use App\Repository\SectionRepository;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ListeSectionSubscriber implements EventSubscriberInterface
{
    
const ROUTES = ['app_reservation_index','app_reservation_section'];

public function __construct(private SectionRepository $sectionRepository, private Environment $twig)
{

}


    public function injectGlobalVariable(RequestEvent $event):void
    {
        $route = $event->getRequest()->get('_route');
        if(in_array($route, ListeSectionSubscriber::ROUTES)){
            $section = $this -> sectionRepository->findAll();
            $this->twig->addGlobal('allSection', $section);
            
        }

    }
    
    public static function getSubscribedEvents()
    {
        return[KernelEvents::REQUEST => 'injectGlobalVariable'];
    }
}