<?php

namespace App\Repository;

use App\Entity\Project;

class ProjectRepository
{
    public function findAll(): array {
        return [
            new Project(
                'neuilly',
                'Église de Neuilly',
                '2007',
                'http://vibby.beauvivre.fr/laboratoire/neuilly/',
                'Intégration et Thème Joomla',
                ['Intégration', 'UX', 'En ligne'],
            ),
            new Project(
                'mobiles',
                'Mobiles',
                '2009',
                'http://vibby.beauvivre.fr/laboratoire/mobiles/',
                'Site Vanilla JS ludique',
                ['Intégration', 'Js Vanilla', 'Experimentation'],
            ),
            new Project(
                'cuisine',
                'Cuisine facile',
                '2010',
                'http://vibby.beauvivre.fr/laboratoire/cuisine/',
                'Site de recettes de cuisine complet',
                ['Intégration', 'Design', 'En ligne'],
            ),
            new Project(
                'parket',
                'Parquet',
                '2010',
                'http://vibby.beauvivre.fr/laboratoire/parquet/',
                'CMS maison',
                ['Intégration', 'Design', 'Backoffice'],
            ),
            new Project(
                'panels',
                'Panels',
                '2011',
                'http://vibby.beauvivre.fr/laboratoire/panels/',
                'Concept de navigation',
                ['Intégration', 'Design', 'Js Vanilla', 'Experimentation'],
            ),
            new Project(
                'cssoff2011',
                'CssOff 2011',
                '2011',
                'http://vibby.beauvivre.fr/laboratoire/cssoff2011/',
                'Compétition de CSS',
                ['Intégration', 'Défi'],
            ),
            new Project(
                'nicosylvine',
                'Wedding',
                '2011',
                'http://sylvine-nicolas.beauvivre.fr/index.php',
                'CMS maison',
                ['Intégration', 'Design', 'Backoffice'],
            ),
            new Project(
                'css1k',
                'CSS 1k',
                '2012',
                'http://vibby.beauvivre.fr/laboratoire/CSS1K#butchery',
                'Défi CSS de légèreté',
                ['CSS', 'Design', 'Défi'],
            ),
            new Project(
                'steps',
                'Steps',
                '2013',
                'http://vibby.beauvivre.fr/laboratoire/steps/',
                'Outil javascript de navigation',
                ['Js Vanilla', 'Experimentation'],
            ),
            new Project(
                'museo',
                'Museo',
                '2013',
                'http://vibby.beauvivre.fr/laboratoire/museo/www/museums.php',
                'POC très rapide avec administration complète',
                ['Foundation', 'POC', 'Défi', 'Symfony'],
            ),
            new Project(
                'flexart',
                'Flexart',
                '2013',
                'http://vibby.beauvivre.fr/laboratoire/flexart/',
                'CMS maison',
                ['Foundation', 'Design', 'Intégration'],
            ),
            new Project(
                'cssoff2013',
                'CssOff 2013',
                '2013',
                'http://vibby.beauvivre.fr/laboratoire/cssoff2013/',
                'Compétition de CSS',
                ['Intégration', 'Défi'],
            ),
            new Project(
                'likert',
                'Formulaire Likert',
                '2014',
                'http://likert.beauvivre.fr/',
                'Outil de questionnaire complexe en ligne',
                ['Intégration', 'Symfony', 'Backend', 'En ligne', 'Backoffice'],
            ),
            new Project(
                'cuisinefacile',
                'Cuisine Facile',
                '2015',
                'http://vibby.beauvivre.fr/laboratoire/cuisine-facile/recette.html',
                'Site de recettes de cuisine',
                ['Intégration', 'Design', 'En ligne'],
            ),
            new Project(
                'ean',
                'Église Adventiste de Nantes',
                '2016',
                'http://vibby.beauvivre.fr/laboratoire/ean/',
                'CMS maison',
                ['Intégration', 'Design', 'Experimentation'],
            ),
            new Project(
                'reunionite',
                'Réunionïte',
                '2022',
                'https://reunionite.beauvivre.fr/',
                'Jeu 100% frontend',
                ['Javascript', 'VueJs', 'Design', 'En ligne'],
            ),
            new Project(
                'adra',
                'Adra Nantes',
                '2024',
                'https://adra-nantes.fr/',
                'Association caritative',
                ['Wordpress', 'Design', 'En ligne'],
            ),
        ];
    }

    public function filter(string $categorie): array
    {
        $list = array_filter(
            $this->findAll(),
            fn(Project $project) => in_array($categorie, $project->tags)
        );
        usort($list, fn($a, $b) => $a->date < $b->date);

        return $list;
    }

    public function filterPaginated(string $categorie, int $page, int $perPage): array
    {
        $list = $this->findAll();
        if ($categorie !== '') {
            $list = $this->filter($categorie);
        } else {
            usort($list, fn($a, $b) => $a->date < $b->date);
        }

        return array_slice($list, ($page - 1) * $perPage, $perPage);
    }

    public function findAllTags(): array
    {
        $list = array_unique(array_reduce(
            $this->findAll(),
            function (array $stack, Project $project) {
                return array_merge($stack, $project->tags);
            },
            []
        ));
        sort($list);

        return $list;
    }

    public function count(string $categorie = ''): int
    {
        return count($categorie === '' ? $this->findAll() : $this->filter($categorie));
    }
}