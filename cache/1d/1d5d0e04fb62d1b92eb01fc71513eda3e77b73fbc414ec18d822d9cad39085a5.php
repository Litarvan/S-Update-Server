<?php

/* templates/base.twig */
class __TwigTemplate_e3b0d5226ae69af0a853fb2128b729eb8f8d83a1ac75999c6221d98fe0689511 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'head' => array($this, 'block_head'),
            'content' => array($this, 'block_content'),
            'scripts' => array($this, 'block_scripts'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!--
  Copyright 2015-2016 Adrien Navratil

  This file is part of S-Update-Server.

  S-Update-Server is free software: you can redistribute it and/or modify
  it under the terms of the GNU Lesser General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  S-Update-Server is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Lesser General Public License for more details.

  You should have received a copy of the GNU Lesser General Public License
  along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.
-->

";
        // line 25
        echo "
<!DOCTYPE html>
<html>
<head>
    <meta charset=\"utf-8\">
    <meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
    <title>S-Update-Server - ";
        // line 32
        $this->displayBlock('title', $context, $blocks);
        echo "</title>

    <!-- Bootstrap -->
    <link href=\"";
        // line 35
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/bootstrap.min.css")), "html", null, true);
        echo "\" rel=\"stylesheet\">

    <!-- The S-Update Icon -->
    <link rel=\"icon\" href=\"";
        // line 38
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("images/icon.png")), "html", null, true);
        echo "\" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src=\"https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js\"></script>
        <script src=\"https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js\"></script>
    <![endif]-->

    <!-- S-Update-Server global CSS -->
    <link href=\"";
        // line 48
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("css/global.css")), "html", null, true);
        echo "\" rel=\"stylesheet\">

    ";
        // line 50
        $this->displayBlock('head', $context, $blocks);
        // line 51
        echo "</head>

<body>
    ";
        // line 54
        $this->displayBlock('content', $context, $blocks);
        // line 55
        echo "
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src=\"";
        // line 57
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("js/jquery-1.11.3.min.js")), "html", null, true);
        echo "\"></script>

    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src=\"";
        // line 60
        echo twig_escape_filter($this->env, call_user_func_array($this->env->getFunction('res')->getCallable(), array("js/bootstrap.min.js")), "html", null, true);
        echo "\"></script>

    ";
        // line 62
        $this->displayBlock('scripts', $context, $blocks);
        // line 63
        echo "</body>
</html>
";
    }

    // line 32
    public function block_title($context, array $blocks = array())
    {
    }

    // line 50
    public function block_head($context, array $blocks = array())
    {
    }

    // line 54
    public function block_content($context, array $blocks = array())
    {
    }

    // line 62
    public function block_scripts($context, array $blocks = array())
    {
    }

    public function getTemplateName()
    {
        return "templates/base.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  130 => 62,  125 => 54,  120 => 50,  115 => 32,  109 => 63,  107 => 62,  102 => 60,  96 => 57,  92 => 55,  90 => 54,  85 => 51,  83 => 50,  78 => 48,  65 => 38,  59 => 35,  53 => 32,  44 => 25,  23 => 1,);
    }
}
/* <!--*/
/*   Copyright 2015-2016 Adrien Navratil*/
/* */
/*   This file is part of S-Update-Server.*/
/* */
/*   S-Update-Server is free software: you can redistribute it and/or modify*/
/*   it under the terms of the GNU Lesser General Public License as published by*/
/*   the Free Software Foundation, either version 3 of the License, or*/
/*   (at your option) any later version.*/
/* */
/*   S-Update-Server is distributed in the hope that it will be useful,*/
/*   but WITHOUT ANY WARRANTY; without even the implied warranty of*/
/*   MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the*/
/*   GNU Lesser General Public License for more details.*/
/* */
/*   You should have received a copy of the GNU Lesser General Public License*/
/*   along with S-Update-Server.  If not, see <http://www.gnu.org/licenses/>.*/
/* -->*/
/* */
/* {#*/
/*  # Panel base template*/
/*  #*/
/*  # v3-(Panel-1.2.0-BETA)*/
/*  #}*/
/* */
/* <!DOCTYPE html>*/
/* <html>*/
/* <head>*/
/*     <meta charset="utf-8">*/
/*     <meta http-equiv="X-UA-Compatible" content="IE=edge">*/
/*     <meta name="viewport" content="width=device-width, initial-scale=1">*/
/*     <title>S-Update-Server - {% block title %}{% endblock %}</title>*/
/* */
/*     <!-- Bootstrap -->*/
/*     <link href="{{ res('css/bootstrap.min.css') }}" rel="stylesheet">*/
/* */
/*     <!-- The S-Update Icon -->*/
/*     <link rel="icon" href="{{ res('images/icon.png') }}" />*/
/* */
/*     <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->*/
/*     <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->*/
/*     <!--[if lt IE 9]>*/
/*         <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>*/
/*         <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>*/
/*     <![endif]-->*/
/* */
/*     <!-- S-Update-Server global CSS -->*/
/*     <link href="{{ res('css/global.css') }}" rel="stylesheet">*/
/* */
/*     {% block head %}{% endblock %}*/
/* </head>*/
/* */
/* <body>*/
/*     {% block content %}{% endblock %}*/
/* */
/*     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->*/
/*     <script src="{{ res('js/jquery-1.11.3.min.js') }}"></script>*/
/* */
/*     <!-- Include all compiled plugins (below), or include individual files as needed -->*/
/*     <script src="{{ res('js/bootstrap.min.js') }}"></script>*/
/* */
/*     {% block scripts %}{% endblock %}*/
/* </body>*/
/* </html>*/
/* */
