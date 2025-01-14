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
                ['Intégration', 'En ligne'],
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
                ['Foundation', 'Défi', 'Symfony'],
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
                'vanao',
                'Mnesys Vanao',
                '2017',
                'https://archives.lille.fr/',
                'Archives publiques en ligne',
                ['Intégration', 'Lead dev', 'Cakephp', 'Symfony', 'Backend', 'En ligne', 'Backoffice'],
            ),
            new Project(
                'reunionite',
                'Réunionïte',
                '2022',
                'https://reunionite.beauvivre.fr/',
                'Jeu 100% frontend',
                ['Javascript', 'VueJs', 'Design', 'En ligne', 'Lead dev'],
            ),
            new Project(
                'piecesetpneus',
                'Pièces et pneus',
                '2020',
                'https://piecesetpneus.com',
                'Sylius à forte fréquentation',
                ['Sylius', 'Backend', 'En ligne', 'API', 'eCommerce', 'Lead dev'],
            ),
            new Project(
                'progicar',
                'Progicar Remarket',
                '2022',
                'https://www.progicar.fr/progicar-remarket',
                'Gestion d’activité industrielle',
                ['Symfony', 'DDD', 'API', 'VueJs', 'Backend'],
            ),
            new Project(
                'vimeet365',
                'Proximum Vimeet365',
                '2023',
                'https://365.vimeet.events/',
                'Réseau social professionnel',
                ['Symfony', 'DDD', 'API', 'Backend', 'Lead dev'],
            ),
            new Project(
                'adra',
                'Adra Nantes',
                '2023',
                'https://adra-nantes.fr/',
                'Association caritative',
                ['Wordpress', 'Design', 'En ligne'],
            ),
            new Project(
                'dixneuf',
                'Dixneuf Portail Pro',
                '2024',
                'https://www.dixneuf.com/',
                ' Portail commercial et industriel',
                ['Symfony', 'Backend', 'En ligne', 'API'],
            ),
            new Project(
                'cooker',
                'Cooker',
                '2024',
                '',
                'Plateforme no-code par système d’entrée / sortie',
                ['Symfony', 'VueJs', 'Design', 'DDD', 'Lead dev'],
            ),
        ];
    }

    private function filter(array $tags): array
    {
        $list = array_filter(
            $this->findAll(),
            function (Project $project) use ($tags): bool {
                return count(array_intersect($tags, $project->getTags())) === count($tags);
            }
        );
        usort($list, fn($a, $b) => $a->date < $b->date);

        return $list;
    }

    public function filterPaginated(array $tags, int $page, int $perPage): array
    {
        $list = $tags !== [] ? $this->filter($tags) : $this->findAll();
        usort($list, fn($a, $b) => $a->date < $b->date);

        return array_slice($list, ($page - 1) * $perPage, $perPage);
    }

    public function findAvailableTags(array $otherTags): array
    {
        $list = array_reduce(
            $this->filter($otherTags),
            function (array $stack, Project $project) {
                return array_merge($stack, $project->getTags());
            },
            []
        );
        sort($list);

        return array_count_values($list);
    }

    public function count(array $tags = []): int
    {
        return count($tags === [] ? $this->findAll() : $this->filter($tags));
    }
}