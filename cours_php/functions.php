<?php
function calculer($nombre1,$nombre2,$operateur)
{
    
    if(!empty($nombre1) && !empty($nombre2) && !empty($operateur))
    {
        if((is_int($nombre1) || $nombre1 > 0) && (is_int($nombre2) || $nombre2 > 0))
        {
            switch($operateur)
            {
                case 'addition':
                    $resultat = $nombre1+$nombre2;
                break;
                case 'soustraction':
                    $resultat = $nombre1-$nombre2;
                break;
                case 'multiplication':
                    $resultat = $nombre1*$nombre2;
                break;
                case 'division':
                    $resultat = $nombre1/$nombre2;
                break;
                default:
                    $resultat = 'aucun';
                break;
            }
            return $resultat;
            exit;
        }
    }
    return false;
}
function mot_de_passe()
{
    $ch = 'azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890';
    $ch = str_split($ch);
    $lg = rand(10,16);
    $mdp='';
    for($i=0;$i<=$lg;$i++)
    {
        $c = rand(0,count($ch)-1);
        $mdp.= $ch[$c];
    }
    return $mdp;
}
function renomme_image($name)
{
    $str = array('&','é','"','(','§','è','!','ç','à','@',')','°','#','^','¨','$','*','€','ù','%','`','£',' ');
    $nom = str_replace($str,'',$name);
    $date = date('d-m-Y-h-i-s');
    return $date.$nom;
}
function pdo_connect(){
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = 'root';
    $DATABASE_NAME = 'via_orleans';

    try{
        return new PDO('mysql:host='.$DATABASE_HOST. ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch(PDOException $exception) {
        exit('failed to connect bdd');
    }
}
function etat_actu($etat)
{
    switch($etat)
    {
        case '1':
            return 'Brouillon';
        break;
        case '2':
            return 'En ligne';
        break;
        case '3':
            return 'Supprimé';
        break;
    }
}
function dateFr($date)
{
    $date = explode('-',$date);
    return $date[2].'/'.$date[1].'/'.$date[0];
}


?>