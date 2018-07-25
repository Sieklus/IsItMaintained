<?php

namespace Maintained\Application\Controller;

use BlackBox\MapStorage;
use DI\Annotation\Inject;
use Twig_Environment;

/**
 * @author Matthieu Napoli <matthieu@mnapoli.fr>
 */
class HomeController
{
    /**
     * @Inject
     * @var Twig_Environment
     */
    private $twig;

    /**
     * @Inject("storage.repositories")
     * @var MapStorage
     */
    private $repositories;

    public function __invoke()
    {
        $latestRepositories = iterator_to_array($this->repositories);
        $latestRepositories = array_reverse($latestRepositories);
        $latestRepositories = array_slice($latestRepositories, 0, 9);
        $latestRepositories = array_keys($latestRepositories);

        $showcase = [
            'rails/rails'            => 'Rails',
            'pallets/flask'          => 'Flask',
            'expressjs/express'      => 'Express',
            'symfony/symfony'        => 'Symfony',
            'zendframework/zendframework' => 'Zend Framework',
            'laravel/framework'      => 'Laravel',
            'angular/angular.js'     => 'AngularJS',
            'meteor/meteor'          => 'Meteor',
            'facebook/react'         => 'React',
            'facebook/react-native'  => 'React Native',
            'gulpjs/gulp'            => 'Gulp',
            'robbyrussell/oh-my-zsh' => 'Oh My Zsh',
        ];

        return $this->twig->render('/app/views/home.twig', [
            'latestRepositories' => $latestRepositories,
            'showcase'           => $showcase,
        ]);
    }
}
