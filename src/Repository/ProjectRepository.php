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
                'Intégration et Thème Joomla',
                ['Intégration'],
                'http://laboratoire.beauvivre.fr/neuilly/',
            ),
            new Project(
                'mobiles',
                'Mobiles',
                '2009',
                'Site Vanilla JS ludique',
                ['Intégration', 'Js Vanilla', 'Experimentation'],
                'http://laboratoire.beauvivre.fr/mobiles/',
            ),
            new Project(
                'cuisine',
                'Cuisine facile',
                '2010',
                'Site de recettes de cuisine complet',
                ['Intégration', 'Design'],
                'http://laboratoire.beauvivre.fr/cuisine/',
            ),
            new Project(
                'parket',
                'Parquet',
                '2010',
                'CMS maison',
                ['Intégration', 'Design', 'Backoffice'],
                'http://laboratoire.beauvivre.fr/parquet/',
            ),
            new Project(
                'panels',
                'Panels',
                '2011',
                'Concept de navigation',
                ['Intégration', 'Design', 'Js Vanilla', 'Experimentation'],
                'http://laboratoire.beauvivre.fr/panels/',
            ),
            new Project(
                'cssoff2011',
                'CssOff 2011',
                '2011',
                'Compétition de CSS',
                ['Intégration', 'Défi'],
                'http://laboratoire.beauvivre.fr/cssoff2011/',
            ),
            new Project(
                'nicosylvine',
                'Wedding',
                '2011',
                'CMS maison',
                ['Intégration', 'Design', 'Backoffice'],
                'http://sylvine-nicolas.beauvivre.fr/index.php',
            ),
            new Project(
                'css1k',
                'CSS 1k',
                '2012',
                'Défi CSS de légèreté',
                ['CSS', 'Design', 'Défi', 'Experimentation'],
                'http://laboratoire.beauvivre.fr/CSS1K#butchery',
            ),
            new Project(
                'steps',
                'Steps',
                '2013',
                'Outil javascript de navigation',
                ['Js Vanilla', 'Experimentation'],
                'http://laboratoire.beauvivre.fr/steps/',
            ),
            new Project(
                id: 'museo',
                title: 'Museo',
                date: '2014',
                shortDesc: 'POC très rapide avec administration complète',
                tags: ['Foundation', 'Défi', 'Symfony'],
                link: 'http://laboratoire.beauvivre.fr/museo/www/museums.php',
            ),
            new Project(
                'flexart',
                'Flexart',
                '2013',
                'CMS maison',
                ['Foundation', 'Design', 'Intégration'],
                'http://laboratoire.beauvivre.fr/flexart/',
            ),
            new Project(
                'cssoff2013',
                'CssOff 2013',
                '2013',
                'Compétition de CSS',
                ['Intégration', 'Défi'],
                'http://laboratoire.beauvivre.fr/hophop/',
            ),
            new Project(
                'likert',
                'Formulaire Likert',
                '2014',
                'Outil de questionnaire complexe en ligne',
                ['Intégration', 'Symfony', 'Backend', 'Backoffice'],
                'http://likert.beauvivre.fr/',
            ),
            new Project(
                'cuisinefacile',
                'Cuisine Facile',
                '2015',
                'Site de recettes de cuisine',
                ['Intégration', 'Design'],
                'http://laboratoire.beauvivre.fr/cuisine-facile/recette.html',
            ),
            new Project(
                'ean',
                'Église Adventiste de Nantes',
                '2016',
                'CMS maison',
                ['Intégration', 'Design', 'Experimentation'],
                'http://laboratoire.beauvivre.fr/ean/',
            ),
            new Project(
                'vanao',
                'Mnesys Vanao',
                '2017',
                'Archives publiques en ligne',
                ['Intégration', 'Lead dev', 'Cakephp', 'Symfony', 'Backend', 'Backoffice'],
                'https://archives.lille.fr/',
            ),
            new Project(
                'reunionite',
                'Réunionïte',
                '2022',
                'Jeu 100% frontend',
                ['Javascript', 'VueJs', 'Design', 'Lead dev'],
                'https://reunionite.beauvivre.fr/',
            ),
            new Project(
                'piecesetpneus',
                'Pièces et pneus',
                '2020',
                'Sylius à forte fréquentation',
                ['Sylius', 'Backend', 'API', 'eCommerce', 'Lead dev'],
                'https://www.piecesetpneus.com',
            ),
            new Project(
                id: 'progicar',
                title: 'Progicar Remarket',
                date: '2022',
                shortDesc: 'Gestion d’activité industrielle',
                tags: ['Symfony', 'DDD', 'API', 'VueJs', 'Backend'],
                clientName: 'Progicar',
                clientLink: 'https://www.progicar.fr/progicar-remarket',
            ),
            new Project(
                'vimeet365',
                'Proximum Vimeet365',
                '2023',
                'Réseau social professionnel',
                ['Symfony', 'DDD', 'API', 'Backend', 'Lead dev'],
                clientName: 'Proximum',
                clientLink: 'https://365.vimeet.events/',
            ),
            new Project(
                'adra',
                'Adra Nantes',
                '2023',
                'Association caritative',
                ['Wordpress', 'Design'],
                'https://adra-nantes.fr/',
            ),
            new Project(
                'dixneuf',
                'Dixneuf Portail Pro',
                '2024',
                ' Portail commercial et industriel',
                ['Symfony', 'Backend', 'API'],
                clientName: 'Dixneuf',
                clientLink: 'https://www.dixneuf.com/'
            ),
            new Project(
                'cooker',
                'Cooker',
                '2024',
                'Plateforme no-code par système d’entrée / sortie',
                ['Symfony', 'VueJs', 'Design', 'DDD', 'Lead dev'],
                context: <<<HTML
<ul>
    <li>Projet en autonomie totale</li>
    <li>Objectif : automatisation de tâches récurrentes</li>
    <li>Système de connecteurs pour ajouter des services en ligne</li>
    <li>Connecteurs vers les API de Jira, Float, Google sheets, Mattermost, Clockify</li>
</ul>
HTML

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
        $list = array_unique(array_reduce(
            $this->findAll(),
            function (array $stack, Project $project) {
                return array_merge($stack, $project->getTags());
            },
            []
        ));
        sort($list);
        $used = array_reduce(
            $this->filter($otherTags),
            function (array $stack, Project $project) {
                return array_merge($stack, $project->getTags());
            },
            []
        );

        return array_merge(array_fill_keys($list, 0), array_count_values($used));
    }

    public function count(array $tags = []): int
    {
        return count($tags === [] ? $this->findAll() : $this->filter($tags));
    }

    public function find(string $id)
    {
        return array_values(array_filter($this->findAll(), fn(Project $project) => $project->id === $id))[0] ?? null;
    }
}