<?php

class Cripto {
    private $senha;

    
    public function __construct ($senha) {
    
        $this->senha = $senha;
    
    }


    public function criptografar ($tamanhoSalt) {
        $salt = $this->salt();
        $hash = md5($this->senha . $salt);

        for ($i = 0; $i < 1500; $i++) {
            
            $hash = md5($hash);
        
        }

        return ['salt'=>$salt, 'senha'=>$hash];
        
    }

    public function descriptografa($senha, $salt, $hash){ // aqui é passado como parâmetro a senha do usuário, o salt usado nela e o hash que foi gerado da criptografia.

        $hashPrograma = md5($senha . $salt);


        for ($i = 0; $i < 1500; $i++) {
            
            $hashPrograma = md5($hashPrograma);
        
        }

        if($hashPrograma == $hash){

            return "true";

        }else{

            return "false";

        }

    }

    public function salt($tamanho = 20) {

        return substr(sha1(mt_rand()), 0, $tamanho);  
    
    }


}

$cri = new Cripto("123"); // setar uma senha

$usuario = ($cri->criptografar()); // guardar em uma variavel pois será retornado um objeto.

echo $cri->descriptografa("123", $usuario["salt"], $usuario["senha"]); // retornar true se a senha bate, senão, retorna false.
