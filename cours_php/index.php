<?php
// On ouvre  la session
session_start();
// On importe notre fichier functions.php qui contient la connection à la BDD
require_once('functions.php');
// On appelle notre function pdo_connect() pour effectuer la connexion à la BDD
$pdo = pdo_connect();
// On va vérifier l'existence des cookies ID et password
if(!empty($_COOKIE['id'])&& !empty($_COOKIE['password']))
{
    // On effectue une requête SQL avec l'id et le password du cookie
    $req = $pdo->prepare('SELECT * FROM `admin` WHERE ID = "'.strip_tags($_COOKIE['id']).'" AND mdp = "'.strip_tags($_COOKIE['password']).'"');
    $req->execute(); // MODIFIER
    // On verifie que la requête nous retourne une ligne avec la méthode Rowcount();
    if($req->rowCount() == 1)// MODIFIER
    {
        // On met en objet notre user
        $user = $req->fetch(PDO::FETCH_OBJ); // MODIFIER
        // On relance notre session et nos cookies
        $_SESSION['connect'] = $user->ID;
        setcookie('id',$user->ID,(time()+86400));
        setcookie('password',$user->mdp,(time()+86400));

    }
    else
    {
        // Si l'utilisateur n'a pas été trouvé on détruit la session et on le renvoie vers la page login
        $_SESSION['connect'] = '';
        header('location:login.php');
        exit;
    }
}
else
{
    // Si on a pas de cookie on redirige l'utilisateur vers la page login
    $_SESSION['connect'] = '';
    header('location:login.php');
    exit;
}
// Affichage de notre page
// On affiche notre header
require_once('header.php');
// On fait un switch pour charger les différentes pages
switch($_GET['c'])
{
    // Pour afficher la liste des actualités
    case 'gestion-actus':
        require_once('gestion-actus.php');
    break;
    // Formulaire d'ajout/edition des actualités
    case 'form-actus':
        require_once('form-actus.php');
    break;
    // Gestion des catégories
    case 'gestion-categories':
        require_once('gestion-categories.php');
    break;
    // Formulaire d'ajout/modification des catégories
    case 'form-categories':
        require_once('form-categories.php');
    break;
    // Gestion des pages
    case 'gestion-pages':
        require_once('gestion-pages.php');
    break;
    // Formulaire ajout/modification page
    case 'form-pages':
        require_once('form-pages.php');
    break;
    // Gestion des utilisateurs
    case 'gestion-users':
        require_once('gestion-users.php');
    break;
    // Formulaire ajout/modification des utilisateurs
    case 'form-users':
        require_once('form-users.php');
    break;
    // Gestion des paragraphes
    case 'gestion-paras':
        // On vérifie que l'ID de la page est bien passé en GET
        if(!empty($_GET['pid']))
            require_once('gestion-paras.php');
        else
        {
            // Sinon on redirige l'utilisateur vers la liste des pages
            header('location:index.php?c=gestion-pages');
            exit;
        }
    break;
    // Formulaire d'ajout/modification des paragraphes
    case 'form-paras':
        // On vérifie que l'ID de la page est bien passé en GET
        if(!empty($_GET['pid']))
            require_once('form-paras.php');
        else
        {
            // Sinon on redirige l'utilisateur vers  la liste des pages
            header('location:index.php?c=gestion-pages');
            exit;
        }
    break;
    // Page par défaut du backoffice
    default:
        header('location:404.php');
    break;
}

// On affiche notre footer
require_once('footer.php');
?>