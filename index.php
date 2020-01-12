<?php 

    // {{}} --> components
    // {} --> parameters

    // Startup variables
    $title = 'Página Inicial';
    $root_path = './'; // Path relative to the root of the project
                                                                            // Params needed
    $header = file_get_contents($root_path. "html/components/header.html"); // {hero_mod} / {title}
    $footer = file_get_contents($root_path. "html/components/footer.html"); // {theme}
    $page = file_get_contents($root_path. "html/template.html"); // {title} / {root_path} / {page_layout} / {{header}} / {{content}} / {{footer}}
    $content = file_get_contents($root_path. "main.html");

    // Custom params
    $hero_mod = "hero--home";
    $page_layout = "home";

    $page = str_replace("{{header}}", $header, $page);
    $page = str_replace("{{footer}}", $footer, $page);
    $page = str_replace("{{content}}", $content, $page);
    $page = str_replace("{root_path}", $root_path, $page);
    $page = str_replace("{hero_mod}", $hero_mod, $page);
    $page = str_replace("{title}", $title, $page);
    $page = str_replace("{page_layout}", $page_layout, $page);
    
    print($page);

?>