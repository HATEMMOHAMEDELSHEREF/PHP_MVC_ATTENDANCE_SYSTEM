<?php


namespace App\Lib;


class Template
{
    private $resources;
    private $view;

    public  function __construct($resources)
    {
        $this->resources=$resources;
    }
    public  function setView($view)
    {
        $this->view=$view;
    }


    private function RenderCssHeaderResources($resources){
        foreach ($resources as $CSSKEY =>$CSSVALUE){
            if (!empty($CSSKEY)){
              echo '<link rel="stylesheet" type="text/css" href="'.$CSSVALUE.'">';
            }
        }
    }
    private function RenderJsHeaderResources($resources){
        foreach ($resources as $JSKEY =>$JSVALUE){
            if (!empty($JSKEY)){
                echo '<script type="text/css" src="'.$JSVALUE.'"></script>';
            }
        }
    }
    private function RenderJsFooterResources($resources){
        foreach ($resources as $JSKEY =>$JSVALUE){
            if (!empty($JSKEY)){
                echo '<script type="text/javascript" src="'.$JSVALUE.'"></script>';
            }
        }
    }
    private function RenderHeaderResources(){
        if (array_key_exists('TEMPLATE_RESOURCES',$this->resources)){
            if (!empty($this->resources['TEMPLATE_RESOURCES'])){
                if (array_key_exists('HEADER',$this->resources['TEMPLATE_RESOURCES'])){
                    if (!empty($this->resources['TEMPLATE_RESOURCES']['HEADER'])){
                        require_once $this->resources['TEMPLATE_RESOURCES']['HEADER'];
                    }
                }
            }
        }
        if (array_key_exists('HEADER_RESOURCES',$this->resources)){
            if ((array_key_exists('CSS',$this->resources['HEADER_RESOURCES']))){
                if(!empty($this->resources['HEADER_RESOURCES']['CSS'])){
                    $this->RenderCssHeaderResources($this->resources['HEADER_RESOURCES']['CSS']);
                }
            }
            if ((array_key_exists('JS',$this->resources['HEADER_RESOURCES']))){
                if(!empty($this->resources['HEADER_RESOURCES']['JS'])){
                    $this->RenderJsHeaderResources($this->resources['HEADER_RESOURCES']['JS']);
                }
            }
        }

    }
    private function RenderFooterResources(){
        if ((array_key_exists('JS',$this->resources['FOOTER_RESOURCES']))){
            if(!empty($this->resources['FOOTER_RESOURCES']['JS'])){
                $this->RenderJsFooterResources($this->resources['FOOTER_RESOURCES']['JS']);
            }
        }
        if (array_key_exists('TEMPLATE_RESOURCES',$this->resources)){
            if (!empty($this->resources['TEMPLATE_RESOURCES'])){
                if (array_key_exists('FOOTER',$this->resources['TEMPLATE_RESOURCES'])){
                    if (!empty($this->resources['TEMPLATE_RESOURCES']['FOOTER'])){
                        require_once $this->resources['TEMPLATE_RESOURCES']['FOOTER'];
                    }
                }
            }
        }

    }
    private function RenderTemplateResources(){
        if (array_key_exists('TEMPLATE_RESOURCES',$this->resources)){
            if (!empty($this->resources['TEMPLATE_RESOURCES'])){
                // fOR BODY START
                if (array_key_exists('BODY_START',$this->resources['TEMPLATE_RESOURCES'])){
                    if (!empty($this->resources['TEMPLATE_RESOURCES']['BODY_START'])){
                        require_once $this->resources['TEMPLATE_RESOURCES']['BODY_START'];
                    }
                }
                // FOR SIDEBAR
                if (array_key_exists('SIDEBAR',$this->resources['TEMPLATE_RESOURCES'])){
                    if (!empty($this->resources['TEMPLATE_RESOURCES']['SIDEBAR'])){
                        require_once $this->resources['TEMPLATE_RESOURCES']['SIDEBAR'];
                    }
                }
                // FOR NAVBAR
                if (array_key_exists('NAVBAR',$this->resources['TEMPLATE_RESOURCES'])){
                    if (!empty($this->resources['TEMPLATE_RESOURCES']['NAVBAR'])){
                        require_once $this->resources['TEMPLATE_RESOURCES']['NAVBAR'];
                    }
                }
                //FOR THE VIEW ACTION CONTENT

                require_once $this->view;

                // FOR BODY END
                if (array_key_exists('BODY_END',$this->resources['TEMPLATE_RESOURCES'])){
                    if (!empty($this->resources['TEMPLATE_RESOURCES']['BODY_END'])){
                        require_once $this->resources['TEMPLATE_RESOURCES']['BODY_END'];
                    }
                }

            }
        }
    }
    public function RenderApp(){
        $this->RenderHeaderResources();
        $this->RenderTemplateResources();
        $this->RenderFooterResources();
    }

}