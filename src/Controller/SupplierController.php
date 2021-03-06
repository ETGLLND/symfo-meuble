<?php

namespace App\Controller;

use App\Entity\Supplier;
use App\Form\SupplierType;
use App\Repository\SupplierRepository;
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

        if ($form->isSubmitted() && $form->isValid()) {
            $supplier = $form->getData();
            $this->em->persist($supplier);
            $this->em->flush();

            return $this->redirectToRoute("supplier_list");
        }

        return $this->render("supplier/add.html.twig", [
            "form" => $form->createView()
        ]);
    }

    /**
     * @Route("/supplier/{id}/edit", name="supplier_edit")
     */
    public function edit(int $id, Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Supplier::class);
        $supplier = $repository->find($id);

        $form = $this->createForm(SupplierType::class, $supplier);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newSupplier = $form->getData();
            $this->em->persist($newSupplier);
            $this->em->flush();

            return $this->redirectToRoute("supplier", ['id' => $id]);
        }

        return $this->render("supplier/edit.html.twig", [
            "form" => $form->createView(),
            "supplier" => $supplier
        ]);
    }

    /**
     * @Route("/supplier/{id}/delete", name="supplier_delete")
     */
    public function delete(int $id)
    {
        $repository = $this->getDoctrine()->getRepository(Supplier::class);
        $supplier = $repository->find($id);
        foreach ($supplier->getMaterials() as $material) {
            $supplier->removeMaterial($material);
        }

        $this->em->remove($supplier);
        $this->em->flush();

        return $this->redirectToRoute('supplier_list');
    }

    /**
     * @Route("/suppliers", name="supplier_list")
     */
    public function list(SupplierRepository $supplierRepository)
    {
        $suppliers = $supplierRepository->findAll();

        return $this->render('supplier/list.html.twig', [
            'suppliers' => $suppliers
        ]);
    }
}
