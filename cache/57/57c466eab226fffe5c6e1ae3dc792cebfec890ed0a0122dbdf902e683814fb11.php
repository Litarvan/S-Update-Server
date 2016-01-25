<?php

/* about.twig */
class __TwigTemplate_e614f72a4748b990a31ebd7190a7db6f82c9b9c5f35e51cad35a7a6e80b7f9a2 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("templates/base.twig", "about.twig", 26);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "templates/base.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 28
    public function block_title($context, array $blocks = array())
    {
        echo "About";
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "    <!-- Index CSS -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/about.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
    }

    // line 35
    public function block_content($context, array $blocks = array())
    {
        // line 36
        echo "    <style>
        html, body {
            background-image: url(";
        // line 38
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/background.png")), "html", null, true);
        echo ");
        }
    </style>

    <div class='fulldiv'>
        <div class=\"center\">
            <img src=\"";
        // line 44
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/logo.png")), "html", null, true);
        echo "\" />
            <h1>S-Update-Server 3.2.0 by Litarvan</h1>
            <br />
            <br />

            <p>
                Copyright (c) 2015-2016 Adrien Navratil under LGPL-3.0 license
                <br />
                <br />
                Sources on <a href=\"https://github.com/Litarvan/S-Update-Server\">Github</a>
            </p>

            <br />
            <img src=\"";
        // line 57
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/sharklogo.png")), "html", null, true);
        echo "\" />
            <br /><br />
            <button id=\"home\" style=\"margin-right: 30px;\" onclick=\"window.location.href='home';\">Home</button>
        </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "about.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  80 => 57,  64 => 44,  55 => 38,  51 => 36,  48 => 35,  42 => 32,  39 => 31,  36 => 30,  30 => 28,  11 => 26,);
    }
}
/* {#*/
/*  # Copyright 2015-2016 Adrien Navratil*/
/*  #*/
/*  # This file is part of S-Update-Server.*/
/*  #*/
/*  # S-Update-Server is free software: you can redistribute it and/or modify*/
/*  # it under the terms of the GNU Lesser General Public License as published by*/
/*  # the Free Software Foundation, either version 3 of the License, or*/
/*  # (at your option) any later version.*/
/*  #*/
/*  # S-Update-Server is distributed in the hope that it will be useful,*/
/*  # but WITHOUT ANY WARRANTY; without even the implied warranty of*/
/*  # MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the*/
/*  # GNU Lesser General Public License for more details.*/
/*  #*/
/*  # You should have received a copy of the GNU Lesser General Public License*/
/*  # along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.*/
/*  #}*/
/* */
/* {#*/
/*  # Panel about page*/
/*  #*/
/*  # v3-(Panel-1.2.0-BETA)*/
/*  #}*/
/* */
/* {% extends 'templates/base.twig' %}*/
/* */
/* {% block title %}About{% endblock %}*/
/* */
/* {% block head %}*/
/*     <!-- Index CSS -->*/
/*     <link href="{{ res("css/about.css") }}" rel="stylesheet" />*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/*     <style>*/
/*         html, body {*/
/*             background-image: url({{ res("images/background.png") }});*/
/*         }*/
/*     </style>*/
/* */
/*     <div class='fulldiv'>*/
/*         <div class="center">*/
/*             <img src="{{ res('images/logo.png') }}" />*/
/*             <h1>S-Update-Server 3.2.0 by Litarvan</h1>*/
/*             <br />*/
/*             <br />*/
/* */
/*             <p>*/
/*                 Copyright (c) 2015-2016 Adrien Navratil under LGPL-3.0 license*/
/*                 <br />*/
/*                 <br />*/
/*                 Sources on <a href="https://github.com/Litarvan/S-Update-Server">Github</a>*/
/*             </p>*/
/* */
/*             <br />*/
/*             <img src="{{ res('images/sharklogo.png') }}" />*/
/*             <br /><br />*/
/*             <button id="home" style="margin-right: 30px;" onclick="window.location.href='home';">Home</button>*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
