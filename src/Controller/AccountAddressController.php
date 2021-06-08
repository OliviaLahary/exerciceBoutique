<?php

namespace App\Controller;

use App\Form\AddressType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Adresse;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class AccountAddressController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager=$entityManager;
    }
    /**
     * @Route("/mon-compte/adresse", name="account_address")
     */
    public function index(): Response
    {
        return $this->render('account/address.html.twig');
    }

    /**
     * @Route("/mon-compte/ajout/adresse", name="account_add_address")
     */
    public function add(Request $request): Response
    {
        $address =new Adresse();
        $form = $this ->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $address->setUser($this->getUser());
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            $this->redirectToRoute('account_address');

            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_add.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/mon-compte/modifier/adresse/{id}", name="account_edit_address")
     */
    public function edit(Request $request, $id): Response
    {
        $address =$this->entityManager->getRepository(Adresse::class)->findOneBy(['id'=>$id]);
        if(!$address || $address->getUser() !=$this->getUser()){
            $this->redirectToRoute('account_address');
        }
        $form = $this ->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $this->entityManager->flush();
            $this->redirectToRoute('account_address');

            return $this->redirectToRoute('account_address');
        }

        return $this->render('account/address_add.html.twig', [
            'form'=>$form->createView(),
        ]);
    }

    /**
     * @Route("/mon-compte/supprimer/adresse/{id}", name="account_delete_address")
     */
    public function delete($id): Response
    {
        $address =$this->entityManager->getRepository(Adresse::class)->findOneBy(['id'=>$id]);

        if($address || $address->getUser() ==$this->getUser()){
            $this->entityManager->remove($address);
            $this->entityManager->flush();
        }
        return $this->redirectToRoute('account_address');
        
    }
}
