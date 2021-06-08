<?php

namespace App\Controller;
use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager= $entityManager;
    }
    /**
     * @Route("/mon-panier", name="cart")
     */
    public function index(Cart $cart): Response
    {
        $cartComplete = [];
        foreach($cart->get() as $id =>$quantity){

            $productObject = $this->entityManager->getRepository(Product::class)->findOneBy(['id'=>$id]);

            if ($productObject){
                $cartComplete[] = [
                    'product' =>$productObject,
                    'quantity' => $quantity,
                ];
            }
        }
        
        return $this->render('cart/index.html.twig', [
            'cart' =>$cartComplete, 
        ]);
    }

    /**
     * @Route("/mon-panier/ajout/{id}", name="add_cart")
     */
    public function add(Cart $cart, $id): Response
    {
        $cart->add($id); 

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/mon-panier/remove", name="remove_cart")
     */
    public function remove(Cart $cart): Response
    {
        $cart->remove(); 

        return $this->redirectToRoute('product');
    }

    /**
     * @Route("/mon-panier/delete/{id}", name="delete_cart")
     */
    public function delete(Cart $cart, $id): Response
    {
        $cart->delete($id); 

        return $this->redirectToRoute('cart');
    }

    /**
     * @Route("/mon-panier/decrase/{id}", name="decrase_cart")
     */
    public function decrase(Cart $cart, $id): Response
    {
        $cart->decrase($id); 

        return $this->redirectToRoute('cart');
    }
}
