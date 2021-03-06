<?php 

    // {{}} --> components
    // {} --> parameters

    // Startup variables
    $title = 'Sobre';
    $description = 'Somos um casal que criou uma empresa de fotografia em 16 de janeiro de 2018, na cidade de Rio do Sul - SC, mas agora estamos em Gaspar - SC, trabalhamos com clipes, vídeos e fotos em 360º, ensaios externos, pré evento e fotografia de produtos, mas não nos limitamos apenas a isso.';
    $root_path = '../'; // Path relative to the root of the project
                                                                            // Params needed
    $nav = file_get_contents($root_path. "html/components/nav.html"); // {hero_mod} / {title}
    $header = file_get_contents($root_path. "html/components/header.html"); // {root_path} / {1}, {2}, {3}, {4}, {5} --> Active page. Use "active" for activation 
    $footer = file_get_contents($root_path. "html/components/footer.html"); // {theme}
    $page = file_get_contents($root_path. "html/template.html"); // {title} / {root_path} / {page_layout} / {{header}} / {{content}} / {{footer}} / {{script}}
    $script = file_get_contents($root_path. "assets/js/script.js");
    $script .= file_get_contents($root_path. "sobre/script.js");
    $content = file_get_contents($root_path. "sobre/main.html");

    // Custom params
    $hero_mod = "hero--sobre";
    $page_layout = "about";
    $active = "active";
    $hero_logo = '';
    $theme = "footer--purple";

    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{description}", $description, $page);
    $page = str_replace("{{nav}}", $nav, $page);
    $page = str_replace("{{header}}", $header, $page);
    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{{footer}}", $footer, $page);
    $page = str_replace("{{script}}", $script, $page);
    $page = str_replace("{{content}}", $content, $page);
    $page = str_replace("{root_path}", $root_path, $page);
    $page = str_replace("{hero_mod}", $hero_mod, $page);
    $page = str_replace("{hero_logo}", $hero_logo, $page);
    $page = str_replace("{5}", $active, $page);
    $page = str_replace("{theme}", $theme, $page);
    $page = str_replace("{page_layout}", $page_layout, $page);
    
    function getAge($bithdayDate) {
      $date = new DateTime($bithdayDate);
      $now = new DateTime();
      $interval = $now->diff($date);
      return $interval->y;
    }
    
    
    $page = str_replace("{idadeRamon}", getAge('1998-07-28'), $page);
    $page = str_replace("{idadeMartina}", getAge('2002-03-14'), $page);
    
    print($page);

?>