<?php
class AdminClass{
    protected $pdo = null;
    protected $host = 'localhost';
    protected $dbname = 'admin';
    protected $username = 'root';
    protected $password = '';
    protected $charset = 'utf8';
    public function __construct(){
        try{
            $this->pdo = new pdo("mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset", $this->username, $this->password);
        }
        catch(PDOException $error){
            die($error->getMessage());
        }
        if(!isset($_SESSION['mail']) && !isset( $_SESSION['login'])){
            header('location ./login.php');
        }
    }
    public function pdoInsert($sql, $args){
        $statement = $this->pdo->prepare($sql);
        $response = $statement->execute($args);
        if($response){
            return '<div class="alert alert-success">İşlem Başarılı</div>';
        }
        else {
            return '<div class="alert alert-danger">İşlem Başarısız</div>';
        }

    }

    public function getAbout(){
        $sql = $this->pdo->query("SELECT * FROM qp_about ORDER BY id ASC", PDO::FETCH_ASSOC)->fetchAll();
        if($sql){
            return $sql;
        }
        else {
            return '<div class="alert alert-danger">Veri Bulunamadı</div>';
        }
    }





    public function getSecurity($data){
        if(is_array($data)){
            $variable = array_map('htmlspecialchars', $data);
            $response = array_map('stripslashes', $variable);
            return $response;
        }
        else{
            $variable = htmlspecialchars($data);
            $response = stripslashes($variable);
             return $response;
        }
    }
}
    
?>