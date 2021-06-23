<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SupplierController extends AbstractController
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/supplier/{id}", name="supplier")
     */
    public function index(int $id): Response
    {
        $repository = $this->getDoctrine()->getRepository(Supplier::class);
        $supplier = $repository->find($id);

        return $this->render('supplier/index.html.twig', [
            'supplier' => $supplier,
        ]);
    }

    /**
     * @Route("/supplier_add", name="supplier_add")
     */
    public function add(Request $request)
    {
        $form = $this->createForm(SupplierType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $supplier = $form->getData();
            $this->em->persist($supplier);
            $this->em->flush();

            return $this->redirectToRoute("home");
        }
        
        return $this->render("supplier/add.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
