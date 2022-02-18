<?php

namespace App\Controller;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/', name: 'home_')]
class HomeController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $em): Response
    {
    $tradeSkillTypeRepo = $em->getRepository('App:TradeSkillType');

        return $this->render('home/index.html.twig', [
            'tradeSkillTypes' => $tradeSkillTypeRepo->findAll(),
        ]);
    }
}
