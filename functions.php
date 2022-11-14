<?php

// Paramètres de connexion à la base de données (à adapter en fonction de votre environnement);

define('HOST', 'localhost');
define('USER', 'root');
define('DBNAME', 'links_manager_dev');
define('PASSWORD', ''); // windows (Mamp le mot de passe c'est 'root')


/**
 * Fonction de connexion à la base de données
 *
 * @return \PDO
 */
function db_connect(): PDO
{
    try {
        /**
         * Data Source Name : chaine de connexion à la base de données
         * Elle permet de renseigner le domaine du serveur de la base de données, le nom de la base de données cible et l'encodage de données pendant leur transport
         * @var string
         */
        $dsn =  'mysql:host=' . HOST . ';dbname=' . DBNAME . ';charset=utf8';

        return new PDO($dsn, USER, PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    } catch (\PDOException $ex) {
        echo sprintf('La demande de connexion à la base de donnée a échouée avec le message %s', $ex->getMessage());
        exit(0);
    }
}


/**
 * Fonction qui permet de récupérer le tableau des enregistrements de la table des liens
 * @return array
 */
function get_all_link()
{
    // TODO implement function
    $db = db_connect ();
    $sql = <<<EOD
    SELECT 
        `title`,
        `url`
    FROM 
        `link_manager_dev`
    ORDER BY
        `title`
    EOD;

    $linkDetailsStmt = $db -> query ($sql);

    $linkDetailsStmt -> execute ();

    $linkDetails = $linkDetailsStmt -> fetchAll (PDO::FETCH_ASSOC);

    return $linkDetails;
}


/**
 * Fonction qui permet de récupérer un enregistrement à partir de son identifiant dans la table des liens
 * @param integer $link_id
 * @return array
 */
function get_link_by_id($link_id)
{
    // TODO implement function
    $db = db_connect ();
    $sql = <<<EOD
    SELECT 
        `link_id`
    FROM 
        `link_manager_dev`
    ORDER BY 
        `link_id`
    EOD;

    $linkDetailsStmt = $db -> prepare ($sql);

    $linkDetailsStmt = bindValue (':link_id', $link_id);

    $linkDetailsStmt -> execute ();

    $linkDetails = $linkDetailsStmt -> fetchAll (PDO::FETCH_ASSOC);

    return $linkDetails;
}


/**
 * Fonction qui permet de modifier un enregistrement dans la table des liens
 * @param array $data: ['link_id' => 1, 'title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function update_link(array $data)
{
    // TODO implement function
    $db = db_connect ();

    $sql = "UPDATE `link_manager_link` SET `title`=:title, `url`=:link_url";

    $linkDetailsStmt = $db -> prepare ($sql);

    $linkDetailsStmt = bindValue (':data', $data);

    $linkDetailsStmt -> execute ();

    $linkDetails = $linkDetailsStmt -> fetchAll (PDO::FETCH_ASSOC); 

    return $linkDetails;
}


/**
 * Fonction qui permet de d'enregistrer un nouveau lien dans la table des liens
 * @param array $data: ['title' => 'MDN', 'url' => 'https://developer.mozilla.org/fr/']
 * @return bool
 */
function create_link(array $data)
{
    // TODO implement function
    $db = db_connect ();
    
    $sql = "INSERT INTO `link_manager_dev`(`title`, `url`) VALUES (:title, :link_url)";

    $linkDetailsStmt = $db -> prepare ($sql);

    $linkDetailsStmt = bindValue (':data', $data);

    $linkDetailsStmt -> execute ();

    $linkDetails = $linkDetailsStmt -> fetchAll (PDO::FETCH_ASSOC);

    return $linkDetails;
}

/**
 * Fonction qui permet de supprimer l'enregistrement dont l'identifiant est $linl_id dans la table des liens
 *@param integer $link_id
 * @return bool
 */
function delete_link($link_id)
{
    // TODO implement function
    $db = db_connect ();
    
    $sql = "DELETE FROM `link_manager_dev` WHERE `link_id`=:link_id";

    $linkDetailsStmt = bindValue (':link_id', $link_id);

    $linkDetailsStmt -> execute ();

    $linkDetails = $linkDetailsStmt -> fetchAll (PDO::FETCH_ASSOC);

    return $linkDetails;
}
