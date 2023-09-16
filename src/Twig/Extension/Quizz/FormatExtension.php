<?php

namespace App\Twig\Extension\Quizz;

use App\Twig\Runtime\Quizz\FormatExtensionRuntime;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Twig\Environment;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class FormatExtension extends AbstractExtension
{
    private $twig;
    private $urlGenerator;
    public function __construct(Environment $twig, UrlGeneratorInterface $urlGenerator){
        $this->twig = $twig;
        $this->urlGenerator = $urlGenerator;
    }
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/3.x/advanced.html#automatic-escaping
            new TwigFilter('filter_name', [FormatExtensionRuntime::class, 'doSomething']),
        ];
    }

    public function getFunctions(): array
    {
        return [

            new TwigFunction('indicatorChoices', [$this, 'renderIndicatorChoices'],['is_safe' => ['html']]),
            new TwigFunction('categories', [$this, 'renderCategories'],['is_safe' => ['html']]),
            new TwigFunction('nbQuizzs', [$this, 'renderQuizz'],['is_safe' => ['html']]),
            new TwigFunction('nbJoueurs', [$this, 'renderNbJoueurs'],['is_safe' => ['html']]),
            new TwigFunction('moyenne', [$this, 'renderMoyenne'],['is_safe' => ['html']]),

        ];
    }

    public function renderIndicatorChoices($choice){
        if($choice){
            $html = '<span class="badge rounded-pill bg-success">Vrai</span>';
        }else{
            $html = '<span class="badge rounded-pill bg-danger">Faux</span>';
        }

        return $html;
    }
    public function renderCategories($categories){
        $html = '';
        foreach ($categories as $cat){
            $url = $this->urlGenerator->generate('app_quizz_quizz_categories_show', ['id' => $cat->getId()]);

            $html .= '<a href="'.$url.'"><span class="badge bg-primary">'.$cat->getName().'</span></a>';
        }
        return $html;
    }

    public function renderQuizz($quizzs){
        $html = '<span class="badge bg-primary">'.count($quizzs).'</span>';

        return $html;
    }

    public function renderNbJoueurs($quizzs){
        $html = '<span class="badge bg-primary">N.D.</span>';

        return $html;
    }

    public function renderMoyenne($quizzs){
        $html = '<span class="badge bg-primary">N.D.</span>';

        return $html;
    }
}
