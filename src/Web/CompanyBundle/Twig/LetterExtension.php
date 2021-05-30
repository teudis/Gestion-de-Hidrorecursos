<?php
namespace Web\CompanyBundle\Twig;
use Twig_Extension;
use Twig_Filter_Method;

class LetterExtension extends Twig_Extension
{
        public function getFilters()
        {
        return array(
        'letter' => new Twig_Filter_Method($this, 'letterFilter'),
        );

        }
        public function letterFilter($cadena)
        {
            return $cadena[0];

        }
        public function getName()
        {
        return 'letter_extension';
        }
}



?>
