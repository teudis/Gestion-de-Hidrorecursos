<?php

namespace Web\CompanyBundle\Controller;

class CompanyExtension extends \Twig_Extension{
    
     public function getFilters() {
        return array('completar' 
            => new \Twig_Filter_Method($this, 'completar', array('is_safe' => array('html')))
            );
    }
    
    public function ver($value)
    {
        
        $html = <<<EOJ

        <script type="text/javascript">
        
        $('input:radio').click (function() {
           var si = $("input[name='optionsRadios']:checked").val();    
           
           
        })
        </script>
EOJ;
       return $html;
    }
    
    public function getName() {
        return 'company';
    }
}

?>
