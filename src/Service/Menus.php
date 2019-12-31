<?php

namespace App\Service;

use App\Entity\User;

Class Menus
{
 public function getMenus(User $user)
 {
   
   
   $menus = array(
    array(
      "route"  => "app_logout",
      "title"  => "log out"
      ),
   );


    if(  $user->isGranted('SUPER_ADMIN') )
    {
       $menus[] = array(
         "route"  => "users",
         "title"  => "Users"
       );
    }

    

  return $menus;
 }

}