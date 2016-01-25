<?php

/* install.twig */
class __TwigTemplate_41174dc25e95777f25c236533568b294928cb2771d949fdebed3fe966843bab6 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("templates/base.twig", "install.twig", 26);
        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
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
        echo "Install";
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "    <!-- Install CSS -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/install.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" />

    <!-- Lato Google Font -->
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
";
    }

    // line 38
    public function block_content($context, array $blocks = array())
    {
        // line 39
        echo "    ";
        // line 40
        echo "    ";
        if ( !(isset($context["serverActivated"]) ? $context["serverActivated"] : null)) {
            // line 41
            echo "        <style>
            html, body {
                background: black;
            }
        </style>
    ";
        } else {
            // line 47
            echo "        <style>
            html, body {
                background-image: url(";
            // line 49
            echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/background.png")), "html", null, true);
            echo ");
            }
        </style>
    ";
        }
        // line 53
        echo "    <div class='fulldiv'>
        <div class=\"center\" id=\"centerDiv\">
            <img src=\"";
        // line 55
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/icon.png")), "html", null, true);
        echo "\" />

            <p>Welcome</p>

            <br />
            <form method=\"post\" target=\"\" id=\"passwordForm\">
                <label for=\"password\">Password</label> : <br/><input class=\"text-field\" type=\"password\" name=\"password\" id=\"password\" onkeyup=\"checkFields(); return false;\" required/><br />
                <label for=\"vpassword\">Valid Password</label> : <br/><input class=\"text-field\" type=\"password\" name=\"vpassword\" id=\"vpassword\" onkeyup=\"checkFields(); return false;\" required/><br /><br />
            </form>

            <button class=\"submit-button\" onclick=\"checkAndSubmit()\">Start</button>
        </div>
    </div>

";
    }

    // line 71
    public function block_scripts($context, array $blocks = array())
    {
        // line 72
        echo "    <!-- The FieldChecker JS -->
    <script src=\"";
        // line 73
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("js/fieldChecker.js")), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "install.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  108 => 73,  105 => 72,  102 => 71,  83 => 55,  79 => 53,  72 => 49,  68 => 47,  60 => 41,  57 => 40,  55 => 39,  52 => 38,  43 => 32,  40 => 31,  37 => 30,  31 => 28,  11 => 26,);
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
/* {% block title %}Install{% endblock %}*/
/* */
/* {% block head %}*/
/*     <!-- Install CSS -->*/
/*     <link href="{{ res("css/install.css") }}" rel="stylesheet" />*/
/* */
/*     <!-- Lato Google Font -->*/
/*     <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/*     {# Setting the background black if the server is not activated #}*/
/*     {% if not serverActivated %}*/
/*         <style>*/
/*             html, body {*/
/*                 background: black;*/
/*             }*/
/*         </style>*/
/*     {% else %}*/
/*         <style>*/
/*             html, body {*/
/*                 background-image: url({{ res("images/background.png") }});*/
/*             }*/
/*         </style>*/
/*     {% endif %}*/
/*     <div class='fulldiv'>*/
/*         <div class="center" id="centerDiv">*/
/*             <img src="{{ res("images/icon.png") }}" />*/
/* */
/*             <p>Welcome</p>*/
/* */
/*             <br />*/
/*             <form method="post" target="" id="passwordForm">*/
/*                 <label for="password">Password</label> : <br/><input class="text-field" type="password" name="password" id="password" onkeyup="checkFields(); return false;" required/><br />*/
/*                 <label for="vpassword">Valid Password</label> : <br/><input class="text-field" type="password" name="vpassword" id="vpassword" onkeyup="checkFields(); return false;" required/><br /><br />*/
/*             </form>*/
/* */
/*             <button class="submit-button" onclick="checkAndSubmit()">Start</button>*/
/*         </div>*/
/*     </div>*/
/* */
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/*     <!-- The FieldChecker JS -->*/
/*     <script src="{{ res('js/fieldChecker.js') }}"></script>*/
/* {% endblock %}*/
/* */
