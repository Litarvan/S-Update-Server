<?php

/* settings.twig */
class __TwigTemplate_3066fa64a1946d0c0c231a8ba3578825175bc80b6f5d2a7f5fb04e1955ed691c extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("templates/base.twig", "settings.twig", 26);
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
        echo "Settings";
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "    <!-- Settings CSS -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/settings.css")), "html", null, true);
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

    <div id=\"mainDiv\">
        <img src=\"";
        // line 43
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/logo.png")), "html", null, true);
        echo "\" />
        <br />
        <br />
        <button id=\"home\" style=\"margin-right: 30px;\" onclick=\"window.location.href='home';\">Cancel</button>
        <br />
        <br />

        <form method=\"post\" target=\"\" id=\"passwordForm\">
            <input id=\"form\" name=\"form\" value=\"passwordForm\" style=\"display: none;\" />

            <h1>Change Password</h1>
            <br />
            <br />

            <label for=\"password\">Password</label> : <input class=\"text-field\" type=\"password\" name=\"password\" id=\"password\" onkeyup=\"checkFields(); return false;\" required/><br />
            <label for=\"vpassword\">Valid Password</label> : <input class=\"text-field\" type=\"vpassword\" name=\"vpassword\" id=\"vpassword\" onkeyup=\"checkFields(); return false;\" required/><br /><br />
        </form>

        <button class=\"submit-button\" onclick=\"checkAndSubmit()\">Change</button>
    </div>
";
    }

    // line 65
    public function block_scripts($context, array $blocks = array())
    {
        // line 66
        echo "    <!-- The FieldChecker JS -->
    <script src=\"";
        // line 67
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("js/fieldChecker.js")), "html", null, true);
        echo "\"></script>
";
    }

    public function getTemplateName()
    {
        return "settings.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 67,  92 => 66,  89 => 65,  64 => 43,  56 => 38,  52 => 36,  49 => 35,  43 => 32,  40 => 31,  37 => 30,  31 => 28,  11 => 26,);
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
/*  # Panel settings page*/
/*  #*/
/*  # v3-(Panel-1.2.0-BETA)*/
/*  #}*/
/* */
/* {% extends 'templates/base.twig' %}*/
/* */
/* {% block title %}Settings{% endblock %}*/
/* */
/* {% block head %}*/
/*     <!-- Settings CSS -->*/
/*     <link href="{{ res("css/settings.css") }}" rel="stylesheet" />*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/*     <style>*/
/*         html, body {*/
/*             background-image: url({{ res("images/background.png") }});*/
/*         }*/
/*     </style>*/
/* */
/*     <div id="mainDiv">*/
/*         <img src="{{ res('images/logo.png') }}" />*/
/*         <br />*/
/*         <br />*/
/*         <button id="home" style="margin-right: 30px;" onclick="window.location.href='home';">Cancel</button>*/
/*         <br />*/
/*         <br />*/
/* */
/*         <form method="post" target="" id="passwordForm">*/
/*             <input id="form" name="form" value="passwordForm" style="display: none;" />*/
/* */
/*             <h1>Change Password</h1>*/
/*             <br />*/
/*             <br />*/
/* */
/*             <label for="password">Password</label> : <input class="text-field" type="password" name="password" id="password" onkeyup="checkFields(); return false;" required/><br />*/
/*             <label for="vpassword">Valid Password</label> : <input class="text-field" type="vpassword" name="vpassword" id="vpassword" onkeyup="checkFields(); return false;" required/><br /><br />*/
/*         </form>*/
/* */
/*         <button class="submit-button" onclick="checkAndSubmit()">Change</button>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/*     <!-- The FieldChecker JS -->*/
/*     <script src="{{ res('js/fieldChecker.js') }}"></script>*/
/* {% endblock %}*/
/* */
