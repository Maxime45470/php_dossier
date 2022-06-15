<?php
// On vérifie si on est en édition
if(isset($_GET['id']) && !empty($_GET['id']))
{
    $req = 'SELECT * FROM `actualites` WHERE ID = "'.intval($_GET['id']).'" AND etat < 3';
    $actu = $pdo->query($req);
    if($actu->rowCount() == 1)
    {
        $actualite = $actu->fetch(PDO::FETCH_OBJ);
        $action = 'edit-actu';
    }
    else
    {
        header('location:index.php?c=gestion-actus');
        exit;
    }
}
// Si jamais on est en mode ajout
else
{
    $actualite = null;
    $action = 'ajout-actu';
}
?>
<form method="POST" action="action.php?uc=<?php echo $action;  ?>" enctype="multipart/form-data">
    <div class="form-input">
        <label for="titre">Titre</label>
        <input type="text" name="titre" value="<?php if($actualite['titre']) echo $actualite['titre']; ?>" />
    </div>
    <div class="form-input">
        <label for="contenu">Contenu</label>
        <textarea name="contenu"><?php if($actualite['contenu']) echo $actualite['contenu']; ?>
        </textarea>
    </div>
    <div class="form-input">
        <label for="image">Image</label>
        <?php
        if($actualite['image'])
        {
            echo '<img src="upload/actu/'.$actualite['image'].'" width="300" />';
            echo '<input type="checkbox" name="image_garde" value="1"><label>Supprimer</label>';
        }
        ?>
        <input type="file" name="image" />
    </div>
    <div class="form-input">
        <label for="etat">Etat</label>
        <select name="etat">
            <option value="1" <?php if($actualite['etat']  == 1) echo 'selected="selected"'; ?>>Brouillon</option>
            <option value="2" <?php if($actualite['etat'] == 2) echo 'selected="selected"'; ?>>En ligne</option>
            <?php 
            if($actualite)
            {
                ?>
                <option value="3">Supprimé</option>
                <?php
            }
            ?>
            
        </select>
    </div>
    <button type="submit" name="submit">Enregistrer</button>
</form>