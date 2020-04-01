<?php 

    // {{}} --> components
    // {} --> parameters

    // Startup variables
    $title = 'Álbum';
    $description = 'Álbum de Fulano!';
    $root_path = '../../'; // Path relative to the root of the project
                                                                            // Params needed
    $nav = file_get_contents($root_path. "html/components/nav.html"); // {root_path} / {1}, {2}, {3}, {4}, {5} --> Active page. Use "active" for activation 
    $header = '';
    $footer = file_get_contents($root_path. "html/components/footer.html"); // {theme}
    $page = file_get_contents($root_path. "html/template.html"); // {title} / {root_path} / {page_layout} / {{header}} / {{content}} / {{footer}} / {{script}}
    $script = file_get_contents($root_path. "assets/js/script.js");
    $script .= file_get_contents($root_path. "assets/js/fullscreen.js");
    $script .= file_get_contents($root_path. "assets/js/snackbar.js");
    $script .= file_get_contents($root_path. "albuns/album/script.js");
    $content = file_get_contents($root_path. "albuns/album/main.html");

    // Custom params
    $page_layout = "album";
    $albumId = isset($_GET['id']) ? $_GET['id'] : 1;
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
    $page = str_replace("{theme}", $theme, $page);
    $page = str_replace("{albumId}", $albumId, $page);
    $page = str_replace("{page_layout}", $page_layout, $page);
    
    print($page);

?>