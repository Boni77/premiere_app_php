<?php

function addMessage(): array // On crée la fonction ajouter un message
{
    if(isset($_SESSION['message'])){    // Si le tableau message dans la session existe 
        $message = $_SESSION['message']; // On dit que la variable message est égal au tableau Session message
        unset($_SESSION['message']);    // On supprime directement les données de session message
        return $message;               // On retourne le message
    }
    return [];
}

function setMessage(string $type, string $texte): void // void = vide
{
    $_SESSION['message'] = [
        'type'=> $type,
        'text'=>$texte
    ];
}