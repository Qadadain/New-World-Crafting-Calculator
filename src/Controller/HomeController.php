<?php

namespace App\Controller;


use App\Entity\Component;
use App\Entity\TradeSkill;
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

    #[Route('/{slug}', name: 'tradeSkill')]
    public function tradeSkill(EntityManagerInterface $em, TradeSkill $tradeSkill)
    {
        $components = $em->getRepository('App:Component')->findBy(['tradeSkill' => $tradeSkill]);

        return $this->render('tradeskill.html.twig', [
            'components' => $components,
        ]);
    }
}
