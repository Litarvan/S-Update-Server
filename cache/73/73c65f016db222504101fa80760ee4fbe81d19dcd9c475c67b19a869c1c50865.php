<?php

/* home.twig */
class __TwigTemplate_12b0560e295d269d7e9762925d4a36054f51d4a290d1d2e5d6a7c74ab9f84cdc extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("templates/base.twig", "home.twig", 26);
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
        echo "Home";
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "    <!-- Index CSS -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/index.css")), "html", null, true);
        echo "\" rel=\"stylesheet\" />
";
    }

    // line 35
    public function block_content($context, array $blocks = array())
    {
        // line 36
        echo "<div class='fulldiv'>
    <div id=\"centerDiv\">
        <div id=\"left-buttons\">
            <a href=\"statistics\">
                <div id=\"statistics\" class=\"button top-button\" style=\"display: none;\">
                    <img id=\"statistics-icon\" class=\"button-icon\" src=\"";
        // line 41
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/stats.png")), "html", null, true);
        echo "\" />
                    <p id=\"statistics-label\" class=\"button-label\">Statistics</p>
                </div>
            </a>

            <a href=\"../auth/logout\">
                <div id=\"disconnect\" class=\"button bottom-button\" style=\"display: none;\">
                    <img id=\"disconnect-icon\" class=\"button-icon\" src=\"";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/disconnect.png")), "html", null, true);
        echo "\" />
                    <p id=\"disconnect-label\" class=\"button-label\">Disconnect</p>
                </div>
            </a>
        </div>

        <div style=\"text-align: center;\">
            <img id=\"sharklogo\" src=\"";
        // line 55
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/sharklogo.png")), "html", null, true);
        echo "\" />
            <canvas id=\"canvas\" width=\"350\" height=\"350\"></canvas>
            <img id=\"logo\" style=\"display: none;\" src=\"";
        // line 57
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/icon.png")), "html", null, true);
        echo "\" />
            <img id=\"textlogo\" style=\"display: none;\" src=\"";
        // line 58
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/textlogo.png")), "html", null, true);
        echo "\" />

            <div id=\"infos\">
                <b>Status : <span style=\"color: #00ff00\">Working</span></b><br /><br />

                Framework : <span style=\"color: #00ff00\">Paladin ";
        // line 63
        echo twig_escape_filter($this->env, (isset($context["paladinVersion"]) ? $context["paladinVersion"] : null), "html", null, true);
        echo "</span><br />
                Server : <span style=\"color: #00ff00\">";
        // line 64
        echo twig_escape_filter($this->env, (isset($context["server"]) ? $context["server"] : null), "html", null, true);
        echo "</span><br />
                Base : <span style=\"color: #00ff00\">";
        // line 65
        echo twig_escape_filter($this->env, (isset($context["base"]) ? $context["base"] : null), "html", null, true);
        echo "</span><br />
                Panel : <span style=\"color: #00ff00\">";
        // line 66
        echo twig_escape_filter($this->env, (isset($context["panel"]) ? $context["panel"] : null), "html", null, true);
        echo "</span><br />
                Internal : <span style=\"color: #00ff00\">";
        // line 67
        echo twig_escape_filter($this->env, (isset($context["internal"]) ? $context["internal"] : null), "html", null, true);
        echo "</span><br />
            </div>
        </div>

        <div id=\"right-buttons\">
            <a href=\"settings\">
                <div id=\"settings\" class=\"button top-button\" style=\"display: none;\">
                    <img id=\"settings-icon\" class=\"button-icon\" src=\"";
        // line 74
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/settings.png")), "html", null, true);
        echo "\" />
                    <p id=\"settings-label\" class=\"button-label\">Settings</p>
                </div>
            </a>

            <a href=\"about\">
                <div id=\"about\" class=\"button bottom-button\" style=\"display: none;\">
                    <img id=\"about-icon\" class=\"button-icon\" src=\"";
        // line 81
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/about.png")), "html", null, true);
        echo "\" />
                    <p id=\"about-label\" class=\"button-label\">About</p>
                </div>
            </a>
        </div>
    </div>


</div>
";
    }

    // line 92
    public function block_scripts($context, array $blocks = array())
    {
        // line 93
        echo "    <!-- Index JS script -->
    <script src=\"";
        // line 94
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("js/index.js")), "html", null, true);
        echo "\"></script>

    <!-- Starting the JS script -->
    <script>
        start(";
        // line 98
        echo (((isset($context["serverEnabled"]) ? $context["serverEnabled"] : null)) ? ("true") : ("false"));
        echo ", \"";
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/background.png")), "html", null, true);
        echo "\");
    </script>
";
    }

    public function getTemplateName()
    {
        return "home.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  159 => 98,  152 => 94,  149 => 93,  146 => 92,  132 => 81,  122 => 74,  112 => 67,  108 => 66,  104 => 65,  100 => 64,  96 => 63,  88 => 58,  84 => 57,  79 => 55,  69 => 48,  59 => 41,  52 => 36,  49 => 35,  43 => 32,  40 => 31,  37 => 30,  31 => 28,  11 => 26,);
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
/*  # Panel home page*/
/*  #*/
/*  # v3-(Panel-1.2.0-BETA)*/
/*  #}*/
/* */
/* {% extends 'templates/base.twig' %}*/
/* */
/* {% block title %}Home{% endblock %}*/
/* */
/* {% block head %}*/
/*     <!-- Index CSS -->*/
/*     <link href="{{ res("css/index.css") }}" rel="stylesheet" />*/
/* {% endblock %}*/
/* */
/* {% block content %}*/
/* <div class='fulldiv'>*/
/*     <div id="centerDiv">*/
/*         <div id="left-buttons">*/
/*             <a href="statistics">*/
/*                 <div id="statistics" class="button top-button" style="display: none;">*/
/*                     <img id="statistics-icon" class="button-icon" src="{{ res('images/stats.png') }}" />*/
/*                     <p id="statistics-label" class="button-label">Statistics</p>*/
/*                 </div>*/
/*             </a>*/
/* */
/*             <a href="../auth/logout">*/
/*                 <div id="disconnect" class="button bottom-button" style="display: none;">*/
/*                     <img id="disconnect-icon" class="button-icon" src="{{ res('images/disconnect.png') }}" />*/
/*                     <p id="disconnect-label" class="button-label">Disconnect</p>*/
/*                 </div>*/
/*             </a>*/
/*         </div>*/
/* */
/*         <div style="text-align: center;">*/
/*             <img id="sharklogo" src="{{ res('images/sharklogo.png') }}" />*/
/*             <canvas id="canvas" width="350" height="350"></canvas>*/
/*             <img id="logo" style="display: none;" src="{{ res('images/icon.png') }}" />*/
/*             <img id="textlogo" style="display: none;" src="{{ res('images/textlogo.png') }}" />*/
/* */
/*             <div id="infos">*/
/*                 <b>Status : <span style="color: #00ff00">Working</span></b><br /><br />*/
/* */
/*                 Framework : <span style="color: #00ff00">Paladin {{ paladinVersion }}</span><br />*/
/*                 Server : <span style="color: #00ff00">{{ server }}</span><br />*/
/*                 Base : <span style="color: #00ff00">{{ base }}</span><br />*/
/*                 Panel : <span style="color: #00ff00">{{ panel }}</span><br />*/
/*                 Internal : <span style="color: #00ff00">{{ internal }}</span><br />*/
/*             </div>*/
/*         </div>*/
/* */
/*         <div id="right-buttons">*/
/*             <a href="settings">*/
/*                 <div id="settings" class="button top-button" style="display: none;">*/
/*                     <img id="settings-icon" class="button-icon" src="{{ res('images/settings.png') }}" />*/
/*                     <p id="settings-label" class="button-label">Settings</p>*/
/*                 </div>*/
/*             </a>*/
/* */
/*             <a href="about">*/
/*                 <div id="about" class="button bottom-button" style="display: none;">*/
/*                     <img id="about-icon" class="button-icon" src="{{ res('images/about.png') }}" />*/
/*                     <p id="about-label" class="button-label">About</p>*/
/*                 </div>*/
/*             </a>*/
/*         </div>*/
/*     </div>*/
/* */
/* */
/* </div>*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/*     <!-- Index JS script -->*/
/*     <script src="{{ res('js/index.js') }}"></script>*/
/* */
/*     <!-- Starting the JS script -->*/
/*     <script>*/
/*         start({{ serverEnabled ? "true" : "false" }}, "{{ res('images/background.png') }}");*/
/*     </script>*/
/* {% endblock %}*/
/* */
