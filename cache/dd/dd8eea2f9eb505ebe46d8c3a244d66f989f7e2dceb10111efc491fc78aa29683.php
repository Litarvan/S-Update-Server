<?php

/* login.twig */
class __TwigTemplate_3ad2ea59166aebdc8a862b687a408f386eb73ee216651c3d61f29b9e3e1b79e0 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("templates/base.twig", "login.twig", 26);
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
        echo "Login";
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "    <!-- Login CSS -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/login.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
    }

    // line 35
    public function block_content($context, array $blocks = array())
    {
        // line 37
        if ( !(isset($context["serverActivated"]) ? $context["serverActivated"] : null)) {
            // line 38
            echo "    <style>
        html, body {
            background: black;
        }
    </style>
";
        } else {
            // line 44
            echo "    <style>
        html, body {
            background-image: url(";
            // line 46
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/background.png")), "html", null, true);
            echo ");
        }
    </style>
";
        }
        // line 50
        echo "<div class='fulldiv'>
    <div class=\"center\" id=\"centerDiv\">
        <img src=\"";
        // line 52
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/logo.png")), "html", null, true);
        echo "\" />

        <form method=\"post\" target=\"\">
            <label for=\"password\">Password</label> : <input class=\"text-field\" type=\"password\" name=\"password\" id=\"password\" required/>
            <br />
            <br />
            <input class=\"submit-button\" type=\"submit\" value=\"Login\" />
        </form>

        <br />

        ";
        // line 63
        if ((isset($context["error"]) ? $context["error"] : null)) {
            // line 64
            echo "            <span style=\"color: red\">Bad password</span>
        ";
        }
        // line 66
        echo "    </div>
</div>

";
    }

    public function getTemplateName()
    {
        return "login.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  96 => 66,  92 => 64,  90 => 63,  76 => 52,  72 => 50,  65 => 46,  61 => 44,  53 => 38,  51 => 37,  48 => 35,  42 => 32,  39 => 31,  36 => 30,  30 => 28,  11 => 26,);
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
/*  # Auth login page*/
/*  #*/
/*  # v3-(Panel-1.2.0-BETA)*/
/*  #}*/
/* */
/* {% extends 'templates/base.twig' %}*/
/* */
/* {% block title %}Login{% endblock %}*/
/* */
/* {% block head %}*/
/*     <!-- Login CSS -->*/
/*     <link href="{{ res("css/login.css") }}" rel="stylesheet" />*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* {# Setting the background black if the server is not activated #}*/
/* {% if not serverActivated %}*/
/*     <style>*/
/*         html, body {*/
/*             background: black;*/
/*         }*/
/*     </style>*/
/* {% else %}*/
/*     <style>*/
/*         html, body {*/
/*             background-image: url({{ res("images/background.png") }});*/
/*         }*/
/*     </style>*/
/* {% endif %}*/
/* <div class='fulldiv'>*/
/*     <div class="center" id="centerDiv">*/
/*         <img src="{{ res("images/logo.png") }}" />*/
/* */
/*         <form method="post" target="">*/
/*             <label for="password">Password</label> : <input class="text-field" type="password" name="password" id="password" required/>*/
/*             <br />*/
/*             <br />*/
/*             <input class="submit-button" type="submit" value="Login" />*/
/*         </form>*/
/* */
/*         <br />*/
/* */
/*         {% if error %}*/
/*             <span style="color: red">Bad password</span>*/
/*         {% endif %}*/
/*     </div>*/
/* </div>*/
/* */
/* {% endblock %}*/
/* */
/* */
/* */
