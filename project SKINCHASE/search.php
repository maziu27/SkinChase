if($_SERVER["REQUEST_METHOD"==="POST"]){
    $nombre = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST[''])

    echo "has buscado $nombre";
}