<?php

/* stats.twig */
class __TwigTemplate_f6a01f47a2980d76fffd45738ef056b7e926a9e87af236129b31d40ea7cbac6b extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        // line 26
        $this->parent = $this->loadTemplate("templates/base.twig", "stats.twig", 26);
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
        echo "Statistics";
    }

    // line 30
    public function block_head($context, array $blocks = array())
    {
        // line 31
        echo "    <!-- Index CSS -->
    <link href=\"";
        // line 32
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/stats.css")), "html", null, true);
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
        <button style=\"width: 200px\" onclick=\"window.location.href='..';\">Home</button>
        <br />
        <br />

        <hr />

        <div id=\"connections\">
            <p>";
        // line 53
        echo twig_escape_filter($this->env, (isset($context["connections"]) ? $context["connections"] : null), "html", null, true);
        echo "</p>
            <br />

            Connections
        </div>
        <br />
        <br />

        <div id=\"clear-buttons\">
            <button class=\"clear-button\" onclick=\"clearConnections()\">Clear connections</button>
            <button id=\"clear-button\" onclick=\"clearIps()\">Clear IPs</button>
        </div>
        <br />

        <div id=\"ips\">
            ";
        // line 68
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["ips"]) ? $context["ips"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["ip"]) {
            // line 69
            echo "                ";
            echo twig_escape_filter($this->env, $context["ip"], "html", null, true);
            echo "<br />
            ";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['ip'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 71
        echo "        </div>
    </div>
";
    }

    // line 75
    public function block_scripts($context, array $blocks = array())
    {
        // line 76
        echo "
    <!-- The Stats Page Script -->
    <script src=\"";
        // line 78
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("js/stats.js")), "html", null, true);
        echo "\"></script>

";
    }

    public function getTemplateName()
    {
        return "stats.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  121 => 78,  117 => 76,  114 => 75,  108 => 71,  99 => 69,  95 => 68,  77 => 53,  64 => 43,  56 => 38,  52 => 36,  49 => 35,  43 => 32,  40 => 31,  37 => 30,  31 => 28,  11 => 26,);
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
/*  # Panel statistics page*/
/*  #*/
/*  # v3-(Panel-1.2.0-BETA)*/
/*  #}*/
/* */
/* {% extends 'templates/base.twig' %}*/
/* */
/* {% block title %}Statistics{% endblock %}*/
/* */
/* {% block head %}*/
/*     <!-- Index CSS -->*/
/*     <link href="{{ res("css/stats.css") }}" rel="stylesheet" />*/
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
/*         <button style="width: 200px" onclick="window.location.href='..';">Home</button>*/
/*         <br />*/
/*         <br />*/
/* */
/*         <hr />*/
/* */
/*         <div id="connections">*/
/*             <p>{{ connections }}</p>*/
/*             <br />*/
/* */
/*             Connections*/
/*         </div>*/
/*         <br />*/
/*         <br />*/
/* */
/*         <div id="clear-buttons">*/
/*             <button class="clear-button" onclick="clearConnections()">Clear connections</button>*/
/*             <button id="clear-button" onclick="clearIps()">Clear IPs</button>*/
/*         </div>*/
/*         <br />*/
/* */
/*         <div id="ips">*/
/*             {% for ip in ips %}*/
/*                 {{ ip }}<br />*/
/*             {% endfor %}*/
/*         </div>*/
/*     </div>*/
/* {% endblock %}*/
/* */
/* {% block scripts %}*/
/* */
/*     <!-- The Stats Page Script -->*/
/*     <script src="{{ res("js/stats.js") }}"></script>*/
/* */
/* {% endblock %}*/
/* */
