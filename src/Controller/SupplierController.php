<?php

namespace App\Controller;

use App\Entity\Supplier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SupplierController extends AbstractController
{
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
}
