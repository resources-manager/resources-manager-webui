<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Service\Menus;

use Doctrine\ORM\EntityManagerInterface;


Class HomeController extends AbstractController
{
    public function index(){
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $menus = new Menus();
        return $this->render('main.html.twig', [
            "menus" => $menus->getMenus( $this->getUser() )
        ]);
    }

}