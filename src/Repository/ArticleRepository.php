<?php

namespace App\Repository;

use App\Entity\Article;

class ArticleRepository
{
    public function findAll(): array
    {
        return [
            new Article(
                'curseurs-du-developpement-web',
                'Les curseurs du développement web',
                new \DateTime('2025-01-01'),
                'Quels sont les léviers pour créer ou faire évoluer une application web ? L’enjeu n’est pas seulement technique mais carrément commercial, politique ou visionnaire ! Nous tâcherons d’en décrire quelques-uns …',
                <<<HTML
<p>Quand vient le temps de retranscrire un besoin métier en code informatique pour réaliser une fonction ou remplir toute sorte de tâche, les moyens pour y parvenir sont absolument étendus et hétérogènes. Ce sont des choix qui présentent tous leurs avantages et leurs inconvénients. Voyons ensemble quelqu’un de ces choix et sur quels critères se décider.</p>

<h2>Le critère du besoin et de son évolutivité</h2>

<p>La première vision à porter est celle du besoin auquel l’application va répondre, et celui de son évolution potentielle. Si le besoin correspond à un produit déjà existant, que ce soit un blog, un e-commerce, une GED, il sera surement plus efficace d’utiliser une solution « sur étagère ». On peut citer par exemple WordPress pour un blog, Sylius pour un e-commerce, ou alfresco pour la gestion documentaire. Mais si le besoin diffère même légèrement de la solution toute faite, le point de bascule est difficile à trouver entre modifier la solution existante et créer une solution toute prête.</p>

<p>L’enjeu n’est pas tant la fonctionnalité elle-même, mais la possibilité de la faire faire perdurer dans le temps. Pour vous donner un exemple, si on souhaite modifier le tunnel de finalisation d’une commande dans un e-commerce, il n’est pas sûr que les modifications qui seront apportés seront compatibles avec les futures version de la solution. Hors, les mise à jour des solutions utilisés sont indispensables, car elles peuvent concernée des points de sécurité critiques.</p>

<h2>Le critère de la durée de vie</h2>

<p>Bien entendu, on ne prendra le même soin dans les choix d’architecture selon la vision sur le long terme du projet.</p>
 
<p>Il est tout à fait adapté de gagner du temps et de l’énergie pour un site évènementiel qui va accompagner un salon ou un colloque pendant une semaine. L’enjeu de sécurité, de maintenabilité étant minime, faire vite, peu lisible, peu optimisé est économique rationnel.</p>

<p>Mais si on travaille sur une application qui doit accompagner au quotidien le métier de centaines de travailleurs 
dans une usine sur plusieurs années, le critère de la maintenabilité et de la qualité globale devient primordiale. Non pas pour avoir une application qui « fonctionne bien », mais pour avoir une application qui ne sera pas trop onéreuse à maintenir dans le temps. Dans ce cas, il vaut mieux dépenser 100k€ dans une application puis 10k€ par an pour sa maintenance, plutôt que 50k€ au départ puis 20k€ par an. Et ce n’est pas seulement une question de cout : la deuxième application connaitra plus d’arrêts critiques que la première, entrainant bien d’autres déconvenues.</p>

<h2>Le critère de la durabilité</h2>

<p>Que ce soit pour le langage informatique, pour le framework, ou pour les patrons de conceptions, ces choix sont toujours difficiles, car ils sont très clivants pour la suite du projet.</p>

<p>Dans le cadre d’une application web, le choix d’utiliser ou non un framework javascript est crucial. Et le choix du framework lui-même est carrément cornélien : bien malin qui peut prédire quel framework aura le meilleur support, la meilleure maintenabilité dans le temps, et s’adaptera le mieux aux évolutions futures du métier ! C’est d’ailleurs aussi le cas dans les autres langages, même si c’est dans une moindre mesure.</p>

<p>Pour faire face à cette situation, garder une hygiène de code passe par le faible engagement envers un framework, et une isolation du code qui dépend de ce framework. La démarche sera alors de coder le cœur d’une application sans jamais utiliser les éléments d’un framework. Puis ajouter le lien avec le framework comme une surcouche qui va utiliser ce cœur. Cette démarche c’est le cœur du DDD : domain driven design.</p>


<h3>Le mot de la fin</h3>

<p>Choisir, c’est renoncer. On a raison de le dire. Parfois, on peut repousser ou contourner le choix, c’est rester 
flexible. Parfois, on peut le trancher, c’est l’assumer. Identifier quelle position prendre pour chaque situation, ça relève du génie … le génie informatique 🙂</p>
HTML,
            ),
            new Article(
                'voyage-en-ddd',
                'Voyage du Legacy au DDD',
                new \DateTime('2022-06-17'),
                'Voici mon livre blanc sur la transition d’un projet d’un code legacy vers une application en Domain Driven Design. J’y partage ma démarche et l’importance de mettre le métier au cœur du travail du développeur.',
                <<<HTML
<p>Je suis fier de vous présenter ce livre blanc qui traite de la transition d’un projet depuis une base de code legacy vers une application en Domain Driven Design.</p>
<p>J’y esquisse ma démarche, la quête de sens, la volonté de faire transpirer le métier au serivec du quel le développeur apporte son talent. Faites-en bon usage !</p>
<p>
<a href="/share/voyage-du-legacy-au-ddd.pdf"
target="_blank"
class="text-md bg-indigo-500 hover:bg-indigo-600 text-white shadow-sm rounded-md px-5 py-2.5"
>
    Télécharger le livre blanc
</a>
</p>
HTML
            ),
        ];
    }

    private function filter(string $search): array
    {
        $list = array_filter($this->findAll(), function (Article $article) use ($search): bool {
            return str_contains($article->content, $search);
        });
        usort($list, fn($a, $b) => $a->date < $b->date);

        return $list;
    }

    public function filterPaginated(string $search, int $page, int $perPage): array
    {
        $list = $search !== '' ? $this->filter($search) : $this->findAll();
        usort($list, fn($a, $b) => $a->date < $b->date);

        return array_slice($list, ($page - 1) * $perPage, $perPage);
    }

    public function count(string $search = ''): int
    {
        return count($search === '' ? $this->findAll() : $this->filter($search));
    }

    public function find(string $slug): ?Article
    {
        return array_values(array_filter($this->findAll(), fn(Article $article) => $article->slug === $slug))[0] ?? null;
    }
}